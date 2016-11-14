<?php


namespace AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class BillingInvoicesGeneratedEvent extends Event
{
    const EVENT = 'app.billing_invoices.generated';

} 