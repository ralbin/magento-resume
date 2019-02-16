<?php
namespace RussellAlbin\Resume\Block\Resume;
/**
 * Class Db
 * @package RussellAlbin\Resume\Block\Resume
 */
class Db extends AbstractResume
{

    /**
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface
     */
    public function getResumeData()
    {
        return $this->getResumeDb();
    }
}
