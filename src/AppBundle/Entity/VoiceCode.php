<?php

namespace AppBundle\Entity;

use AppBundle\Entity\SuperClass\CodePurchase;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App
 *
 * @ORM\Table(name="voice_code")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\VoiceCodeRepository")
 */
class VoiceCode extends CodePurchase
{
    /**
     * @var string
     *
     * @ORM\Column(name="number",  type="string", length=25, nullable=false)
     */
    private $number;


    /**
     * @param $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

}
