<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactSimpleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required'    => true,
                'constraints' => array(
                    new NotBlank(),
                ),
                'attr' => array(
                    'placeholder' => 'forms.contact_simple.name.placeholder',
                    ),
                )
            )
            ->add('email', EmailType::class, array(
                    'required'    => true,
                    'constraints' => array(
                        new NotBlank(),
                    ),
                    'attr' => array(
                        'placeholder' => 'forms.contact_simple.email.placeholder',
                    ),
                )
            )
            ->add('phone', TextType::class, array(
                    'required'    => false,
                    'attr' => array(
                        'placeholder' => 'forms.contact_simple.phone.placeholder',
                    ),
                )
            )
            ->add('message', TextareaType::class, array(
                    'required' => true,
                    'constraints' => array(
                        new NotBlank(),
                    ),
                    'attr' => array(
                        'placeholder' => 'forms.contact_simple.message.placeholder',
                        'rows' => 9
                    ),
                )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'translation_domain' => 'default'
            )
        );
    }

} 