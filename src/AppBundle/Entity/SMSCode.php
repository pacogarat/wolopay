<?php

namespace AppBundle\Entity;

use AppBundle\Entity\SuperClass\CodePurchase;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App
 *
 * @ORM\Table(name="sms_code", uniqueConstraints={@ORM\UniqueConstraint(name="SMS_CODE_UNIQUE_", columns={"external_transaction_id"})})
 * @ORM\Entity()
 * @UniqueEntity("externalTransactionId")
 */
class SMSCode extends CodePurchase
{
    /**
     * @var \AppBundle\Entity\SMSOperator
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SMSOperator")
     * @ORM\JoinColumn(name="sms_operator_id", referencedColumnName="id", nullable=false)
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile",  type="string", length=25, nullable=false)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="external_transaction_id",  type="string", length=25, nullable=false)
     */
    private $externalTransactionId;


    /**
     * Set operator
     *
     * @param SMSOperator $operator
     * @return SMSCode
     */
    public function setOperator(SMSOperator $operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return SMSOperator
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return SMSCode
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $externalTransactionId
     * @return $this
     */
    public function setExternalTransactionId($externalTransactionId)
    {
        $this->externalTransactionId = $externalTransactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalTransactionId()
    {
        return $this->externalTransactionId;
    }


}
