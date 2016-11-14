<?php


namespace Application\Sonata\MediaBundle\Entity\Serializer;

use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Inline;

/**
 * Add data after serialization
 *
 * @Service("application.sonata.listener.serialization_listener")
 * @Tag("jms_serializer.subscribing_handler")
 */
class MediaSerializer implements SubscribingHandlerInterface
{
    /**
     * @var ContainerInterface
     * @Inject("service_container")
     */
    public $container;


    /**
     * @return array
     */
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'serializeImageToJson',
            ),
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'xml',
                'type' => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'serializeImageToXml',
            ),
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'yml',
                'type' => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'serializeImageToYml',
            ),
        );
    }

    private function  getUrlImage(MediaInterface $media)
    {
        $provider = $this->container->get($media->getProviderName());

        $format = 'reference';
        if ($provider instanceof \Sonata\MediaBundle\Provider\ImageProvider)
            $format = $media->getContext() . '_shop';

        return $provider->generatePublicUrl($media, $format);
    }


    /**
     * Handles the serialization of an Image object
     *
     * @param \JMS\Serializer\JsonSerializationVisitor $visitor
     * @param \Sonata\MediaBundle\Model\MediaInterface $media
     * @param array $type
     * @param Context $context
     * @return array
     */
    public function serializeImageToJson($visitor, MediaInterface $media, array $type, Context $context)
    {
        if (!$media->getProviderName()) {
            return array();
        }

        $url = $this->getUrlImage($media);

        return array(
            'img' => $url,
        );
    }

    /**
     * Handles the serialization of an Image object
     *
     * @param \JMS\Serializer\XmlSerializationVisitor $visitor
     * @param \Sonata\MediaBundle\Model\MediaInterface $media
     * @param array $type
     * @param Context $context
     * @return array
     */
    public function serializeImageToXml($visitor, MediaInterface $media, array $type, Context $context)
    {
        if (!$media->getProviderName()) {
            return null;
        }

        $url = $this->getUrlImage($media);

        return $visitor->document->createElement('img', $url);
    }

    /**
     * Handles the serialization of an Image object
     *
     * @param \JMS\Serializer\YamlSerializationVisitor $visitor
     * @param \Sonata\MediaBundle\Model\MediaInterface $media
     * @param array $type
     * @param Context $context
     * @return array
     */
    public function serializeImageToYml($visitor, MediaInterface $media, array $type, Context $context)
    {
        if (!$media->getProviderName()) {
            return null;
        }

        $url = $this->getUrlImage($media);

        return Inline::dump($url);
    }
}