<?php


namespace AppBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Validator\Mapping\PropertyMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Service("app.form_helper")
 */
class FormHelper
{
    /**
     * @Inject("validator")
     * @var ValidatorInterface
     */
    public $validator;

    /**
     * @Inject("form.factory")
     * @var FormFactory
     */
    public $formFactory;

    /**
     * @param $obj
     * @param $groups
     * @param null $onlyAddIfItHaveAValue
     * @return FormBuilderInterface
     */
    public function createFormWithOnlyValidatorGroups($obj, $groups, $onlyAddIfItHaveAValue=null)
    {
        $metadata = $this->validator->getMetadataFor($obj);


        /** @var \Symfony\Component\Validator\Mapping\ClassMetadata $metadata */

        $fields = [];

        $p = new PropertyAccessor();

        foreach ($metadata->members as $member)
        {
            /** @var PropertyMetadata $property */
            $property = $member[0];

            if ($onlyAddIfItHaveAValue !== null)
            {
                $value = $p->getValue($obj, $property->getName());


                if ($onlyAddIfItHaveAValue != ($value))
                    continue;
            }


            $flag = false;
            foreach ($groups as $group)
            {
                if (count($property->findConstraints($group)))
                    $flag = true;
            }

            if ($flag)
                $fields []= $property->getPropertyName();
        }

        $formBuilder = $this->formFactory->createBuilder('form', $obj, ['validation_groups' => $groups]);

        foreach ($fields as $field)
            $formBuilder->add($field);

        return $formBuilder;
    }


    /**
     * @param $obj
     * @param $groups
     * @param \Symfony\Component\Form\FormBuilderInterface $formBuilder
     * @param null $onlyAddIfItHaveAValue
     * @return FormBuilderInterface
     */
    public function createFormWithOnlyGroups($obj, $groups, FormBuilderInterface $formBuilder = null, $onlyAddIfItHaveAValue=null)
    {
        $metadata = $this->validator->getMetadataFor($obj);
        /** @var \Symfony\Component\Validator\Mapping\ClassMetadata $metadata */

        $fields = [];

        if ($obj instanceof \Doctrine\Common\Persistence\Proxy)
            $class = \Doctrine\Common\Util\ClassUtils::getRealClass(get_class($obj));
        else
            $class = get_class($obj);

        $r = new \ReflectionClass($class);
        $p = new PropertyAccessor();
        $reader = new AnnotationReader();

        foreach ($metadata->members as $member)
        {
            /** @var PropertyMetadata $property */
            $property = $member[0];
            $propertyReflection = $r->getProperty($property->getName());

            if ($onlyAddIfItHaveAValue !== null)
            {
                $value = $p->getValue($obj, $property->getName());

                if ($onlyAddIfItHaveAValue != ($value))
                {
                    continue;
                }
            }

            $flag = false;
            /** @var \JMS\Serializer\Annotation\Groups $jmsGroups */
            $jmsGroups = $reader->getPropertyAnnotation($propertyReflection, 'JMS\\Serializer\\Annotation\\Groups');
            $groupsOfProperty = array_values($jmsGroups->groups);

            if (count($groupsOfProperty) < 1)
                continue;

            array_map(
                function($group) use (&$flag, $groups)
                {
                    if (in_array($group, $groups))
                        $flag = true;
                },
                $groupsOfProperty
            );

            if ($flag)
            {
                $fields []= $property->getPropertyName();
            }
        }

        if (!$formBuilder)
            $formBuilder = $this->formFactory->createBuilder('form', $obj, ['validation_groups' => $groups]);

        foreach ($fields as $field)
        {
            if (!$formBuilder->has($field))
                $formBuilder->add($field);
        }

        return $formBuilder;
    }
} 