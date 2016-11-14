<?php


namespace AppBundle\Entity\NotPersisted\CreditCards;

use AppBundle\Entity\Enum\CreditCardEnum;
use Symfony\Component\Validator\Constraints as Assert;

class Discover extends AbstractCreditCard
{
    const CREDIT_CARD_ENUM = CreditCardEnum::DISCOVER;

    /**
     * @Assert\NotBlank(),
     * @Assert\CardScheme(
     *     schemes={"DISCOVER"}
     * )
     */
    protected $cardNumber;

} 