<?php


namespace AppBundle\Entity\NotPersisted\CreditCards;

use AppBundle\Entity\Enum\CreditCardEnum;
use Symfony\Component\Validator\Constraints as Assert;

class MasterCard extends AbstractCreditCard
{
    const CREDIT_CARD_ENUM = CreditCardEnum::MASTER_CARD;

    /**
     * @Assert\NotBlank(),
     * @Assert\CardScheme(
     *     schemes={"MASTERCARD"}
     * )
     */
    protected $cardNumber;

} 