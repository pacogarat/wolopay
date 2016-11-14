<?php

namespace AppBundle\Controller\ExternalStores;


use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\LevelCategory;
use AppBundle\Payment\PayMethod\ExternalStores\FacebookIpnPayMethod;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Service\ArticleService;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sonata\MediaBundle\Provider\ImageProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/facebook")
 */
class FacebookController extends AbstractExternalStores
{
    const PREFIX_USER = FacebookIpnPayMethod::PREFIX_USER;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var ArticleService
     * @Inject("shop_app.article")
     */
    public $articleService;

    /**
     * @var PaymentProcessService
     * @Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var CurrencyService
     * @Inject("common.currency")
     */
    public $currencyService;

    /**
     * @Route("/product_info/{article_id}/{level_category_id}/{country}", options={"expose"=true}, name="facebook_products_info")
     * @ParamConverter("article", class="AppBundle:Article", options={"id" = "article_id"})
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     * @ParamConverter("levelCategory", class="AppBundle:LevelCategory", options={"id" = "level_category_id"})
     */
    public function productInfoAction(Article $article, Country $country, LevelCategory $levelCategory, Request $request)
    {
        $appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelCategory($article->getApp()->getId(), $levelCategory->getId());
        $gamer_level = $appShop->getValueLower();

        $appShopHasArticle = $this->articleService->findAppShopByCountryOrHisOtherCountry($article, $country, $appShop->getValueLower());

        if (!$appShopHasArticle)
            throw new BadRequestHttpException("Article with this country and for this level not found");

        $title = ArticleService::getTranslationBasic(
            $appShopHasArticle->getNameCurrentLabel(),
            $appShopHasArticle->getCurrentItemsQuantity(),
            $appShopHasArticle->getCountry()->getLanguage()->getId()
        );

        $description = ArticleService::getTranslationBasic(
            $appShopHasArticle->getDescriptionCurrentLabel(),
            $appShopHasArticle->getCurrentItemsQuantity(),
            $appShopHasArticle->getCountry()->getLanguage()->getId()
        );

        $domainMain = $this->container->getParameter('domain_main');

        $url = $domainMain . $this->generateUrl(
            'facebook_products_info',
            ['article_id' => $article->getId(), 'level_category_id' => $levelCategory->getId(), 'country' => $country->getId()]
        );

        $media = $appShopHasArticle->getImageCurrent();

        /** @var ImageProvider $provider */
        $provider = $this->container->get($media->getProviderName());
        $imgUrl = $domainMain . $provider->generatePublicUrl(
                $media,
                $provider->getFormatName($media, 'shop')
            );

        $extraMetadata = '    <meta property="og:type"                   content="og:product" />';
        $prefix = 'og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# product: http://ogp.me/ns/product#';

        if ($article->getArticleCategory()->getId() == ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID)
        {
            $prefix = 'og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# fbpayment: http://ogp.me/ns/fb/fbpayment#';

            $price = $appShopHasArticle->getAmount();
            $currencyId = $appShopHasArticle->getCountry()->getCurrency()->getId();
            $days = $appShopHasArticle->getArticle()->getPeriodicity();
            $price = number_format($price, 2);

            if ($days < 30)
            {
                $val = round($days/7);
                $val = $val > 0 ? $val : 1;

                $periodicity = $val." week";
            }else{

                $val = round($days/30);
                $val = $val > 0 ? $val : 1;

                $periodicity = $val." months";
            }

            $providerCredentials = $article->getApp()->getProviderClientCredentials($this->em->getRepository("AppBundle:Provider")->findOneBy(['name' => ProviderEnum::FACEBOOK_NAME]));
            if (!$providerCredentials)
                throw new BadRequestHttpException('This app has not configured facebook credentials');

            $credentials = $providerCredentials->getDetails();

            $extraMetadata = <<<EOF
    <meta property="og:type"                    content="fbpayment:subscription" />
    <meta property="fb:app_id"                  content="$credentials[app_id]" />
    <meta property="fbpayment:price"            content="$price $currencyId" />
EOF;
        }


        $responseHTML =
            <<<EOF
<!DOCTYPE html>
<html>
 <head prefix="$prefix">
    <meta property="og:title"                  content="$title" />
    <meta property="og:image"                  content="$imgUrl" />
    <meta property="og:description"            content="$description" />
    <meta property="og:url"                    content="$url" />
$extraMetadata
 </head>
</html>
EOF;

        $this->logger->addDebug("RESPONSE WAS: ".$responseHTML);

        return new Response($responseHTML);
    }

