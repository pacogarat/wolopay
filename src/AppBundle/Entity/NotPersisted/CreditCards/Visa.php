<?php


namespace AppBundle\Entity\NotPersisted\CreditCards;

use AppBundle\Entity\Enum\CreditCardEnum;
use Symfony\Component\Validator\Constraints as Assert;

class Visa extends AbstractCreditCard
{
    const CREDIT_CARD_ENUM = CreditCardEnum::VISA;

    /**
     * @Assert\NotBlank(),
     * @Assert\CardScheme(
     *     schemes={"VISA"}
     * )
     */
    protected $cardNumber;

} 