<?php

namespace AppBundle\DataFixtures\Specific;

use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Enum\PaymentStatusCategoryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Offer;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\SubscriptionEventuality;
use AppBundle\Entity\SubscriptionEventualityPayment;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadSubscriptionPurchaseWithOffer extends LoadSubscriptionPurchaseBasic implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        /** @var Article $article */
        $article = $this->getReference("article-Demo-".ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID."-100");

        $articleKey = 'Demo-'.$article->getArticleCategory()->getId().'-'.$article->getItemsQuantity();

        /** @var AppShopHasArticle $appShopHasArticle */
        $appShopHasArticle = $this->getReference("app_shop_has_articles-".$articleKey."-".CountryEnum::SPAIN.'-'.LevelCategoryEnum::ROOKIE_ID);

        $offerProgrammer = new OfferProgrammer();
        $offerProgrammer
            ->setApp($article->getApp())
            ->setName('Offer test')
            ->setQuantityExtraPercent(100)
            ->setAmountPercentDiscount(50)
        ;

        $this->om->persist($offerProgrammer);
        $this->om->flush();

        $offer = new Offer();

        $offer
            ->setAmount($appShopHasArticle->getAmount()/2)
            ->setItemsQuantity($appShopHasArticle->getCurrentItemsQuantity()*2)
            ->setAppShopHasArticle($appShopHasArticle)
            ->setOfferProgrammer($offerProgrammer)
        ;

        $this->om->persist($offer);
        $this->om->flush();

        $appShopHasArticle->setOffer($offer);

        parent::load($manager);

        $transaction = $this->om->getRepository("AppBundle:Transaction")->findAll()[0];
        $transaction->setCountryDetected($this->om->getRepository("AppBundle:Country")->find(CountryEnum::SPAIN));
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