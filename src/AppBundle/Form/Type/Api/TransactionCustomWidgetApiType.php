<?php

namespace AppBundle\Form\Type\Api;


use Symfony\Component\Form\FormBuilderInterface;

class TransactionCustomWidgetApiType extends TransactionCustomApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('pay_method_id');
    }

}
