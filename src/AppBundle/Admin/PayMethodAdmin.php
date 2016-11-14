<?php

namespace AppBundle\Admin;

use AppBundle\Entity\PayMethod;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class PayMethodAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_PayMethod';
    protected $baseRoutePattern = 'PayMethodAdmin';

    use ContainerAwareTrait;

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('payCategory')
            ->add('articleCategory')
            ->add('createdAt')
            ->add('imgIcon')
            ->add('name')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('payCategory')
            ->add('articleCategory')
            ->add('createdAt')
            ->add('imgIcon')
            ->add('name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        $formMapper
            ->add('payCategory')
            ->add('articleCategory')
            ->add('name')
            ->add('imgIcon', 'sonata_media_type', [
                    'required' => ($subject->getImgIcon() ? false : true),
                    'provider' => 'sonata.media.provider.image',
                    'context'  => PayMethod::SONATA_CONTEXT,
                    'new_on_update' => false,
                ]
            )
            ->add('descriptionLabel', 'sonata_type_model', [
                    'property' => 'key',
                    'required' => false,
                    'help' => 'Tooltip, IMPORTANT: set domain as "shop"'
                ])
            ->add('active')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('payCategory')
            ->add('articleCategory')
            ->add('createdAt')
        ;
    }


    /**
     * @param App $app
     * @return mixed|void
     */
    public function preUpdate($app)
    {

//        foreach ($app->ge() as $hasCountries)
//        {
//            $hasCountries->setPayMethodHasProvider($payMethodHasProvider);
//        }
    }

    /**
     * @param PayMethod $object
     * @return Metadata|\Sonata\CoreBundle\Model\Metadata
     */
    public function getObjectMetadata($object)
    {
        $image = $object->getImgIcon();
        $provider = $this->container->get($image->getProviderName());
        /** @var Translator $trans */
        $trans = $this->container->get('translator');

        $url = $provider->generatePublicUrl($image, $provider->getFormatName($image, 'admin'));

        return new Metadata(
            $object->getName(), // $trans->trans($object->getNameCurrentLabel()->getKey(),[], $object->getNameCurrentLabel()->getDomain()),
            $object->getName(), // $trans->trans($object->getDescriptionCurrentLabel()->getKey(),[], $object->getDescriptionCurrentLabel()->getDomain()),
            $url
        );
    }

}
