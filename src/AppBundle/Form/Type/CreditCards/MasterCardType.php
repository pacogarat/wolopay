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

class MasterCardType extends AbstractCreditCardType
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'credit_card_master';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\NotPersisted\CreditCards\MasterCard',
                'card_number_data_mask' =>  '5999 9999 9999 9999',
                'card_number_place_holder' =>  '5___ ____ ____ ____',
            ));
    }


}