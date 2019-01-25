<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountRequest
 *
 * @ORM\Table(name="account_request")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRequestRepository")
 */
class AccountRequest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isRenew", type="boolean")
     */
    private $isRenew;

    /**
     * @var string
     *
     * @ORM\Column(name="groupHead", type="string", length=255)
     */
    private $groupHead;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="requestDate", type="datetime")
     */
    private $requestDate;

    /**
     * @var string
     *
     * @ORM\Column(name="contactPerson", type="string", length=255)
     */
    private $contactPerson;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrivalDate", type="datetime")
     */
    private $arrivalDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departureDate", type="datetime", nullable=true)
     */
    private $departureDate;

    /**
     * @var string
     *
     * @ORM\Column(name="userProfile", type="string", length=255)
     */
    private $userProfile;

    /**
     * @var string
     *
     * @ORM\Column(name="mainGroup", type="string", length=255)
     */
    private $mainGroup;

    /**
     * @var array
     *
     * @ORM\Column(name="systemsToEnable", type="json_array")
     */
    private $systemsToEnable;

    /**
     * @var array
     *
     * @ORM\Column(name="mailingLists", type="json_array")
     */
    private $mailingLists;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=1024, nullable=true)
     */
    private $note;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AccountRequest
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return AccountRequest
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set groupHead
     *
     * @param string $groupHead
     *
     * @return AccountRequest
     */
    public function setGroupHead($groupHead)
    {
        $this->groupHead = $groupHead;

        return $this;
    }

    /**
     * Get groupHead
     *
     * @return string
     */
    public function getGroupHead()
    {
        return $this->groupHead;
    }

    /**
     * Set requestDate
     *
     * @param \DateTime $requestDate
     *
     * @return AccountRequest
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * Get requestDate
     *
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * Set contactPerson
     *
     * @param string $contactPerson
     *
     * @return AccountRequest
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Set arrivalDate
     *
     * @param \DateTime $arrivalDate
     *
     * @return AccountRequest
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    /**
     * Get arrivalDate
     *
     * @return \DateTime
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * Set departureDate
     *
     * @param \DateTime $departureDate
     *
     * @return AccountRequest
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    /**
     * Get departureDate
     *
     * @return \DateTime
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * Set userProfile
     *
     * @param string $userProfile
     *
     * @return AccountRequest
     */
    public function setUserProfile($userProfile)
    {
        $this->userProfile = $userProfile;

        return $this;
    }

    /**
     * Get userProfile
     *
     * @return string
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }

    /**
     * Set mainGroup
     *
     * @param string $mainGroup
     *
     * @return AccountRequest
     */
    public function setMainGroup($mainGroup)
    {
        $this->mainGroup = $mainGroup;

        return $this;
    }

    /**
     * Get mainGroup
     *
     * @return string
     */
    public function getMainGroup()
    {
        return $this->mainGroup;
    }

    /**
     * Set systemsToEnable
     *
     * @param array $systemsToEnable
     *
     * @return AccountRequest
     */
    public function setSystemsToEnable($systemsToEnable)
    {
        $this->systemsToEnable = $systemsToEnable;

        return $this;
    }

    /**
     * Get systemsToEnable
     *
     * @return array
     */
    public function getSystemsToEnable()
    {
        return $this->systemsToEnable;
    }

    /**
     * Set mailingLists
     *
     * @param array $mailingLists
     *
     * @return AccountRequest
     */
    public function setMailingLists($mailingLists)
    {
        $this->mailingLists = $mailingLists;

        return $this;
    }

    /**
     * Get mailingLists
     *
     * @return array
     */
    public function getMailingLists()
    {
        return $this->mailingLists;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return AccountRequest
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set isRenew
     *
     * @param boolean $isRenew
     *
     * @return AccountRequest
     */
    public function setIsRenew($isRenew)
    {
        $this->isRenew = $isRenew;

        return $this;
    }

    /**
     * Get isRenew
     *
     * @return boolean
     */
    public function getIsRenew()
    {
        return $this->isRenew;
    }
}
