<?php

namespace AppBundle\Entity;

use AppBundle\Command\Billing\BillingClientOwesInjectConcept;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FinancialBills
 *
 * @ORM\Table(name="fin_invoice", uniqueConstraints={@ORM\UniqueConstraint(name="FIN_INVOICE_UNIQUE_", columns={"invoice_number", "company_from_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\FinInvoiceRepository")
 * @UniqueEntity({"invoiceNumber", "companyTo"})
 * @ExclusionPolicy("all")
 */
class FinInvoice
{
    const SONATA_CONTEXT = 'invoice';
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
     * @ORM\Column(name="invoice_number", type="string", length=50)
     * @Expose()
     */
    private $invoiceNumber;

    /**
     * @var \AppBundle\Entity\FinInvoiceCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FinInvoiceCategory")
     * @ORM\JoinColumn(name="fin_invoice_category_id", referencedColumnName="id", nullable=false)
     */
    private $finInvoiceCategory;

    /**
     * @var \AppBundle\Entity\FinMovement
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FinMovement", mappedBy="finInvoice")
     */
    private $finMovements;

    /**
     * @var \AppBundle\Entity\FinMovement
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClientDocument", mappedBy="finInvoice")
     */
    private $clientDocuments;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_from_id", referencedColumnName="id", nullable=false)
     */
    private $companyFrom;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_to_id", referencedColumnName="id", nullable=false)
     */
    private $companyTo;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumn(name="external_company_not_wolopay", referencedColumnName="id", nullable=false)
     */
    private $externalCompanyNotWolopay;

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
     * @var float
     *
     * @ORM\Column(name="amount_total", type="decimal", scale=2, nullable=false)
     * @Expose()
     */
    private $amountTotal;

    /**
     * @var \AppBundle\Entity\Currency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Expose()
     */
    private $currency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="watch", type="boolean", nullable=true)
     */
    private $watch = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="require_approval", type="boolean", nullable=true)
     */
    private $requireApproval = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="approved_at", type="datetime", nullable=true)
     */
    private $approvedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="forward_for_client_to_at", type="datetime", nullable=true)
     */
    private $forwardForClientToAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="forwarded_for_client_to_at", type="datetime", nullable=true)
     */
    private $forwardedForClientToAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="declined_at", type="datetime", nullable=true)
     */
    private $declinedAt;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="document", referencedColumnName="id", nullable=true)
     * @Expose()
     */
    private $document;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reference_date", type="datetime", nullable=false)
     * @Expose()
     */
    private $referenceDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invoice_generator_id", type="string", length=100, nullable=true)
     */
    private $invoiceGeneratorId;

    /**
     * @var array
     *
     * @ORM\Column(name="extra_concepts", type="json_array", nullable=false)
     * @Expose()
     */
    private $extraConcepts=[];

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable("UPDATE")
     */
    private $updatedAt;

    function __construct($inVoiceNumber = null, Company $companyFrom = null, Company $companyTo = null, \DateTime $referenceDate = null)
    {
        $this->inVoiceNumber = $inVoiceNumber;
        $this->referenceDate = $referenceDate;

        $this->createdAt     = new \DateTime('now');

        if ($companyFrom)
            $this->setCompanyFrom($companyFrom);

        if ($companyTo)
            $this->setCompanyTo($companyTo);
    }

    public function __toString()
    {
        return $this->invoiceNumber;
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
     * @param float $amountTotal
     * @return $this
     */
    public function setAmountTotal($amountTotal)
    {
        $this->amountTotal = $amountTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountTotal()
    {
        return $this->amountTotal;
    }

    /**
     * @param \AppBundle\Entity\Client $companyFrom
     * @return $this
     */
    public function setCompanyFrom($companyFrom)
    {
        $this->companyFrom = $companyFrom;

        if ($this->isExternalCompanyNotWolopay($companyFrom))
            $this->externalCompanyNotWolopay = $companyFrom;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getCompanyFrom()
    {
        return $this->companyFrom;
    }

    /**
     * @param \AppBundle\Entity\Client $companyTo
     * @return $this
     */
    public function setCompanyTo($companyTo)
    {
        $this->companyTo = $companyTo;

        if ($this->isExternalCompanyNotWolopay($companyTo))
            $this->externalCompanyNotWolopay = $companyTo;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getCompanyTo()
    {
        return $this->companyTo;
    }





    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \AppBundle\Entity\Currency $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
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
     * @param \AppBundle\Entity\FinInvoiceCategory $finInvoiceCategory
     * @return $this
     */
    public function setFinInvoiceCategory($finInvoiceCategory)
    {
        $this->finInvoiceCategory = $finInvoiceCategory;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\FinInvoiceCategory
     */
    public function getFinInvoiceCategory()
    {
        return $this->finInvoiceCategory;
    }

    /**
     * @param boolean $requireApproval
     * @return $this
     */
    public function setRequireApproval($requireApproval)
    {
        $this->requireApproval = $requireApproval;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequireApproval()
    {
        return $this->requireApproval;
    }

    /**
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $referenceDate
     * @return $this
     */
    public function setReferenceDate($referenceDate)
    {
        $this->referenceDate = $referenceDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReferenceDate()
    {
        return $this->referenceDate;
    }

    /**
     * @param int $attemptOnCreateAValidInvoice
     * @throws \Exception
     * @return $this
     */
    public function generateInvoiceNumberFromCompanyTo($attemptOnCreateAValidInvoice = 1)
    {
        if (!$this->getCompanyTo() || !$this->referenceDate)
        {
            throw new \Exception("Can't generate id");
        }

        $suffix = '';
        if ($attemptOnCreateAValidInvoice > 1)
            $suffix = '_'.$attemptOnCreateAValidInvoice;

        $this->invoiceNumber = $this->companyFrom->getSlug().$this->companyTo->getSlug().$this->referenceDate->format('Ym').$suffix;

        return $this;
    }

    /**
     * @deprecated don't use directly
     * @param $invoiceNumber
     * @return $this;
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
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
     * @param boolean $watch
     * @return $this
     */
    public function setWatch($watch)
    {
        $this->watch = $watch;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getWatch()
    {
        return $this->watch;
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
     * @param \DateTime $approvedAt
     * @return $this
     */
    public function setApprovedAt($approvedAt)
    {
        $this->approvedAt = $approvedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getApprovedAt()
    {
        return $this->approvedAt;
    }

    /**
     * @param \DateTime $declinedAt
     * @return $this
     */
    public function setDeclinedAt($declinedAt)
    {
        $this->declinedAt = $declinedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeclinedAt()
    {
        return $this->declinedAt;
    }

    /**
     * @param \DateTime $forwardForClientToAt
     * @return $this
     */
    public function setForwardForClientToAt($forwardForClientToAt)
    {
        $this->forwardForClientToAt = $forwardForClientToAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getForwardForClientToAt()
    {
        return $this->forwardForClientToAt;
    }

    /**
     * @param \DateTime $forwardedForClientToAt
     * @return $this
     */
    public function setForwardedForClientToAt($forwardedForClientToAt)
    {
        $this->forwardedForClientToAt = $forwardedForClientToAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getForwardedForClientToAt()
    {
        return $this->forwardedForClientToAt;
    }

    /**
     * @param \DateTime $invoiceGeneratorId
     * @return $this
     */
    public function setInvoiceGeneratorId($invoiceGeneratorId)
    {
        $this->invoiceGeneratorId = $invoiceGeneratorId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInvoiceGeneratorId()
    {
        return $this->invoiceGeneratorId;
    }

    private function isExternalCompanyNotWolopay(Company $company)
    {
        if (strpos($company->getNameCompany(), 'Wolop') === false )
            return true;

        return false;
    }

    /**
     * @param BillingClientOwesInjectConcept[] $extraConcepts
     * @param \JMS\Serializer\Serializer $serializer
     * @return $this
     */
    public function setExtraConcepts(array $extraConcepts = null, \JMS\Serializer\Serializer $serializer)
    {
        $this->extraConcepts = $this->serializeInjectConcept($extraConcepts, $serializer);
        return $this;
    }

    /**
     * @param \AppBundle\Command\Billing\BillingClientOwesInjectConcept[] $objs
     * @param \JMS\Serializer\Serializer $serializer
     * @return array
     */
    private function serializeInjectConcept(array $objs = null, \JMS\Serializer\Serializer $serializer)
    {
        $result = [];

        if (!$objs)
            return $result;

        foreach ($objs as $obj)
            $result []= json_decode($serializer->serialize($obj, 'json'));

        return $result;
    }

    /**
     * @return array
     */
    public function getExtraConcepts()
    {
        return $this->extraConcepts;
    }

    /**
     * @return \AppBundle\Entity\Client
     */
    public function getExternalCompanyNotWolopay()
    {
        return $this->externalCompanyNotWolopay;
    }

    /**
     * Add finMovement
     *
     * @param \AppBundle\Entity\FinMovement $finMovement
     *
     * @return FinInvoice
     */
    public function addFinMovement(\AppBundle\Entity\FinMovement $finMovement)
    {
        $this->finMovements[] = $finMovement;

        return $this;
    }

    /**
     * Remove finMovement
     *
     * @param \AppBundle\Entity\FinMovement $finMovement
     */
    public function removeFinMovement(\AppBundle\Entity\FinMovement $finMovement)
    {
        $this->finMovements->removeElement($finMovement);
    }

    /**
     * Get finMovements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinMovements()
    {
        return $this->finMovements;
    }

    /**
     * Set externalCompanyNotWolopay
     *
     * @param \AppBundle\Entity\Company $externalCompanyNotWolopay
     *
     * @return FinInvoice
     */
    private function setExternalCompanyNotWolopay(\AppBundle\Entity\Company $externalCompanyNotWolopay)
    {
        $this->externalCompanyNotWolopay = $externalCompanyNotWolopay;

        return $this;
    }

    /**
     * Add clientDocument
     *
     * @param \AppBundle\Entity\ClientDocument $clientDocument
     *
     * @return FinInvoice
     */
    public function addClientDocument(\AppBundle\Entity\ClientDocument $clientDocument)
    {
        $this->clientDocuments[] = $clientDocument;

        return $this;
    }

    /**
     * Remove clientDocument
     *
     * @param \AppBundle\Entity\ClientDocument $clientDocument
     */
    public function removeClientDocument(\AppBundle\Entity\ClientDocument $clientDocument)
    {
        $this->clientDocuments->removeElement($clientDocument);
    }

    /**
     * Get clientDocuments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClientDocuments()
    {
        return $this->clientDocuments;
    }
}
