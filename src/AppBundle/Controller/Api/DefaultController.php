<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Country;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractAPI
{

    /**
     * Dont do anything only to test Security
     */
    public function getTestAction()
    {
        return $this->handleView(
            $this->view(array('test' => 'ok'), 200)
        );
    }

    /**
     * Dont do anything only to test Security
     * @ParamConverter("country", class="AppBundle:Country", options={"id" = "country"})
     */
    public function getTestParamConverterAction(Country $country)
    {
        return $this->handleView(
            $this->view(array('test' => 'ok'), 200)
        );
    }


}
