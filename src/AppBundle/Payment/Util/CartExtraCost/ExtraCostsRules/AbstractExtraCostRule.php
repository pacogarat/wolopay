<?php


namespace AppBundle\Payment\Util\CartExtraCost\ExtraCostsRules;


use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PayMethodProviderHasCountry;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractExtraCostRule
{
    /** @var Logger */
    protected $logger;

    /** @var ContainerInterface */
    protected $container;

    /** @var EntityManagerInterface */
    protected $em;

    function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;
        $this->logger = $containerInterface->get('logger');
        $this->em = $containerInterface->get('doctrine.orm.default_entity_manager');
    }

    /**
     * @param $total
     * @param \AppBundle\Entity\PaymentDetail $paymentDetail
     * @param \AppBundle\Entity\PayMethodProviderHasCountry $payMethodProviderHasCountry
     * @return mixed
     */
    abstract public function injectExtraCost(&$total, PaymentDetail $paymentDetail, PayMethodProviderHasCountry $payMethodProviderHasCountry);

} 