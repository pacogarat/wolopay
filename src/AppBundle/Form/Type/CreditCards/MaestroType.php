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

class MaestroType extends AbstractCreditCardType
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'credit_card_maestro';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\NotPersisted\CreditCards\Maestro',
                'card_number_data_mask' =>  '9999 9999 9999 9999',
                'card_number_place_holder' =>  '____ ____ ____ ____',
            ));
    }


}