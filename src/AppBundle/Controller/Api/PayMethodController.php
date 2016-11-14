<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Transaction;
use AppBundle\Exception\NviaApiPublicException;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Util\ArticleExtraCost\ArticleTempPriceService;
use AppBundle\Service\ArticleService;
use AppBundle\Service\PayMethodService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PayMethodController extends AbstractAPI
{
    /**
     * @var ArticleService
     * @DI\Inject("shop_app.article")
     */
    public $articleService;

    /**
     * @var ArticleTempPriceService
     * @DI\Inject("app.article_temp_price")
     */
    public $articleTempPriceService;

    /**
     * @var PayMethodService
     * @DI\Inject("app.pay_method")
     */
    public $payMethodService;

    /**
     * @var EntityManagerInterface
     * @DI\Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * Get all operator action
     *
     * @Get("/paymethod/amount-fixed")
     * @QueryParam(name="transaction_id", description="Transaction Id", strict=true, nullable=false)
     * @QueryParam(name="article_id", description="Article Id", strict=true, nullable=false)
     * @QueryParam(name="pay_method_id", description="PayMethod Id", strict=true, nullable=false)
     *
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("article", class="AppBundle:Article", options={"id" = "article_id"})
     * @ParamConverter("pmpc", class="AppBundle:PayMethodProviderHasCountry", options={"id" = "pay_method_id"})
     *
     * @param Transaction $transaction
     * @param PayMethodProviderHasCountry $pmpc
     * @param Article $article
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @throws \AppBundle\Exception\NviaApiPublicException
     * @return array
     */
    public function getPayMethodsWithAmountFixedAction(Transaction $transaction, PayMethodProviderHasCountry $pmpc, Article $article)
    {
        /** @var AppApiCredentials $appCredentials */
        $appCredentials=$this->getUser();
        $app=$appCredentials->getApp();

        if (!$pmpc->hasAFixedAmount())
            throw new BadRequestHttpException("Invalid pay method selected");

        $countryConfigured = $this->verifyValidCountry($transaction, $pmpc->getCountry());

        $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdAndLevelCategory(
            $countryConfigured->getId(), $article->getId(), $transaction->getLevelCategory()->getId(), $app->getId(), true
        );

        if (!$appShopHasArticle)
            throw new NviaApiPublicException("There aren't articles configurated with dynamic pay-methods");

        $result = [];

        if (!$pmpc->getSMSs()->isEmpty())
        {
            $result = $appShopHasArticle->hasSameAliasPricesAndShortNumber() ?
                [ $appShopHasArticle->getSMSs()[0] ] : $appShopHasArticle->getSMSs()
            ;

        }else if (!$pmpc->getVoices()->isEmpty()){

            $result = $appShopHasArticle->getVoices();
        }

        $view = $this->view($result, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Default')));

        return $this->handleView($view);
    }

    /**
     * Get all available payment methods reference to transaction
     *
     * @ApiDoc(
     *   resource = false,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/paymethod")
     * @QueryParam(name="transaction_id", description="Transaction Id", strict=true, nullable=false)
     * @QueryParam(name="country", strict=true, requirements="[A-Z]{2}", description="Country", nullable=false)
     * @QueryParam(name="article_id", description="Articles Ids CSV Format", strict=true, nullable=true)
     * @QueryParam(name="tab_category_id", nullable=true, description="Tab category Id")
     *
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     *
     * @param Transaction $transaction
     * @param Country $country
     * @param integer $article_id
     * @param null $tab_category_id
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return array
     */
    public function getPayMethodsAction(Transaction $transaction, Country $country, $article_id=null, $tab_category_id = null)
    {
        $countryConfigured = $this->verifyValidCountry($transaction, $country);

        $articles = null;
        if ($article_id)
        {
            try{
                $articles = UtilHelper::getObjectsFromCSV($article_id, "AppBundle:Article", $this->getDoctrine());
            }catch (\Exception $e){
                throw new BadRequestHttpException("Article id is incorrect: ". $e->getMessage());
            }
        }

        $appTab = $this->getAppTab($tab_category_id, $transaction);

        $appHasPMPC = $this->getDoctrine()->getRepository("AppBundle:AppHasPayMethodProviderCountry")
            ->findByAppIdAndCountryAndLevelCategoryandArticleIdAndAppTabAndStatus(
                $transaction->getApp()->getId(),
                $countryConfigured->getId(),
                $country->getId(),
                $transaction->getLevelCategory()->getId(),
                $articles,
                $appTab,
                $transaction->getPayMethodsAvailable()->toArray(),
                $transaction->getExternalStore(),
                $transaction->getPayMethodsDefaultOrder()
            );

        $extraContext = [];
        if ($article_id)
        {
            $appShopHasArticles = $this->getDoctrine()->getRepository("AppBundle:AppShopHasArticle")->findByArticlesIdsAndCountryIdAndLevelCategoryAndAppId(
                $countryConfigured->getId(),
                str_getcsv($article_id, ','),
                $transaction->getLevelCategory()->getId(),
                $transaction->getApp()->getId()
            );


            if (count($appShopHasArticles) > 0)
            {
                $this->articleService->exchangeFromAppShopHasArticles($appShopHasArticles, $country);

                $appHasPMPC = $this->payMethodService->removeAmount0PayMethods($appShopHasArticles, $appHasPMPC);

                $appHasPMPC = $this->payMethodService->calculateForcedPrices(
                    $appShopHasArticles,
                    $appHasPMPC,
                    $transaction,
                    $country->getCurrency()
                );

                $extraContext[]='ForcePrice';
            }
        }

        $view = $this->view($appHasPMPC, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array_merge(['Default','Public','AppShopArticleHasPMPCFull'], $extraContext)));

        return $this->handleView($view);
    }

    /**
     * Get pay methods available by country and by direct payment
     *
     * @ApiDoc(
     *   resource = false,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/direct_payment/paymethods/country/{country}")
     *
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     *
     * @param Country $country
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDirectPayMethodsByCountryAction(Country $country)
    {
        $appCredentials = $this->getUser();
        $payMethods = $this->em->getRepository('AppBundle:PayMethod')->findByCanBeCustom(
            $appCredentials->getApp()->getId(),
            true,
            $country,
            ArticleCategoryEnum::SINGLE_PAYMENT_ID,
            true
        );

        $view = $this->view($payMethods, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(['PayMethodList', 'PayCategoryName']));

        return $this->handleView($view);
    }

}
