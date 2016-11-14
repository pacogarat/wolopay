<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type\CreditCards;

use AppBundle\Entity\NotPersisted\CreditCards\AbstractCreditCard;
use AppBundle\Form\DataTransformer\CreditCardNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbstractCreditCardType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('cardNumber', null, ['attr' => ['data-mask' => $options['card_number_data_mask'], 'placeholder'=>$options['card_number_place_holder'], 'tabindex' => 1]])
            ->add('expireDate', null, ['attr' => ['data-mask' => '99/9999', 'placeholder'=>'mm/yyyy', 'tabindex' => 2]])
            ->add('ownerFirstName', null, ['attr' => ['tabindex' => 3]])
            ->add('ownerLastName', null, ['attr' => ['tabindex' => 4]])
            ->add('cvv', null, ['attr' => ['tabindex' => 5]])
        ;

        $formBuilder->get('cardNumber')->addModelTransformer(new CreditCardNumberTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'credit_card';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\NotPersisted\CreditCards\AbstractCreditCard',
                'card_number_data_mask' =>  '',
                'card_number_place_holder' =>  '',
            ));
    }
}