<?php

namespace AppBundle\DataFixtures\Specific;

use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\AppShopHasArticles;
use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\SinglePayment;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadSinglePaymentDollarBasic extends AbstractLoadPayment implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
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

        $paymentProcess = new SinglePayment();
        $paymentProcess
            ->setStatusCategory($this->getReference("payment_status_category-".PaymentStatusCategoryEnum::PROCESSING_ID))
            ->setApp($article->getApp())
        ;

        $pda = new PaymentDetailHasArticles($appShopHasArticle);
        $pmpc=$this->getReference('pay_method_provider_has_country-'.PayMethodEnum::PAYPAL_SINGLE_NAME.'-'.ProviderEnum::PAYPAL_NAME.'-' .CountryEnum::USA);

        $this->createPaymentDetails($paymentProcess, [$pda], $appShopHasArticle->getAmount(), $pmpc);

        $this->om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 800; // the order in which fixtures will be loaded
    }
}