<?php


namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SameApp extends Constraint
{
    public $message = 'This id has reference to invalid to other app';
} 