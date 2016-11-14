<?php
/**
 * Created by MGDSoftware. 25/08/2015
 */

namespace AppBundle\Payment\Bean;


class PaymentDetailBean {
    public $providerMethodExtraData;

    function __construct(array $providerMethodExtraData)
    {
        $this->providerMethodId=$providerMethodExtraData;
    }
}