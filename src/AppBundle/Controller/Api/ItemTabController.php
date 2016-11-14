<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\App;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemTabController extends AbstractAPI
{

    /**
     * Get all available itemTabs
     *
     * @Get("/item_tab")
     * @QueryParam(name="app_id", description="Transaction Id", strict=true, nullable=false)
     *
     * @ParamConverter("app", class="AppBundle:App", options={"id" = "app_id"})*
     *
     * @param App $app
     * @return array
     */
    public function getItemTabsAction(App $app)
    {
        $itemTabs =$this->getDoctrine()->getRepository("AppBundle:ItemTab")->findByAppId($app);

        $view = $this->view($itemTabs, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('Default')));

        return $this->handleView($view);
    }

}
