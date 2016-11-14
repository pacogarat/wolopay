<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class PurchaseByPinGenericType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pin', TextType::class, ['constraints' => [new NotNull(), new Length(['min' => 4, 'max' => 30])]])
            ->add('serial', TextType::class, ['constraints' => [new NotNull(), new Length(['min' => 4, 'max' => 20])]])
//      todo      ->add('captcha', 'captcha', ['label' => false, 'attr' => ['placeholder' => 'Captcha']])
        ;
    }

} 