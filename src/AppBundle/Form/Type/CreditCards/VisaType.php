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

use Symfony\Component\OptionsResolver\OptionsResolver;

class VisaType extends AbstractCreditCardType
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'credit_card_visa';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\NotPersisted\CreditCards\Visa',
                'card_number_data_mask' =>  '4999 9999 9999 9999',
                'card_number_place_holder' =>  '4___ ____ ____ ____',
            ));
    }


}