<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleGachaHasArticle;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Helper\UtilHelper;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadArticle extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use SonataMedia;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $this->fillComponent('Demo', ArticleCategoryEnum::SINGLE_PAYMENT_ID, LoadItem::NAME_2, 100, 1.65 );
        $this->fillComponent('Demo', ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID, LoadItem::NAME_1, 100, 0.3, 1, 'arma_2.png');
        $this->fillComponent('Demo', ArticleCategoryEnum::SINGLE_PAYMENT_ID, LoadItem::NAME_2, 300, 1, null);
        $this->fillComponent('Demo', ArticleCategoryEnum::SINGLE_PAYMENT_ID, LoadItem::NAME_2, 800, 98, null, 'arma_3.png');
        $this->fillComponent('Demo', ArticleCategoryEnum::SINGLE_PAYMENT_ID, LoadItem::NAME_2, 122, 0);
        $this->fillComponent('Demo', ArticleCategoryEnum::FREE_PAYMENT_ID, LoadItem::NAME_2, 152, 9 );

        $this->fillComponentGacha('Demo', ArticleCategoryEnum::SINGLE_PAYMENT_ID, LoadItem::NAME_GACHA_1, 1, 50);



        $masive= function($number){
            $this->fillComponent('GalleGame', ArticleCategoryEnum::SINGLE_PAYMENT_ID, LoadItem::GALLE_1, $number, 3, null);
        };

        UtilHelper::nTimesCallback($masive, 12);

        $this->fillComponent('GalleGame', ArticleCategoryEnum::SINGLE_PAYMENT_ID, LoadItem::GALLE_2, 50, 4, null);

    }

    private function fillComponentGacha($appKey, $articCatId, $itemKey, $number, $amountStandard, $periodicity=null, $image='arma_4.png', $active= true)
    {
        $obj = $this->fillComponent($appKey, $articCatId, $itemKey, $number, $amountStandard, $periodicity, $image, $active);

        $articleGacha = new ArticleGachaHasArticle($obj);
        $articleGacha
            ->setOrder(1)
            ->setPossibleArticle($this->getReference('article-'.$appKey.'-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-100'))
            ->setAmountToGive(2)
        ;
        $this->om->persist($articleGacha);

        $articleGacha = new ArticleGachaHasArticle($obj);
        $articleGacha
            ->setOrder(1)
            ->setPossibleArticle($this->getReference('article-'.$appKey.'-'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'-300'))
            ->setAmountToGive(1)
        ;
        $this->om->persist($articleGacha);

        $this->om->flush();
    }

    /**
     * @param $appKey
     * @param $articCatId
     * @param $itemKey
     * @param $number
     * @param $amountStandard
     * @param null $periodicity
     * @param string $image
     * @param bool $active
     * @return \AppBundle\Entity\Article
     */
    private function fillComponent($appKey, $articCatId, $itemKey, $number, $amountStandard, $periodicity=null, $image='arma_4.png', $active= true)
    {
        $obj = new Article();

        $media = $this->sonataCreateMediaImageFromDir(__DIR__.'/img/'.$image, Article::SONATA_CONTEXT);

        $obj
            ->setApp($this->getReference('app-'.$appKey))
            ->setArticleCategory($this->getReference('article_category-'.$articCatId))
            ->setItem($this->getReference('item-'.$itemKey))
            ->setItemsQuantity($number)
            ->setPeriodicity($periodicity)
            ->setImage($media)
            ->setActive($active)
            ->setAmountStandard($amountStandard)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('article-'.$appKey.'-'.$articCatId.'-'.$number, $obj);

        return $obj;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 300; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
