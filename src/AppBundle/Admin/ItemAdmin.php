<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Item;
use AppBundle\Entity\Repository\TransUnitRepositoryStatic;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ItemAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Item';
    protected $baseRoutePattern = 'ItemAdmin';
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'createdAt'  // name of the ordered field
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('app')
            ->add('name')
            ->add('createdAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('app')
            ->add('name')
            ->add('image')
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
        /** @var Item $subject */
        $subject = $this->getSubject();

        if (isset($_GET['pcode']) && isset($_SESSION['app_id']) && $_GET['pcode'] === 'nvia_shop_app.admin.article')
        {
            $appId=$_SESSION['app_id'];

            $om = $this->getEntityManager();
            $app= $om->getRepository("AppBundle:App")->find($appId);

            $queryLabel = $om->createQuery(TransUnitRepositoryStatic::sqlFindByDomain())->setParameter('domain', $app->getTranslationDomain());

            $formMapper
              ->add('app', null, array('read_only' => true, 'disabled'  => false))
              ->add('nameLabel', 'sonata_type_model', array('query' => $queryLabel, 'property'=>'key'))
              ->add('descriptionLabel', 'sonata_type_model', array('query' => $queryLabel, 'property'=>'key'))
            ;
        }else{

            $formMapper
              ->add('app')
              ->add('nameLabel', 'sonata_type_model_list')
              ->add('descriptionLabel', 'sonata_type_model_list')
            ;
        }
//        ld($this->getRoot());
//        ld($subject);

        $formMapper
            ->add('name')
            ->add('image', 'sonata_media_type', [
                    'required' => ($subject && $subject->getId() ? false : true ),
                    'provider' => 'sonata.media.provider.image',
                    'context'  => Item::SONATA_CONTEXT,
                    'new_on_update' => false,
                ])


        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('createdAt')
        ;
    }

    /**
     * @param Item $object
     * @return Metadata|\Sonata\CoreBundle\Model\Metadata
     */
    public function getObjectMetadata($object)
    {
        $image = $object->getImage();
        $provider = $this->container->get($image->getProviderName());

        $url = $provider->generatePublicUrl($image, $provider->getFormatName($image, 'admin'));

        return new Metadata(
            $object->getName(),
            $object->getDescriptionLabel()->getKey(),
            $url
        );
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getNewInstance()
    {
        $obj=parent::getNewInstance();

        if (isset($_GET['pcode']) && isset($_SESSION['app_id']) && $_GET['pcode'] === 'nvia_shop_app.admin.article')
        {
            $appId=$_SESSION['app_id'];

            $om = $this->getEntityManager();
            if ($app= $om->getRepository("AppBundle:App")->find($appId))
                $obj->setApp($app);
        }

        return $obj;
    }
}
