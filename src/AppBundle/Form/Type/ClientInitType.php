<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Country;
use Doctrine\ORM\EntityManager;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientInitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        /** @var EntityManager $em */
        $em = $options['em'];

        $faker = \Faker\Factory::create();

        $formBuilder
            ->add('userName', TextType::class, ['attr'=> ['placeholder' => $faker->name ]])
            ->add('email', EmailType::class, ['attr'=> ['placeholder' => $faker->email ]])
            ->add('companyName', TextType::class, ['attr'=> ['placeholder' => $faker->company ]])
            ->add('companyCountry', ChoiceType::class, [
                    'choice_list' => new ArrayChoiceList($em->getRepository("AppBundle:Country")->findBy([],['name' => 'asc'])),
                    'choice_label' => function(Country $country, $key, $index) {
                        return $country->getName();
                    },
                    'group_by' => function(Country $country, $key, $index) {
                        return $country->getContinent()->getName();
                    },
                ])
            ->add('gameUrl', UrlType::class, ['attr'=> ['placeholder' => 'https://'.$faker->domainName ]])
            ->add('text', TextareaType::class, ['required' => false, 'attr'=> ['placeholder' => '' ]])
            ->add('captcha', CaptchaType::class, ['attr' => ['placeholder' => 'Captcha']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'em'         => null,
                'translation_domain' => false,
            ));
    }
}