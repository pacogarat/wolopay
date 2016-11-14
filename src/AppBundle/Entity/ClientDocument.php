<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Table(name="client_document")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ClientDocumentRepository")
 * @ExclusionPolicy("all")
 */
class ClientDocument
{
    const SONATA_CONTEXT = 'client_document';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=false)
     * @Expose()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="document", referencedColumnName="id", nullable=true)
     * @Expose()
     */
    private $document;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;

    /**
     * @var \AppBundle\Entity\FinInvoice
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FinInvoice", inversedBy="clientDocuments")
     * @ORM\JoinColumn(name="fin_invoice_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $finInvoice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose()
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable("UPDATE")
     */
    private $updatedAt;

    function __construct()
    {
        $this->createdAt     = new \DateTime('now');
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Entity\Media $document
     * @return $this
     */
    public function setDocument($document)
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param \AppBundle\Entity\Client $finInvoice
     * @return $this
     */
    public function setFinInvoice($finInvoice)
    {
        $this->finInvoice = $finInvoice;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getFinInvoice()
    {
        return $this->finInvoice;
    }

    /**
     * @param \AppBundle\Entity\Client $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

}

