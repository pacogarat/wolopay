<?php


namespace AppBundle\Traits;


use Application\Sonata\MediaBundle\Entity\Media;
use Sonata\MediaBundle\Entity\MediaManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

Trait SonataMedia
{

    /**
     * @param Media $media
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    protected function sonataRemoveImage(Media $media = null, ContainerInterface $container = null)
    {
        if (!$media)
            return;

        /** @var ContainerInterface $container */
        $container = $container ?: $this->container;

        /** @var MediaManager $mediaManager */
        $mediaManager = $container->get('sonata.media.manager.media');

        //assuming you have access through $this->get to the service container
        $provider = $container->get($media->getProviderName());
        $provider->removeThumbnails($media);
        $mediaManager->delete($media);
    }

    protected function sonataCreateMediaImageFromUploadedFile(UploadedFile $uploadedFile, $context, ContainerInterface $container = null, $provider = 'sonata.media.provider.image')
    {
        return $this->createMediaImage($uploadedFile, $context, $container, $provider);
    }

    protected function sonataCreateMediaImageFromDir($dir, $context, ContainerInterface $container = null, $provider = 'sonata.media.provider.image')
    {
        return $this->createMediaImage($dir, $context, $container, $provider);
    }

    private function createMediaImage($binaryContent, $context, ContainerInterface $container = null, $provider = 'sonata.media.provider.image')
    {
        /** @var ContainerInterface $container */
        $container = $container ?: $this->container;

        /** @var MediaManager $mediaManager */
        $mediaManager = $container->get('sonata.media.manager.media');

        $media = new Media();

        $media->setBinaryContent($binaryContent);
        $media->setContext($context);
        $media->setProviderName($provider);
        $mediaManager->save($media, false);

        return $media;
    }
} 