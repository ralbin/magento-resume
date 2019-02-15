<?php
/**
 *
 */
namespace RussellAlbin\Resume\Api\Data;

/**
 * Interface ExperienceInterface
 * @package RussellAlbin\Resume\Api\Data
 */
interface ExperienceInterface
{
    /**
     * Experience Table for resume
     *
     * entity_id int(11) primary key auto increment
     * resume_id int(11) with FK resume entity_id
     * employer varchar(255)
     * job_description text
     * start_date datetime
     * end_date datetime nullable
     */
    const TABLE_NAME        = 'resume';
    const ENTITY_ID         = 'entity_id';
    const RESUME_ID         = 'resume_id';
    const EMPLOYER          = 'employer';
    const JOB_DESCRIPTION   = 'job_description';
    const START_DATE        = 'start_date';
    const END_DATE          = 'end_date';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $entity_id
     * @return mixed
     */
    public function setEntityId($entity_id);

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @return string
     */
    public function getResumeId();

    /**
     * @param $resume_id
     * @return string
     */
    public function setResumeId($resume_id);
    /**
     * @param $employer
     * @return mixed
     */
    public function setEmployer($employer);

    /**
     * @return mixed
     */
    public function getEmployer();

    /**
     * @param $job_description
     * @return mixed
     */
    public function setJobDescription($job_description);

    /**
     * @return mixed
     */
    public function getJobDescription();

    /**
     * @param $start_date
     * @return mixed
     */
    public function setStartDate($start_date);

    /**
     * @return mixed
     */
    public function getStartDate();

    /**
     * @param $phone
     * @return mixed
     */
    public function setEndDate($end_date);

    /**
     * @return mixed
     */
    public function getEndDate();
}
