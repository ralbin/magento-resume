<?php

namespace Russellalbin\Resume\Model;

use Magento\Framework\Model\AbstractModel;
use RussellAlbin\Resume\Api\Data\ExperienceInterface;

class Experience extends AbstractModel implements ExperienceInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'experience';

    protected function _construct()
    {
        $this->_init('RussellAlbin\Resume\Model\ResourceModel\Experience');
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
     * Retrieve the Entity ID
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * set the experience ID
     * @return mixed
     */
    public function setEntityId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    /**
     * Retrieve the description for this resume
     * @return mixed|string
     */
    public function getResumeId()
    {
        return $this->getData(self::RESUME_ID);
    }

    /**
     * Set the resume_id for this experience
     *
     * @param $resume_id
     * @return string
     */
    public function setResumeId($resume_id)
    {
        return $this->setData(self::RESUME_ID, $resume_id);
    }

    /**
     * Retrieve the employer
     * @return $this|string
     */
    public function getEmployer()
    {
        return $this->getData(self::EMPLOYER);
    }

    /**
     * @param $employer
     * @return $this|string
     */
    public function setEmployer($employer)
    {
        return $this->setData(self::EMPLOYER, $employer);
    }

    /**
     * retrieve the last name
     * @return string
     */
    public function getJobDescription()
    {
        return $this->getData(self::JOB_DESCRIPTION);
    }

    /**
     * @param $job_description
     * @return $this|string
     */
    public function setJobDescription($job_description)
    {
        return $this->setData(self::JOB_DESCRIPTION, $job_description);
    }

    /**
     * Retrieve the start date
     * @return string
     */
    public function getStartDate()
    {
        return $this->getData(self::START_DATE);
    }

    /**
     * @param $start_date
     * @return $this|string
     */
    public function setStartDate($start_date)
    {
        return $this->setData(self::START_DATE, $start_date);
    }

    /**
     * Retrieve the end date
     * @return string|null
     */
    public function getEndDate()
    {
        return $this->getData(self::END_DATE);
    }

    /**
     * @param $end_date
     * @return $this|string
     */
    public function setEndDate($end_date)
    {
        return $this->setData(self::END_DATE, $end_date);
    }

}
