<?php
namespace RussellAlbin\Resume\Block\Resume;
/**
 * Class Xml
 * @package RussellAlbin\Resume\Block
 */
class Xml extends AbstractResume
{

    /**
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface
     */
    public function getResumeData()
    {
        return $this->getResumeXml();
    }
}
