<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ClientUserNotification
 *
 * @ORM\Table(name="client_user_notification")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ClientUserNotificationRepository")
 * @ExclusionPolicy("all")
 */
class ClientUserNotification
{
    const TYPE_INFO    = 'info';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR   = 'error';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClientUser")
     * @ORM\JoinColumn(name="client_user_id", referencedColumnName="id", nullable=false)
     */
    private $clientUser;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $type = self::TYPE_INFO;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="unread", type="boolean", nullable=true)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $unread=true;

    /**
     * @var string
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted=false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose()
     * @Groups({"Default", "Public"})
     */
    private $createdAt;

    function __construct(ClientUser $client=null, $message=null, $title=null, $type = self::TYPE_INFO)
    {
        if ($client)
            $this->setClientUser($client);
        $this->setMessage($message);
        $this->setTitle($title);
        $this->setType($type);

        $this->createdAt = new \DateTime('now');
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
     * Set title
     *
     * @param string $title
     * @return ClientUserNotification
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return ClientUserNotification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ClientUserNotification
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set clientUser
     *
     * @param \AppBundle\Entity\ClientUser $clientUser
     * @return ClientUserNotification
     */
    public function setClientUser(\AppBundle\Entity\ClientUser $clientUser)
    {
        $this->clientUser = $clientUser;

        return $this;
    }

    /**
     * Get clientUser
     *
     * @return \AppBundle\Entity\ClientUser
     */
    public function getClientUser()
    {
        return $this->clientUser;
    }

    /**
     * Set unread
     *
     * @param boolean $unread
     * @return ClientUserNotification
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;

        return $this;
    }

    /**
     * Get unread
     *
     * @return boolean 
     */
    public function getUnread()
    {
        return $this->unread;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return ClientUserNotification
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


}
