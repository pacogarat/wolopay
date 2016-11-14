<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\PayMethodHasProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PayMethodCompleteConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('payMethod', null, ['label' => 'Pay Method'])
            ->add('provider', null, ['label' => 'Provider'])
            ->add('paymentServiceCategory', null, ['label' => 'Payment Service Category'])
            ->add('external_provider_id', TextType::class, ['mapped' => false, 'label' => 'External Provider Id', 'data' => null])
            ->add('order', IntegerType::class, ['data' => 100, 'label' => 'order'])
            ->add('feeProviderPercent', null, ['data' => 20, 'label' => 'fee Provider Percent'])
//            ->add('feeProviderFixed', null, ['data' => null, 'label' => 'fee Provider Fixed'])
            //            ->add('feeCurrency', null, ['data' => null, 'empty_data' => null, 'label' => 'fee Currency', 'required' => false])

            ->add('isIframe', null, ['data' => true, 'label' => 'is iframe'])

            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {

                /** @var PayMethodHasProvider $pmp */
                $pmp  = $event->getData();
                $form = $event->getForm();

                if ($form->get('external_provider_id')->getData())
                {
                    $pmp->setExtraOptions(
                        $pmp->getExtraOptions() + ['external_provider_id' => $form->get('external_provider_id')->getData()]
                    );
                }

            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\PayMethodHasProvider'
            ));
    }
}