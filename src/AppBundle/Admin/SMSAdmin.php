<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Repository\PayMethodProviderHasCountryRepository;
use AppBundle\Entity\Repository\TransUnitRepositoryStatic;
use AppBundle\Entity\SMS;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SMSAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_SMS';
    protected $baseRoutePattern = 'SMSAdmin';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('aliasDefault')
            ->add('shortNumber')
            ->add('operator')
            ->add('amount')
            ->add('smsLogicCategory')
            ->add('payMethodProviderHasCountry.payMethodHasProvider.provider', null, ['label' => 'Provider'])
            ->add('payMethodProviderHasCountry.country', null, ['label' => 'Country'])
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
            ->add('operator')
            ->add('aliasDefault')
            ->add('payMethodProviderHasCountry.payMethodHasProvider.provider.name', null, ['label' => 'Provider'])
            ->add('shortNumber')
            ->add('amount')
            ->add('smsLogicCategory')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'Copy' => [
                        'template' => '@App/Sonata/SMS/list__action_copy.html.twig'
                    ],
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $om = $this->getEntityManager();
        $queryLabel = $om->createQuery(TransUnitRepositoryStatic::sqlFindByDomain())->setParameter('domain', 'sms');
        $queryPMPC = $om->createQuery(PayMethodProviderHasCountryRepository::sqlFindByPayCategoriesIds())->setParameter('payCategories', PayCategoryEnum::MOBILE_ID);

        $formMapper
            ->add('aliasDefault')
            ->add('shortNumber')
            ->add('amount')
            ->add('payMethodProviderHasCountry', 'sonata_type_model', ['query' => $queryPMPC, 'btn_add'=> false])
            ->add('operator')
            ->add('smsAlias')
            ->add('smsLogicCategory')
            ->add('legalTextLabel', 'sonata_type_model', [
                    'property' => 'key',
                    'query' => $queryLabel,
                    'required' => false,
                    'help' => 'Text below the web page. Write sms as domain'
                ])
            ->add('mobileTextSingUpLabel', 'sonata_type_model', [
                    'property' => 'key',
                    'query' => $queryLabel,
                    'required' => false,
                    'help' => 'Text will sent to gamer. Write sms as domain'
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
            ->add('id')
            ->add('aliasDefault')
            ->add('shortNumber')
            ->add('amount')
            ->add('operator')
            ->add('legalTextLabel')
            ->add('smsLogicCategory')
            ->add('createdAt')
        ;
    }

    public function getNewInstance()
    {
        /** @var SMS $obj */
        $obj=parent::getNewInstance();

        if (isset($_GET['copy_id']))
        {
            $em = $this->getEntityManager();
            if ($sms = $em->getRepository("AppBundle:SMS")->find($_GET['copy_id']))
            {
                $obj
                    ->setAliasDefault($sms->getAliasDefault())
                    ->setAmount($sms->getAmount())
                    ->setCheckBoxLabel($sms->getCheckBoxLabel())
                    ->setMobileTextSingUpLabel($sms->getMobileTextSingUpLabel())
                    ->setLegalTextLabel($sms->getLegalTextLabel())
                    ->setPayMethodProviderHasCountry($sms->getPayMethodProviderHasCountry())
                    ->setOperator($sms->getOperator())
                    ->setShortNumber($sms->getShortNumber())
                    ->setSmsLogicCategory($sms->getSmsLogicCategory())
                ;
            }
        }

        return $obj;
    }
}
