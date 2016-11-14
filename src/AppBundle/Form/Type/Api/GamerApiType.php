<?php

namespace AppBundle\Form\Type\Api;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GamerApiType extends AbstractApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gamer_id', null, ['description' => 'Id of your user', 'property_path' => 'gamerExternalId', 'required' => true])
            ->add('affiliate_id', null, ['description' => 'Id of the affiliate who generated the user lead', 'property_path' => 'externalAffiliateId', 'required' => false])
            ->add('steam_id', null, ['description' => 'Id of the user IN STEAM', 'property_path' => 'steamId', 'required' => false])
            ->add('email', null, ['description' => 'Email of your user, some providers needs email'])
            ->add('name', null, ['description' => 'Real name of your user'])
            ->add('surname', null, ['description' => 'Real surname of your user'])
            ->add('birthdate', null, ['description' => 'Date of birth of the user (ISO8601 format, i.e: YYYY-mm-dd)'])
            ->add('gender', null,  ['description' => 'Gender of the user (ISO/IEC 5218, i.e: 0 for Unknown, 1 for Male, 2 for Female, 9 for Not applicable)'])
            ->add('registration_date', null,  ['description' => 'Date that the user registered in the game)', 'property_path'=>'registrationDateInGame'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Gamer',
            ));

        parent::configureOptions($resolver);
    }

}
