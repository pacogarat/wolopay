<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('name')
            ->add('urlHomeSite')
            ->add('urlLogo')
            ->add('urlNotificationPayment')
            ->add('urlNotificationSubscription')
            ->add('urlExtra')
            ->add('active')
            ->add('payMethodProviderCountryHasApps', 'paymethod_config_form_type', array(
                    'data_class' => 'AppBundle\Entity\PayMethodProviderHasCountry'
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\App',
                'rescue_engines' => array()
            ));
    }
}