<?php

namespace AppBundle\Admin;

/**
 * Not used
 */

use AppBundle\Command\OfferCommand;
use AppBundle\Entity\Article;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Entity\Repository\AppShopRepository;
use AppBundle\Entity\Repository\TransUnitRepositoryStatic;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class OfferProgrammerAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_OfferProgrammer';
    protected $baseRoutePattern = 'OfferProgrammerAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('articles')
            ->add('app')
            ->add('name')
            ->add('offerFrom')
            ->add('offerTo')
            ->add('createdAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('app')
            ->add('name')
            ->add('limitPurchases')
            ->add('limitPerUsed')
            ->add('timesUsed')

            ->add('offerFrom')
            ->add('offerTo')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
//                    'edit' => array(),
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
        /** @var OfferProgrammer $subject */
        $subject = $this->getSubject();
        $app= null;

        /** @var Article $parent */
        if (($parent = $this->getRoot()->getSubject()) instanceof Article)
        {
            $app= $parent->getApp();
        }else if ($subject && $subject->getAppShop() && $subject->getAppShop()->getApp()){
            $app= $subject->getAppShop()->getApp();
        }

        if (!$this->getRoot()->getSubject() instanceof Article)
        {
            $formMapper
                ->add('article', null, ['disabled' => (!$subject || !$subject->getArticle()? false : true ) ])
            ;
        }

        $queryLabel = null;

        if ($app)
        {
            $om = $this->modelManager->getEntityManager($app);
            $queryAppShop = $om->createQuery(AppShopRepository::sqlFindByApp())->setParameter('appId', $parent->getApp()->getId());
            $formMapper
                ->add('appShop', 'sonata_type_model', array('query' => $queryAppShop, 'btn_add' => false, 'required' =>  false))
            ;

            $queryLabel = $om->createQuery(TransUnitRepositoryStatic::sqlFindByDomain())->setParameter('domain', $parent->getApp()->getTranslationDomain());
        }

        $formMapper
            ->add('country', null, ['help' => 'if its empty offer will be affected to all countries of this article'])
            ->add('offer')
            ->add('offerFrom')
            ->add('offerTo')
            ->add('offerFrom', 'sonata_type_datetime_picker', array('required' => false))
            ->add('offerTo', 'sonata_type_datetime_picker', array('required' => false))
            ->add('offerImg', 'sonata_media_type', [
                    'required' => false,
                    'provider' => 'sonata.media.provider.image',
                    'context'  => OfferProgrammer::SONATA_CONTEXT,
                    'new_on_update' => false,
                    'help' => 'overwrite image from article',
                ])
            ->add('nameLabel', 'sonata_type_model', [
                    'property' => 'key',
                    'query' => $queryLabel,
                    'required' =>  false
                ]
            )
            ->add('descriptionLabel', 'sonata_type_model', [
                    'property' => 'key',
                    'query' => $queryLabel,
                    'required' =>  false
                ]
            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('app')
            ->add('limitPurchases')
            ->add('limitPerUsed')
            ->add('timesUsed')
            ->add('articles')
            ->add('countries')
            ->add('appShops')
            ->add('prettyPrice')
            ->add('quantityExtraPercent')
            ->add('offerFrom')
            ->add('offerTo')
            ->add('offerImg')
            ->add('nameLabel')
            ->add('descriptionLabel')
            ->add('createdAt')
        ;
    }

    /**
     * @param OfferProgrammer $obj
     * @return mixed|void
     */
    function postPersist($obj)
    {
        $this->reconfigureAllOffers($obj->getArticle());
    }

    /**
     * @param OfferProgrammer $obj
     * @return mixed|void
     */
    function postUpdate($obj)
    {
        $this->reconfigureAllOffers($obj->getArticle());
    }

    /**
     * @param Article $object
     */
    private function reconfigureAllOffers($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        /** @var OfferCommand $offerCommand */
        $offerCommand = $container->get('command.shop.offer.sync');
        $offerCommand->reconfigureAllOffers($object->getId());
    }
}
