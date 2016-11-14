<?php

namespace AppBundle\Form\Type\Api;

use Symfony\Component\Form\FormBuilderInterface;

class GamerUpdateApiType extends GamerApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('gamer_id');
    }

}
