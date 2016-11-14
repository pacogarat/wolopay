<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @ORM\Table(name="single_payment")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SinglePaymentRepository")
 * @ExclusionPolicy("all")
 * @XmlRoot("single_payment")
 */
class SinglePayment extends Payment implements PaymentProcessInterface
{
    const PREFIX = 'SINPAY_';
    /**
     * @var array
     *
     * @ORM\Column(name="request", type="json_array", nullable=false)
     */
    protected $request=[];

    /**
     * @var array
     *
     * @ORM\Column(name="responses", type="json_array", nullable=false)
     */
    protected $responses=[];

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=45, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $ip;

    public function getType()
    {
        return 'single_payment';
    }


    public function __construct($ip = 'CLI')
    {
        parent::__construct();

        $this->id = uniqid(static::PREFIX .date("YmdHi"));
        $this->ip = $ip;
    }

    /**
     * Set request
     *
     * @param $url
     * @param array $params
     * @param null $subRequest
     * @return $this
     */
    public function setRequest($url, $params = [], $subRequest = null)
    {
        $this->request = ['url' => $url, 'params' => $params, 'subRequest' =>$subRequest];

        return $this;
    }

    /**
     * Get request
     *
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set responses
     *
     * @param array $responses
     * @return $this
     */
    public function addResponse($responses)
    {
        $this->responses[] = $responses;

        return $this;
    }

    /**
     * Set responses
     *
     * @param array $response
     * @return $this
     */
    public function addResponseSubRequestLast($response)
    {
        $this->responses[count($this->responses)- 1]['subRequest'] = $response;

        return $this;
    }

    /**
     * Get responses
     *
     * @return array
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }


}
