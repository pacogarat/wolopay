<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Repository\PayMethodProviderHasCountryRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class VoiceAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_Voice';
    protected $baseRoutePattern = 'VoiceAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('payMethodProviderHasCountry')
            ->add('number')
            ->add('amount')
            ->add('callMaxDuration')
            ->add('callLegalDuration')
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
            ->add('payMethodProviderHasCountry')
            ->add('number')
            ->add('amount')
            ->add('callMaxDuration')
            ->add('callLegalDuration')
            ->add('createdAt')
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
        $om = $this->getEntityManager();
        $queryPMPC = $om->createQuery(PayMethodProviderHasCountryRepository::sqlFindByPayCategoriesIds())->setParameter('payCategories', PayCategoryEnum::VOICE_ID);

        $formMapper
            ->add('payMethodProviderHasCountry', 'sonata_type_model', ['query' => $queryPMPC, 'btn_add'=> false])
            ->add('number')
            ->add('amount')
            ->add('callMaxDuration')
            ->add('callLegalDuration')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('payMethodProviderHasCountry')
            ->add('number')
            ->add('amount')
            ->add('callMaxDuration')
            ->add('callLegalDuration')
            ->add('createdAt')
        ;
    }
}
