<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ArticleSpecialType;
use AppBundle\Entity\Enum\ArticleSpecialTypeEnum;
use AppBundle\Traits\SonataMedia;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadArticleSpecialType extends AbstractFixture implements OrderedFixtureInterface
{
    use SonataMedia;

    const NAME_1='Granade';
    const NAME_2='Pistol';

    const GALLE_1='Gunner';
    const GALLE_2='Gunner2';

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

        $this->fillComponent(ArticleSpecialTypeEnum::ARTICLE_GACHA_BOX, 'gacha box');
        $this->fillComponent(ArticleSpecialTypeEnum::ARTICLE_GACHA_STEP, 'gacha step');
        $this->fillComponent(ArticleSpecialTypeEnum::ARTICLE_PACK, 'pack');
        $this->fillComponent(ArticleSpecialTypeEnum::ARTICLE_RANDOM, 'random');

    }

    private function fillComponent($id, $name)
    {
        $obj = new ArticleSpecialType($id);

        $obj
            ->setName($name)
        ;

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('article_special_type-'.$id, $obj);
    }

    public function getOrder()
    {
        return 50; // the order in which fixtures will be loaded
    }


} 