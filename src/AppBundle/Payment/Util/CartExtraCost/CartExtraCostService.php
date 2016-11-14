<?php


namespace AppBundle\Payment\Util\CartExtraCost;

use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Payment\Util\CartExtraCost\ExtraCostsRules\ExtraCostByPMPCRule;
use AppBundle\Payment\Util\CartExtraCost\ExtraCostsRules\ExtraCostComposite;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Service("app.cart_extra_cost")
 */
class CartExtraCostService
{
    /**
     * @var ContainerInterface
     * @Inject("service_container")
     */
    public $container;

    public function addExtraCosts(&$total, PaymentDetail $paymentDetail, PayMethodProviderHasCountry $payMethodProviderHasCountry)
    {
        $composite = new ExtraCostComposite( $this->container );

        // ExtraCostByPMPCRule must be the first, its used in PaymentService
        $composite->add(new ExtraCostByPMPCRule( $this->container ));

        $composite->injectExtraCost($total, $paymentDetail, $payMethodProviderHasCountry);
    }

} 