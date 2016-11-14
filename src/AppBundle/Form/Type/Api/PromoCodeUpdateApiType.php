<?php

namespace AppBundle\Form\Type\Api;

use AppBundle\Form\DataTransformer\GamerExternalIdsToCSVGenericTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class PromoCodeUpdateApiType extends PromoCodeApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('promo_code')
        ;
    }

}
