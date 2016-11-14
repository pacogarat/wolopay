<?php

namespace AppBundle\Admin;

use AppBundle\Entity\PayMethodHasProvider;
use AppBundle\Entity\PayMethodProviderHasCountry;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PayMethodProviderHasCountryAdmin extends AbstractParentAdmin
{
    public $last_position = 0;
    /** @var  \Pix\SortableBehaviorBundle\Services\PositionHandler */
    private $positionService;

    protected $baseRouteName = 'admin_app_bundle_PayMethodProviderHasCountry';
    protected $baseRoutePattern = 'PayMethodProviderHasCountryAdmin';

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'order',
    );
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('payMethodHasProvider')
            ->add('country')
            ->add('currency')
            ->add('createdAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $this->last_position = $this->positionService->getLastPosition(PayMethodProviderHasCountry::class);

        $listMapper
            ->add('id')
            ->add('payMethodHasProvider')
            ->add('country')
            ->add('currency')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'move' => array(
                        'template' => 'PixSortableBehaviorBundle:Default:_sort.html.twig'
                    ),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var PayMethodHasProvider $subject */
        $subject = $this->getRoot()->getSubject();
        $om = $this->getEntityManager();
        $currencyOptions= [];

        if ($subject instanceof PayMethodHasProvider && $subject->getId())
        {
            $currencyOptions['query_builder'] = function(EntityRepository $er ) use ($subject) {
                return $er->createQueryBuilder('c')
                    ->where('c.id in (
                        select cur.id
                        from AppBundle:Provider p
                        JOIN p.currenciesAvailable cur
                        where p.id = :providerId)')
                    ->setParameter('providerId', $subject->getProvider()->getId() );
            };
        }else{

            $formMapper->add('payMethodHasProvider');
        }

        $formMapper
            ->add('country')
            ->add('currency', null , $currencyOptions)
            ->add('default')
            ->add('active')
            ->add('feeProviderPercent', null, ['help' => 'Override to payMethodHasProvider'])
            ->add('feeProviderMinimal', null, ['help' => 'Override to payMethodHasProvider'])
            ->add('feeProviderFixed', null, ['help' => 'Override to payMethodHasProvider'])
            ->add('feeCurrency', null, ['help' => 'Override to payMethodHasProvider'])
        
            ->add('priceSentNet', null, ['help' => 'Override to payMethodHasProvider'])
            ->add('feeCalculatedWithNet', null, ['help' => 'Override to payMethodHasProvider'])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('country')
            ->add('currency')
            ->add('keyword')
            ->add('createdAt')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('move', $this->getRouterIdParameter().'/move/{position}');
    }

    public function setPositionService(\Pix\SortableBehaviorBundle\Services\PositionHandler $positionHandler)
    {
        $this->positionService = $positionHandler;
    }

}
