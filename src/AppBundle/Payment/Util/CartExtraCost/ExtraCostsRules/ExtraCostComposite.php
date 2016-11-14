<?php


namespace AppBundle\Payment\Util\CartExtraCost\ExtraCostsRules;


use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PayMethodProviderHasCountry;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExtraCostComposite extends AbstractExtraCostRule
{
    /** @var AbstractExtraCostRule[]|\SplObjectStorage */
    private $childs;

    public function __construct(ContainerInterface $containerInterface)
    {
        parent::__construct($containerInterface);

        $this->childs = new \SplObjectStorage();
    }

    /**
     * @param AbstractExtraCostRule $c
     * @return mixed
     */
    public function add(AbstractExtraCostRule $c)
    {
        $this->childs->attach($c);
    }

    /**
     * @param AbstractExtraCostRule $c
     * @return mixed
     */
    public function remove(AbstractExtraCostRule $c)
    {
        $this->childs->detach($c);
    }

    public function injectExtraCost(&$total, PaymentDetail $paymentDetail, PayMethodProviderHasCountry $payMethodProviderHasCountry)
    {
        // cant change pmpc extra cost
        if ($payMethodProviderHasCountry->hasAFixedAmount())
            return;

        foreach ($this->childs as $child)
        {
            if ($offset = $child->injectExtraCost($total, $paymentDetail, $payMethodProviderHasCountry))
            {
                $this->logger->addDebug('ExtraCost: '.get_class($child).", offset: +$offset [APPLY]");
            }else{

                $this->logger->addDebug('ExtraCost: '.get_class($child).' [N/A]');
            }
        }
    }
}