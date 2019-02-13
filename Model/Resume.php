<?php

namespace Russellalbin\Resume\Model;

use Magento\Framework\Model\AbstractModel;
use RussellAlbin\Resume\Api\Data\ResumeInterface;

class Resume extends AbstractModel implements ResumeInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'resume';

    protected function _construct()
    {
        $this->_init('RussellAlbin\Resume\Model\ResourceModel\Resume');
    }

    /**
     * Retrieve resume ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Retrieve the resume ID
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Retrieve the resume ID
     * @return int
     */
    public function setEntityId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    /**
     * Retrieve the description for this resume
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Set the description for this resume
     *
     * @param $description
     * @return string|void
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Retrieve the firstname
     * @return $this|string
     */
    public function getFirstname()
    {
        return $this->getData(self::FIRSTNAME);
    }

    /**
     * @param $firstname
     * @return $this|string
     */
    public function setFirstname($firstname)
    {
        return $this->setData(self::FIRSTNAME, $firstname);
    }

    /**
     * retrieve the last name
     * @return string
     */
    public function getLastname()
    {
        return $this->getData(self::LASTNAME);
    }

    /**
     * @param $lastname
     * @return $this|string
     */
    public function setLastname($lastname)
    {
        return $this->setData(self::LASTNAME, $lastname);
    }

    /**
     * Retrieve the email
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param $email
     * @return $this|string
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Retrieve the phone number
     * @return string|null
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @param $phone
     * @return $this|string
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * Retrieve the skills
     * @return string|null
     */
    public function getSkills()
    {
        return $this->getData(self::SKILLS);
    }

    /**
     * @param $skills
     * @return $this|string
     */
    public function setSkills($skills)
    {
        return $this->setData(self::SKILLS, $skills);
    }
}
