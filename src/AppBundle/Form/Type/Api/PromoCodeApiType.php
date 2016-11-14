<?php

namespace AppBundle\Form\Type\Api;

use AppBundle\Form\DataTransformer\DateTimeISO8601Transformer;
use AppBundle\Form\DataTransformer\GamerExternalIdsToCSVTransformer;
use AppBundle\Form\DataTransformer\IdToStringGenericTransformer;
use AppBundle\Form\DataTransformer\PromoIdToStringCreateIfNotExistTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromoCodeApiType extends AbstractApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
        * @RequestParam(name="promo_code", description="Promo code, create promo code with app name prefix like DEM54897", strict=true, nullable=false)
        * @RequestParam(name="promo_name", description="Promo name to create the code in. Will be created if not exist. Defaults to 'Api'", strict=true, nullable=true)
        * @RequestParam(name="article_id", description="Article id", strict=true, nullable=false)
        * @RequestParam(name="gamers_ids", description="CSV Format", nullable=true)
        * @RequestParam(name="n_total_uses", description="N total usages", nullable=true)
        * @RequestParam(name="n_uses_per_gamer", description="N uses per gamer", default="1", nullable=true)
        * @RequestParam(name="begin_at", description="Begin promo at, ISO8601 format", nullable=true)
        * @RequestParam(name="end_at", description="End promo at, ISO8601 format", nullable=true)
        */

        $builder
            ->add('promo_code', null, ['property_path' => 'code', 'description' => 'Promo code', 'required' => true])
            ->add('promo_name', TextType::class, ['property_path' => 'promo', 'description'=>"Promo name to create the code in. Will be created if not exist. Defaults to 'Api'",'empty_data'=>'Api', 'required' => false] )
            ->add('article_id', TextType::class, ['property_path' => 'article', 'required' => true, 'description' => 'CSV Format'])
            ->add('gamers_ids', TextType::class, ['property_path' => 'gamers', 'required' => false, 'description' => 'CSV Format'])
            ->add('n_uses_per_gamer', null, ['description' => 'N uses per gamer, default: 1', 'property_path' => 'nUsesPerUser', 'empty_data' => 1, 'required' => false])
            ->add('n_total_uses', null, ['description' => 'N total usages', 'property_path' => 'nTotalUses', 'required' => false])
            ->add('begin_at', TextType::class, ['description' => 'Begin promo at, ISO8601 format', 'property_path' => 'beginAt', 'required' => false])
            ->add('end_at', TextType::class, ['description' => 'End promo at, ISO8601 format', 'property_path' => 'endAt', 'required' => false])
            //            ->add('value')
            //            ->add('isPercent')
        ;

        // Doing this to generate Api Doc and option parameter doesn't exist.....
        if ($options['em'] && $options['app'])
        {
            // Data Transformers
            $builder->get('gamers_ids')->addModelTransformer(new GamerExternalIdsToCSVTransformer($options['em'], $options['app']));
            $builder->get('promo_name')->addModelTransformer(new PromoIdToStringCreateIfNotExistTransformer($options['em'],$options['app'], $options['promo_name'] ));
            $builder->get('article_id')->addModelTransformer(new IdToStringGenericTransformer($options['em'], 'AppBundle:Article'));
            $builder->get('begin_at')->addModelTransformer(new DateTimeISO8601Transformer());
            $builder->get('end_at')->addModelTransformer(new DateTimeISO8601Transformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\PromoCode',
                'em'  => null,
                'app' => null,
                'promo_name' =>null,
            ))
            ->setAllowedTypes('em', ['Doctrine\Common\Persistence\ObjectManager', 'null'])
            ->setAllowedTypes('promo_name', [ 'null'])
        ;

        parent::configureOptions($resolver);
    }

}
