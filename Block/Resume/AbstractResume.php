<?php
namespace RussellAlbin\Resume\Block\Resume;

use Magento\Framework\View\Element\Template;
use RussellAlbin\Resume\Api\Data\ResumeInterface;

/**
 * Class AbstractResume
 * @package RussellAlbin\Resume\Block\Resume
 */
abstract class AbstractResume extends Template
{

    /**
     * @var ResumeInterface
     */
    protected $resume;

    protected $resumeSearchResults;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ResumeInterface $resume,
        array $data = []
    ) {
        $this->resume               = $resume;
        parent::__construct($context, $data);
    }

    /**
     * @return ResumeInterface
     */
    protected function getResumeXml()
    {
        $url = $this->getViewFileUrl('RussellAlbin_Resume::xml/resume.xml');
        $xml_file = file_get_contents($url, FILE_TEXT);

        // create a simplexml object from the contents of the current file
        $xml = simplexml_load_string($xml_file);

        $this->resume->setFirstname($xml->personal_information->firstname);
        $this->resume->setLastname($xml->personal_information->lastname);
        $this->resume->setEmail($xml->personal_information->email);
        $this->resume->setPhone($xml->personal_information->cell_phone);
        $this->resume->setSkills($xml->personal_information->skills);
        $this->resume->setObjective($xml->personal_information->objective);
        return $this->resume;
    }

    protected function getResumeDb()
    {
       return $this->resume;
    }
}
