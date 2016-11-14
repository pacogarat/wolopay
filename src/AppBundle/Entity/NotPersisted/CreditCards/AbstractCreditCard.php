<?php


namespace AppBundle\Entity\NotPersisted\CreditCards;

use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractCreditCard
{
    const CREDIT_CARD_ENUM = 'NEED_OVERRIDE';

    /**
     * @Assert\NotBlank()
     * @Assert\Expression("this.isChecksumCorrect() == true")
     */
    protected $cardNumber;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 5)
     */
    protected $ownerFirstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 5)
     */
    protected $ownerLastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^[0-9]{2}\/[0-9]{4}$/")
     * @Assert\Expression("this.isExpirationDateValid() == true")
     */
    protected $expireDate;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 111,
     *      max = 9999
     * )
     */
    protected $cvv;

    /**
     * This is based in Luhn Algorithm
     * @see http://en.wikipedia.org/wiki/Luhn_algorithm
     *
     * @return bool
     */
    public function isChecksumCorrect()
    {
        $cardnumber = $this->cardNumber;

        $aux = '';
        foreach (str_split(strrev($cardnumber)) as $pos => $digit) {
            // Multiply * 2 all even digits
            $aux .= ($pos % 2 != 0) ? $digit * 2 : $digit;
        }
        // Sum all digits in string
        $checksum = array_sum(str_split($aux));

        // Card is OK if the sum is an even multiple of 10 and not 0
        return ($checksum != 0 && $checksum % 10 == 0);
    }

    /**
     * @return bool
     */
    public function isExpirationDateValid()
    {
        if(substr($this->expireDate, 0, 2) < 1 || substr($this->expireDate, 0, 2) > 12)
            return false;

        if(intval(substr($this->expireDate, 3, 4).substr($this->expireDate, 0, 2)) < date('Ym'))
            return false;

        return true;
    }

    /**
     * @param mixed $cardNumber
     * @return $this
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param mixed $cvv
     * @return $this
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param mixed $expireDate
     * @return $this
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * @return mixed
     */
    public function getExpireDateMonth()
    {
        return substr($this->expireDate, 0, 2);
    }

    /**
     * @return mixed
     */
    public function getExpireDateYear()
    {
        return substr($this->expireDate, 3, 4);
    }

    /**
     * @param mixed $ownerFirstName
     * @return $this
     */
    public function setOwnerFirstName($ownerFirstName)
    {
        $this->ownerFirstName = $ownerFirstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOwnerFirstName()
    {
        return $this->ownerFirstName;
    }

    /**
     * @param mixed $ownerLastName
     * @return $this
     */
    public function setOwnerLastName($ownerLastName)
    {
        $this->ownerLastName = $ownerLastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOwnerLastName()
    {
        return $this->ownerLastName;
    }


} 