<?php
/**
 * Created by MGDSoftware. 22/06/2015
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\XmlRoot;


/**
 * Promocion
 *
 * @ORM\Table(name="promo_type")
 * @ORM\Entity
 * @XmlRoot("promoType")
 */
class PromoType {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PromoType
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return PromoType
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}