<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\PayMethodHasProvider;
use AppBundle\Entity\PayMethodProviderHasCountry;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PayMethodHasProviderAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_PayMethodHasProvider';
    protected $baseRoutePattern = 'PayMethodHasProviderAdmin';
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'order'  // name of the ordered field
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('provider.name', null, ['label' => 'Provider Name'])
            ->add('payMethod.name', null,['label' => 'Pay Method'])
            ->add('payMethod.payCategory')
            ->add('feeProviderPercent')
            ->add('feeProviderMinimal')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('provider.name')
            ->add('payMethod.name', null,['label' => 'Pay Method'])
            ->add('payMethod.payCategory.name', null, ['label' => 'Pay Category'])
            ->add('payMethod.articleCategory.name', null,['label' => 'Article Category'])
            ->add('name')
            ->add('paymentServiceCategory.name')
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
        /** @var PayMethodHasProvider $subject */
        $subject = $this->getSubject();

        $formMapper
            ->add('payMethod', 'sonata_type_model_list')
            ->add('provider', 'sonata_type_model_list')
            ->add('name')
            ->add('feeProviderPercent')
            ->add('feeProviderMinimal')
            ->add('feeProviderFixed')
            ->add('feeCurrency')
            ->add('feeCalculatedWithNet')

            ->add('priceSentNet')

            ->add('paymentServiceCategory', null, ['help' => 'service to process this payment'])
//            ->add('extraOptions')
            ->add('order')
            ->add('isAjax')
            ->add('isIframe')
            ->add('isServer2Server')
            ->add('needMakeRequestPayment')
            ->add('externalStore')
            ->add('active')

        ;

        if ($subject && $subject->getId())
        {
            $formMapper
                ->add('payMethodProviderHasCountries', 'sonata_type_collection', array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table'))
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('payMethod', 'sonata_type_model_list')
            ->add('provider', 'sonata_type_model_list')
            ->add('name')
            ->add('articleCategory')
            ->add('feeProviderPercent')
            ->add('feeProviderMinimal')
            ->add('feeProviderFixed')
            ->add('feeCurrency')
            ->add('feeCalculatedWithNet')

            ->add('priceSentNet')

            ->add('paymentServiceCategory', null, ['help' => 'service to process this payment'])
//            ->add('extraOptions')
            ->add('order')
            ->add('isAjax')
            ->add('isIframe')
            ->add('isServer2Server')
            ->add('needMakeRequestPayment')
            ->add('active')
            ->add('payMethodProviderHasCountries', 'sonata_type_collection')

        ;
    }

    /**
     * @param PayMethodHasProvider $payMethodHasProvider
     * @return mixed|void
     */
    public function preUpdate($payMethodHasProvider)
    {
        foreach ($payMethodHasProvider->getPayMethodProviderHasCountries() as $hasCountries)
        {
            $hasCountries->setPayMethodHasProvider($payMethodHasProvider);
        }

        $this->setArrayOptionsField($payMethodHasProvider);
    }

    /**
     * @param PayMethodHasProvider $object
     * @return mixed|void
     */
    public function prePersist($object)
    {
        $currencies = $object->getProvider()->getCurrenciesAvailable();

        if ($currencies->isEmpty())
            return;

        $currencyDefault = $currencies[0];

        $em=$this->getEntityManager();
        $countries = $em->getRepository("AppBundle:Country")->findAll();
        $euro = $em->getRepository("AppBundle:Currency")->find(CurrencyEnum::EURO);
        $dollar = $em->getRepository("AppBundle:Currency")->find(CurrencyEnum::DOLLAR);

        foreach ($countries as $country)
        {
            $PMPC = new PayMethodProviderHasCountry();
            $PMPC->setCountry($country);

            $PMPC->setCurrency($currencyDefault);
            if ($currencies->contains($country->getCurrency()))
            {
                $PMPC->setCurrency($country->getCurrency());

            }else if ($currencies->contains($dollar)){

                $PMPC->setCurrency($dollar);
            }else if ($currencies->contains($euro)){

                $PMPC->setCurrency($euro);
            }

            $object->addPayMethodProviderHasCountry($PMPC);
        }

        $this->setArrayOptionsField($object);
    }

    private function setArrayOptionsField(PayMethodHasProvider $object)
    {
//        if (!is_array($object->getExtraOptions()))
//            $object->setExtraOptions(json_decode( $object->getExtraOptions()));
    }


    /**
     * @param PayMethodHasProvider $object
     * @return Metadata|\Sonata\CoreBundle\Model\Metadata
     */
    public function getObjectMetadata($object)
    {
        $image = $object->getPayMethod()->getImgIcon();
        $provider = $this->container->get($image->getProviderName());

        $url = $provider->generatePublicUrl($image, $provider->getFormatName($image, 'admin'));

        return new Metadata(
            $object->getProvider()->getId(),
            null,
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
}
