<?php


namespace AppBundle\Entity\NotPersisted\CreditCards;

use AppBundle\Entity\Enum\CreditCardEnum;
use Symfony\Component\Validator\Constraints as Assert;

class Maestro extends AbstractCreditCard
{
    const CREDIT_CARD_ENUM = CreditCardEnum::MAESTRO;

    /**
     * @Assert\NotBlank(),
     * @Assert\CardScheme(
     *     schemes={"MAESTRO"}
     * )
     */
    protected $cardNumber;

} 