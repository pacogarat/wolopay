<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lexik\Bundle\TranslationBundle\Entity\Translation;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;


class LoadTranslation extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->om = $manager;

        $this->fillComponent ('article_categories.single.name','shop', 'Single Payments','Pagos únicos');
        $this->fillComponent ('article_categories.subscription.name','shop', 'Subscription','Subscripciones');
        $this->fillComponent ('article_categories.phone.name','shop', 'Phone Payments','Pagos con teléfono');
        $this->fillComponent ('article_categories.free.name','shop', 'Free purchases','Compras gratuitos');


        $this->fillComponent ('article_categories.single.description','shop', 'Single Payments','Pagos únicos');
        $this->fillComponent ('article_categories.subscription.description','shop', 'Subscription','Subscripciones');
        $this->fillComponent ('article_categories.phone.description','shop', 'Phone Payments','Pagos con teléfono');
        $this->fillComponent ('article_categories.free.description','shop', 'Free purchases','Compras gratuitos');

        $this->fillComponent ('pay_method.standard.description','shop', 'Its a cool provider','Es una forma de pago muy buena!');


        // SMS
        $this->fillComponent ('sms.mobile_text_sing_up.write_pin', 'sms', 'Write #PIN# in website to continue','Introduce #PIN# en la web para continuar');
        $this->fillComponent ('sms.legal_text.standard', 'sms', 'This is not a subscription service. The amount of the message is %amount% %currency% tax included. A.T.S. SA Apdo. Correos 18070 Madrid 28080. informacion@atssa.es. Customer Atn. 902501737', 'Esto no es un servicio de suscripción. El precio del mensaje es %amount% %currency% impuestos incluidos. A.T.S. S.A. Apdo. Correos 18070 Madrid 28080. informacion@atssa.es. Atn. Cliente: 902501737');

    }

    protected  function fillComponent($idReference, $domain, $translationEn, $translationEs)
    {
        $obj = new TransUnit();

        $obj->setDomain($domain);
        $obj->setKey($idReference);

        $transEn = new Translation();
        $transEn->setLocale('en');

        $transEn->setContent($translationEn);

        $transEs = new Translation();
        $transEs->setLocale('es');
        $transEs->setContent($translationEs);

        $obj->addTranslation($transEn);
        $obj->addTranslation($transEs);

        $this->om->persist($obj);
        $this->om->flush();

        $this->addReference('translation-'.$idReference, $obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // the order in which fixtures will be loaded
    }
} 