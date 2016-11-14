<?php

namespace AppBundle\Command;


use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class TransactionCreateValidateException extends \Exception
{
    /** @var ConstraintViolationListInterface */
    public $errorList;

    public function __construct(ConstraintViolationListInterface $errorList, $message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errorList = $errorList;
    }

    public function addErrorsToForm(Form $form)
    {
        foreach ($this->errorList as $error)
        {
            if ($form->has($error->getPropertyPath()))
            {
                $form->addError(new FormError($error->getMessage()));
            }else{
                $form->get($error->getPropertyPath())->addError(new FormError($error->getMessage()));
            }
        }
    }
}