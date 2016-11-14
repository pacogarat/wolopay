<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\DataTransformer\TransactionIdToStringTransformer;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailGamerSupportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $transformer = new TransactionIdToStringTransformer($entityManager);

        $builder
            ->add(
                $builder->create('transaction', 'text',  [ 'read_only' => true, 'label' => false])
                    ->addModelTransformer($transformer)
            )
            ->add('name', null,  ['label' => false , 'attr' => ['placeholder' => 'form.support.gamer.name.label']])
            ->add('email', null,  ['label' => false , 'attr' => ['placeholder' => 'form.support.gamer.email.label']])
            ->add('mobile', null,  ['label' => false , 'attr' => ['placeholder' => 'form.support.gamer.mobile.label']])
            ->add('subject', 'choice', ['choices' => [
                    'ask' => 'form.support.gamer.subject.ask.label',
                    'ask_about_a_purchase'=> 'form.support.gamer.subject.purchase.label',
                    'suggestion'=> 'form.support.gamer.subject.suggestion.label',
                    'other'=> 'form.support.gamer.subject.other.label',
                ],
                'empty_value' => false,
                'label' => false,
                'attr' => ['placeholder' => 'form.support.gamer.name.label'] ,

            ])
            ->add('captcha', CaptchaType::class, ['label' => false, 'attr' => ['placeholder' => 'Captcha']])
            ->add('comment',  null, ['label' => false, 'attr' => ['placeholder' => 'form.support.gamer.comment.label'] ,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'AppBundle\Entity\EmailGamerSupport']
        )
            ->setRequired(array(
                    'em',
                ))
            ->setAllowedTypes(array(
                    'em' => 'Doctrine\Common\Persistence\ObjectManager',
                ))
        ;
    }

} 