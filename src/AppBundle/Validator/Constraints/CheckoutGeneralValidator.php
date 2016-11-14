<?php
/**
 * Created by MGDSoftware. 08/06/2016
 */

namespace AppBundle\Validator\Constraints;


use AppBundle\Entity\App;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\Article;
use AppBundle\Entity\Checkout;
use AppBundle\Entity\Country;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\PayMethod;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Transaction;
use AppBundle\Service\ArticleService;
use AppBundle\Service\CountryService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * @Service("checkout.validator.check_all")
 * @Tag("validator.constraint_validator", attributes={"alias": "checkout_general_validation"})
 */
class CheckoutGeneralValidator extends ConstraintValidator{

    /** @var  Transaction $transaction */
    private $transaction;

    /** @var  Article[] $articles  */
    private $articles;

    /** @var  AppShop $appShop */
    private $appShop;

    /** @var  PayMethod $payMethod */
    private $payMethod;

    /** @var  $smsId */
    private $smsId;

    /** @var  $voiceId */
    private $voiceId;


    /** @var  Country */
    private $country;
    /** @var  PayMethodProviderHasCountry $pmpc */
    private $pmpc;

    /** @var EntityManager $em */
    private $em;

    /** @var CountryService */
    private $countryService;

    /** @var ArticleService $articleService*/
    private $articleService;
    /**
     * @InjectParams({
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "countryService" = @Inject("country"),
     *    "articleService" = @Inject("shop_app.article")
     * })
     */
    function __construct(EntityManager $em, CountryService $countryService, ArticleService $articleService)
    {
        $this->em     = $em;
        $this->countryService = $countryService;
        $this->articleService = $articleService;
    }

    public function validate($object, Constraint $constraint)
    {
        /** @var Checkout $checkout */
        $checkout = $this->context->getRoot();

        $this->transaction = $checkout->getTransaction();
        $this->articles = $checkout->getArticles();
        $this->appShop = $checkout->getAppShop();
        $this->payMethod = $checkout->getPayMethod();
        $this->smsId = $checkout->getSmsId();
        $this->voiceId =$checkout->getVoiceId();

        $this->checkPayMethod();
        $this->checkArticlesAndPayMethod();

    }

    private function checkPayMethod(){
        $pmps = $this->em->getRepository("AppBundle:PayMethodHasProvider")->findByPayMethodIdAndCanBeCustomTransaction(
            $this->payMethod->getId()
        );
        if (!$pmps)
        {
            $this->context->buildViolation('No Provider for that paymethod')
                ->atPath('checkoutPayMethod')
                ->addViolation();
        }

        // we assume that pmp has oly one pay_method-provider per country
        $pmp = $pmps[0];

        $this->country = $this->transaction->getCustomCountry() ? : $this->transaction->getCountryDetected();

        $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
            $this->payMethod->getId(), $pmp->getProvider()->getId(), $country->getId()
        );

        if (!$pmpc){
            $this->context->buildViolation('Invalid PayMethod for that country')
                ->atPath('checkoutPayMethodCountry')
                ->addViolation();
        }
        $this->pmpc = $pmpc;
    }

    private function checkArticlesAndPayMethod(){
        try{
            foreach ($this->articles as $article)
            {
                $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")
                    ->findOneById($this->country->getId(), $this->appShop->getId(), $article->getId());

                if (!$appShopHasArticle)
                {
                    $this->context->buildViolation("Invalid combination of country (id:".$this->country->getId()."),
                    appShop(id:".$this->appShop->getId().") and Article (id:". $article->getId().")")
                        ->atPath('checkoutArticlesAndPayMethod')
                        ->addViolation();
                }

                $appShopHasArticles[] = $appShopHasArticle;
            }
            if (!$appShopHasArticles){
                $this->context->buildViolation('There are no articles for this configuration')
                    ->atPath('checkoutArticlesAndPayMethod')
                    ->addViolation();
            }



            $this->articleService->verifyArticlesAndPayMethodAreOk($appShopHasArticles, $this->pmpc, $this->transaction, $this->smsId, $this->voiceId);
        }catch (\Exception $e){
            $this->context->buildViolation($e->getMessage())
                ->atPath('checkoutArticlesAndPayMethod')
                ->addViolation();
        }
    }


}