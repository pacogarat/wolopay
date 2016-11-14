<?php


namespace AppBundle\Entity\NotPersisted\CreditCards;

use AppBundle\Entity\Enum\CreditCardEnum;
use Symfony\Component\Validator\Constraints as Assert;

class Amex extends AbstractCreditCard
{
    const CREDIT_CARD_ENUM = CreditCardEnum::AMEX;

    /**
     * @Assert\NotBlank(),
     * @Assert\CardScheme(
     *     schemes={"AMEX"}
     * )
     */
    protected $cardNumber;

} 