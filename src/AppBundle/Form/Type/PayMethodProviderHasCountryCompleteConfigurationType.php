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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PayMethodProviderHasCountryCompleteConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                file_put_contents('/var/www/wolopay/var/logs/t.log', 'FF');
        });

        $formBuilder
            ->add('country', null, ['label' => 'Country'])
            ->add('currency', null, [
                    'label' => 'Currency',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($options) {

                            if ($options['provider_id'])
                            {

                                return
                                    $er
                                        ->createQueryBuilder('q')
                                        ->innerJoin('AppBundle:Provider', 'p', 'WITH', '1 = 1')
                                        ->innerJoin('p.currenciesAvailable', 'c', 'WITH', 'c.id = q.id')
                                        ->where('p.id = :providerId')
                                        ->setParameter('providerId', $options['provider_id'])
                                    ;
                            }

                    }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\PayMethodProviderHasCountry',
                'provider_id' => null,
            ));
    }
}