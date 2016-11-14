<?php


namespace AppBundle\Payment\PayMethod\Exceptions;


abstract class AbstractItemRequiredPayMethodException extends \Exception {

    protected $urlAlias;
    protected $groups = [];

    /**
     * @return mixed
     */
    public function getUrlAlias()
    {
        return $this->urlAlias;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

} 