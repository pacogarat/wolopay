<?php


namespace AppBundle\Form\Type\Api;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Asserts;

class AbstractApiType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }

    public function getConstraintsDateTimeISO8601()
    {
        return [
            new Asserts\Callback(function($date, $context) {
                if (!$date)
                    return;
                if (false === \DateTime::createFromFormat(\DateTime::ISO8601, $date)) {
                    $context->addViolation("$date is not at ISO8601 format.");
                }else{
                    echo \DateTime::createFromFormat(\DateTime::ISO8601, $date)->format('Y-m-d');
                }
            })
        ];
    }
} 