<?php


namespace AppBundle\Service\OverrideThirdBundles;

use JMS\Serializer\JsonSerializationVisitor as JsonSerializationVisitorBase;

class JsonSerializationVisitor extends JsonSerializationVisitorBase
{
    public function getResult()
    {
        if($this->getRoot() instanceof \ArrayObject) {
            $this->setRoot((array) $this->getRoot());
        }
        return parent::getResult();
    }
}