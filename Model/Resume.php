<?php

namespace Russellalbin\Resume\Model;
use RussellAlbin\Resume\Api\Data\ResumeInterface;
use Magento\Framework\Model\AbstractModel;
use RussellAlbin\Resume\Api\ResumeRepositoryInterface;

class Resume extends AbstractModel implements ResumeInterface {

    protected $_eventPrefix = 'resume';

    protected function _construct()
    {
        $this->_init('RussellAlbin\Resume\Model\ResourceModel\Resume');
    }

    /**
     * return resume ID
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * return resume ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }
    /**
     * return the resume ID
     * @return int
     */
    public function setEntityId($entity_id)
    {
        $this->setData(self::ENTITY_ID, $entity_id);
    }
    /**
     * retrieve the firstname
     * @return $this|string
     */
    public function getFirstname()
    {
        $this->getData(self::FIRSTNAME);
    }

    /**
     * @param $firstname
     * @return $this|string
     */
    public function setFirstname($firstname)
    {
        $this->setData(self::FIRSTNAME, $firstname);
    }
    /**
     * retrieve the last name
     * @return string
     */
    public function getLastname()
    {
        $this->getData(self::LASTNAME);
    }
    /**
     * @param $lastname
     * @return $this|string
     */
    public function setLastname($lastname)
    {
        $this->setData(self::LASTNAME, $lastname);
    }
    /**
     * retrieve the email
     * @return string
     */
    public function getEmail()
    {
        $this->getData(self::EMAIL);
    }
    /**
     * @param $email
     * @return $this|string
     */
    public function setEmail($email)
    {
        $this->setData(self::EMAIL, $email);
    }
    /**
     * retrieve the phone number
     * @return string|null
     */
    public function getPhone()
    {
        $this->getData(self::PHONE);
    }
    /**
     * @param $phone
     * @return $this|string
     */
    public function setPhone($phone)
    {
        $this->setData(self::PHONE, $phone);
    }

    /**
     * retrieve the skills
     * @return string|null
     */
    public function getSkills()
    {
        $this->getData(self::SKILLS);
    }
    /**
     * @param $skills
     * @return $this|string
     */
    public function setSkills($skills)
    {
        $this->setData(self::SKILLS, $skills);
    }

}