    /**
     * @Route("/dynamic_pricing", name="facebook_products_pricing")
     */
    public function dynamicPricingAction(Request $request)
    {
        /*
        [signed_request] => lFd_bGdvcml0aG0iOiJITUFDLVNIQTI1Ni...
        [product] => http://www.friendsmash.com/og/smashingpack.html
        [quantity] => 1
        [user_currency] => EUR
        [request_id] => abc123
        [method] => payments_get_item_price
         */

        $this->logger->addDebug('POST: ' . http_build_query($request->request->all()));

        $quantity         = $request->get('quantity');
        $product          = $request->get('product');
        $currencyFacebook = $this->em->getRepository("AppBundle:Currency")->find($request->get('user_currency'));

        $base64_url_decode= function ($input) {
            return base64_decode(strtr($input, '-_', '+/'));
        };

        $parseSignedRequest = function ($signed_request) use ($base64_url_decode)
        {
            list($encoded_sig, $payload) = explode('.', $signed_request, 2);

            // decode the data
            $sig = $base64_url_decode($encoded_sig);
            $data = json_decode($base64_url_decode($payload));

            return $data;
        };

        // Example json
        // {"algorithm":"HMAC-SHA256","expires":1446040800,"issued_at":1446035943,"oauth_token":"CAAXffzva7DcBAJC731xZBVzZBGwBThTSBuIu3jp4oPxvIqSgoXBZAkz5ZC5PbSDyKsWJatnJyJ2H6FskWNzSlCZBqHIJwxDwnMZCXSv2Ipb8MA2OMSvRqy16OFsxW6bTzjSixXPS7eEdFNpEub8bPfgnKClwO8otc3p2ZCALYcF1eUPuua0m8VFijUrOcoj4gKqFZC69cZAv2we0alS9wvnXM","payment":{"product":"https:\/\/miguel.wolopay.com\/external_shop\/facebook\/my-easy-app\/products\/100coins_dynamic.html","quantity":"10","user_currency":"EUR","request_id":"1446035942356"},"user":{"country":"es","locale":"en_US","age":{"min":21}},"user_id":"120693761623915"}

        $json = $parseSignedRequest($request->get('signed_request'));

        $gamerExternalId = self::PREFIX_USER . $json->user_id;

        $productUrl = str_replace($this->container->getParameter('domain_main'),'', $product );
        $router = $this->get('router');
        $routeMatcher = $router->getMatcher();
        $data = $routeMatcher->match($productUrl);

        $article = $this->em->getRepository("AppBundle:Article")->find($data['article_id']);
        $country = $this->em->getRepository("AppBundle:Country")->find($data['country']);
        $levelCategoryId = $data['level_category_id'];

        $appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelCategory($article->getApp()->getId(), $levelCategoryId);

        if (!$article || !$country || !$levelCategoryId || !$appShop)
            throw new BadRequestHttpException("Invalid product");

        $gamerLevel = $appShop->getValueLower();

        $appShopHasArticle = $this->articleService->findAppShopByCountryOrHisOtherCountry($article, $country, $gamerLevel);

        $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId($article->getApp()->getId(), $gamerExternalId);
        if ($gamer)
        {
            $this->logger->addDebug('gamer exist');
            $this->articleService->deleteOfferIfInvalidByUser($appShopHasArticle, $gamer);
        }

        $currencyResponse = $appShopHasArticle->getCountry()->getCurrency();

        $amount = $appShopHasArticle->getCurrentAmount() * $quantity;
        $amount = round($amount, $currencyResponse->getDecimalPlaces());

//        $amount = $this->currencyService->getExchange(
//            $appShopHasArticle->getCurrentAmount() / $quantity,
//            $appShopHasArticle->getCountry()->getCurrency(),
//            $currencyFacebook->getId()
//        );
//
//        $amount = round($amount, $currencyFacebook->getDecimalPlaces());

        $response = [
            'content' => [
                'product'  => $json->payment->product,
                'amount'   => $amount,
                'currency' => $currencyResponse->getId()
            ],
            'method' => 'payments_get_item_price'
        ];

        $this->logger->addDebug('Response: ' . http_build_query($response));

        return new JsonResponse($response);
    }


}
