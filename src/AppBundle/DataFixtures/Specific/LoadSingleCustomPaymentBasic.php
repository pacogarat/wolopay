<?php

namespace AppBundle\DataFixtures\Specific;

use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\AppShopHasArticles;
use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Entity\SinglePayment;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadSingleCustomPaymentBasic extends AbstractLoadPayment implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    const AMOUNT = 3.2;
    const AMOUNT_CURRENCY_ID = CurrencyEnum::EURO;

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
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        /** @var Article $article */
        $article = $this->getReference("article-Demo-".ArticleCategoryEnum::SINGLE_PAYMENT_ID."-100");
        $appShop = $this->getReference("app_shop-Demo-".LevelCategoryEnum::EXPERT_ID);

        $articleKey = 'Demo-'.$article->getArticleCategory()->getId().'-'.$article->getItemsQuantity();
        /** @var AppShopHasArticle $appShopHasArticle */
        $appShopHasArticle = $this->getReference("app_shop_has_articles-".$articleKey."-".CountryEnum::SPAIN.'-'.LevelCategoryEnum::ROOKIE_ID);

        $paymentProcess = new SingleCustomPayment();
        $paymentProcess
            ->setStatusCategory($this->getReference("payment_status_category-".PaymentStatusCategoryEnum::PROCESSING_ID))
            ->setApp($article->getApp())
        ;

        $pmpc=$this->getReference('pay_method_provider_has_country-'.PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-' .CountryEnum::SPAIN);

        $this->createPaymentDetails($paymentProcess, [], static::AMOUNT, $pmpc);

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