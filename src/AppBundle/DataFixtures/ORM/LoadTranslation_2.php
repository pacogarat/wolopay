<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\App;
use Doctrine\Common\Persistence\ObjectManager;


class LoadTranslation_2 extends LoadTranslation
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        /** @var App $obj */
        $obj = $this->getReference('app-GalleGame');

        $this->fillComponent ('gunner_title', $obj->getTranslationDomain(), '{[{number}]} Pro Gun','{[{number}]} Metraca');
        $this->fillComponent ('gunner_desc', $obj->getTranslationDomain(), 'The best weapon of the game COOL!','La mejor arma del juego muy guapa!');

        $this->fillComponent ('gunner2_title', $obj->getTranslationDomain(), '{[{number}]} Pro Gun 2','{[{number}]} Metraca 2');
        $this->fillComponent ('gunner2_desc', $obj->getTranslationDomain(), 'Second best weapon of the game amazing!','La segunda mejor arma del juego impresionante!');

        /** @var App $app */
        $app=$this->getReference('app-Demo');

        $this->fillComponent ('granade_title',$app->getTranslationDomain(),'{[{number}]} Granades','{[{number}]} Granadas');
        $this->fillComponent ('granade_desc',$app->getTranslationDomain(),'Son {[{number}]} potententes granadas','{[{number}]} granades, powerfull weapon');

        $this->fillComponent ('pistol_title', $app->getTranslationDomain(),'{[{number}]} Eagle Pistol','{[{number}]} Pistola Alcón');
        $this->fillComponent ('pistol_desc', $app->getTranslationDomain(),'{[{number}]} Pistol with great accuracy','{[{number}]} Buenos headshotes si apuntas despacio');

        $this->fillComponent ('article.gacha.name','shop', 'Gacha','Gacha');
        $this->fillComponent ('article.gacha.description','shop', 'Gacha description','Gacha  description');

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 203; // the order in which fixtures will be loaded
    }
} 