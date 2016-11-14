<?php

namespace AppBundle\Form\Type;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GamerEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null,  ['label' => 'form.gamer_email_type.email.label'])
//            ->add('captcha', CaptchaType::class, ['label' => false, 'attr' => ['placeholder' => 'Captcha']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'AppBundle\Entity\Gamer']
        )
        ;
    }

} 