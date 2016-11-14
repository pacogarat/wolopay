<?php

namespace AppBundle\DataFixtures\Specific;

use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\SinglePayment;
use AppBundle\Payment\Util\PaymentProcessService;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadSinglePaymentBasic extends AbstractLoadPayment implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $articleKey = null;

    function __construct($articleKey = null)
    {
        if (!$this->articleKey = $articleKey)
            $this->articleKey = "article-Demo-".ArticleCategoryEnum::SINGLE_PAYMENT_ID."-100";
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * @param ObjectManager $manager
     * @return SinglePayment
     */
    public function load(ObjectManager $manager, $articleReference = null)
    {
        if ($articleReference)
            $this->articleKey = $articleReference;
        else
            $this->articleKey = "article-Demo-".ArticleCategoryEnum::SINGLE_PAYMENT_ID."-100";

        $this->om = $manager;

        /** @var PaymentProcessService $paymentProcessService */
        // Use in a future
        // $paymentProcessService = $this->container->get('shop.payment.payment_process');

        /** @var Article $article */
        $article = $this->getReference($this->articleKey);
//        $appShop = $this->getReference("app_shop-Demo-".LevelCategoryEnum::EXPERT_ID);

        $paymentProcess = new SinglePayment();
        $paymentProcess
            ->setStatusCategory($this->getReference("payment_status_category-".PaymentStatusCategoryEnum::PROCESSING_ID))
            ->setApp($article->getApp())
        ;

        $articleKey = 'Demo-'.$article->getArticleCategory()->getId().'-'.$article->getItemsQuantity();
        /** @var AppShopHasArticle $appShopHasArticle */
        $appShopHasArticle = $this->getReference("app_shop_has_articles-".$articleKey."-".CountryEnum::SPAIN.'-'.LevelCategoryEnum::ROOKIE_ID);

        $pda = new PaymentDetailHasArticles($appShopHasArticle);
        $pmpc=$this->getReference('pay_method_provider_has_country-'.PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-' .CountryEnum::SPAIN);

        $this->createPaymentDetails($paymentProcess, [$pda], $appShopHasArticle->getAmount(), $pmpc);

        $this->om->flush();


        return $paymentProcess;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 800; // the order in which fixtures will be loaded
    }
}