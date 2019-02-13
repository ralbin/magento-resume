<?php
/**
 *
 */
namespace RussellAlbin\Resume\Api\Data;
/**
 * Interface ResumeInterface
 * @package RussellAlbin\Resume\Api\Data
 */
interface ResumeInterface
{
    /**
     * Main Table resume
     * entity_id
     * firstname
     * lastname
     * email
     * phone
     * objective
     * skills
     */
    const TABLE_NAME    = 'resume';
    const ENTITY_ID     = 'entity_id';
    const FIRSTNAME     = 'firstname';
    const LASTNAME      = 'lastname';
    const EMAIL         = 'email';
    const PHONE         = 'phone';
    const OBJECTIVE     = 'objective';
    const SKILLS        = 'skills';

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
     * @param $firstname
     * @return mixed
     */
    public function setFirstname($firstname);

    /**
     * @return mixed
     */
    public function getFirstname();

    /**
     * @param $lastname
     * @return mixed
     */
    public function setLastname($lastname);

    /**
     * @return mixed
     */
    public function getLastname();

    /**
     * @param $email
     * @return mixed
     */
    public function setEmail($email);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param $phone
     * @return mixed
     */
    public function setPhone($phone);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param $skills
     * @return mixed
     */
    public function setSkills($skills);

    /**
     * @return mixed
     */
    public function getSkills();
}