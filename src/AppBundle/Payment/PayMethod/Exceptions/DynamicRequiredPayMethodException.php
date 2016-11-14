<?php


namespace AppBundle\Payment\PayMethod\Exceptions;


use AppBundle\Helper\UtilHelper;

class DynamicRequiredPayMethodException extends AbstractItemRequiredPayMethodException
{
    const MCRYPT_KEY = 'L.-tP9/6w.8;j?R9';

    public function __construct(array $groups, $message = "", $code = 0, \Exception $previous = null)
    {
        $this->urlAlias = 'dynamic_required_form';

        foreach ($groups as $group)
            $this->groups[]= UtilHelper::encrypt($group);
    }
} 