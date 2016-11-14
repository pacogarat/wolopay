<?php


namespace AppBundle\Event;


use AppBundle\Entity\FinInvoice;
use Symfony\Component\EventDispatcher\Event;

class BillingInvoiceCreatedEvent extends Event
{
    const EVENT = 'app.billing_invoice.created';

    /** @var FinInvoice */
    protected $finInvoiceMerchantToWolo;

    /** @var FinInvoice */
    protected $finInvoiceWoloToClient;

    function __construct(FinInvoice $finInvoiceWoloToClient, FinInvoice $finInvoiceMerchantToWolo = null)
    {
        $this->finInvoiceWoloToClient   = $finInvoiceWoloToClient;
        $this->finInvoiceMerchantToWolo = $finInvoiceMerchantToWolo;
    }

    /**
     * @return \AppBundle\Entity\FinInvoice|null
     */
    public function getFinInvoiceMerchantToWolo()
    {
        return $this->finInvoiceMerchantToWolo;
    }

    /**
     * @return \AppBundle\Entity\FinInvoice
     */
    public function getFinInvoiceWoloToClient()
    {
        return $this->finInvoiceWoloToClient;
    }

} 