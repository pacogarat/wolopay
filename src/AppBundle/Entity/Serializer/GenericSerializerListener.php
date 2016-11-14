<?php


namespace AppBundle\Entity\Serializer;

use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Router;

/**
 * Add data after serialization
 *
 * @Service("nvia.shop_app.listener.transaction_serializer_listener")
 * @Tag("jms_serializer.event_subscriber")
 */
class GenericSerializerListener implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface
     * @Inject("service_container")
     */
    public $container;

    /**
     * @var Router
     * @Inject("router")
     */
    public $router;

    /**
     * @var RequestStack
     * @Inject("request_stack")
     */
    public $requestStack;

    /**
     * @var EntityManager
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var string
     * @Inject("%locale_available%")
     */
    public $localeAvailable;

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event' => 'serializer.pre_serialize',
                'class' => 'AppBundle\Entity\Transaction',
                'method' => 'onPreSerializeTransaction',
            ),
            array(
                'event' => 'serializer.post_serialize',
                'class' => 'Lexik\Bundle\TranslationBundle\Entity\TransUnit',
                'method' => 'onPostSerializeTransUnit',
            ),
        );
    }


    /**
     * Handles the serialization of an Image object
     *
     * @param \JMS\Serializer\EventDispatcher\ObjectEvent $event
     * @return array
     */
    public function onPreSerializeTransaction(ObjectEvent $event)
    {
        /** @var Transaction $transaction */
        $transaction = $event->getObject();

        $url = $this->container->getParameter('domain_main')
            . $this->router->generate('shop_index', array('transaction_id' => $transaction->getId()));

        $urlJs = $this->container->getParameter('domain_main')
            . $this->router->generate('shop_index_js', array('transaction_id' => $transaction->getId()));

        $transaction
            ->setUrl($url)
            ->setUrlJs($urlJs)
        ;
    }

    public function onPostSerializeTransUnit(ObjectEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        if ($request->get('IgnoreTranslations'))
            return;

        $groups = ($event->getContext()->attributes->get('groups')->isDefined() ? $event->getContext()->attributes->get('groups')->get() : []);

        if (in_array('Public', $groups) || in_array('allTranslations', $groups))
        {
            //see what our visitor supports...
            $visitor= $event->getVisitor();
            /** @var TransUnit $transUnit */
            $transUnit = $event->getObject();

            $translation = null;
            $translations = [];


            if (in_array('Public', $groups))
            {

                if ($transUnit->hasTranslation($request->getLocale()))
                    $translation = $transUnit->getTranslation($request->getLocale())->getContent();
                else
                    $translation = $transUnit->getTranslation(LanguageEnum::ENGLISH)->getContent();

            }else{

                foreach ($this->localeAvailable as $lang)
                {
                    if ($transUnit->hasTranslation($lang))
                        $translations[$lang]= $transUnit->getTranslation($lang)->getContent();
                }
            }

            if ($visitor instanceof \JMS\Serializer\XmlSerializationVisitor)
            {
                //do XML things
                $doc=$visitor->getDocument();
                $currentNode=$visitor->getCurrentNode();

                if ($translation)
                {
                    $currentNode->appendChild($doc->createCDATASection($translation));
                }else{

                    foreach ($translations as $lang=>$translation)
                    {
                        $node = $doc->createElement('translation_'.$lang);
                        $node->appendChild($doc->createCDATASection($translation));

                        $currentNode->appendChild($node);
                    }
                }
            } elseif ($visitor instanceof \JMS\Serializer\JsonSerializationVisitor) {

                if ($translation)
                {
                    $visitor->addData('translation', $translation);

                }else{

                    foreach ($translations as $lang=>$translation)
                    {
                        $visitor->addData('translation_'.$lang, $translation );
                    }
                }


            } elseif ($visitor instanceof \JMS\Serializer\GenericSerializationVisitor) {

                if ($translation)
                {
                    $visitor->addData('translation', $translation);

                }else{

                    foreach ($translations as $lang=>$translation)
                    {
                        $visitor->addData('translation_'.$lang, $translation );
                    }
                }


            }

        }
    }

}