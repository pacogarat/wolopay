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

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleImportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $queryBuilder=[];
        $queryBuilderApp=[];

        if ($options['app'])
        {
            $queryBuilderApp['query_builder']= function(EntityRepository $er ) use ($options) {
                return $er->createQueryBuilder('a')
                    ->where('a.app = :appId')
                    ->setParameter('appId', $options['app']->getId() );
            };
        }

        $formBuilder
            ->add('articleCategory', EntityType::class, array(
                    'class' => 'AppBundle:ArticleCategory'
                ))
            ->add('item', EntityType::class, array_merge(['class' => 'AppBundle:Item'], $queryBuilderApp))
            ->add('articleCategory', EntityType::class, ['class' => 'AppBundle:ArticleCategory'])
            ->add('csv', TextareaType::class, array('attr' => ['style'=>'height:300px']))
            ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => null,
                'app'        => null,
            ));
    }
}