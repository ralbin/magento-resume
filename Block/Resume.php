<?php
namespace RussellAlbin\Resume\Block;

class Resume extends AbstractResume
{

    /**
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface
     */
    public function getResumeData()
    {
        return $this->getResumeXml();
    }
}
