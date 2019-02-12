<?php
namespace RussellAlbin\Resume\Block;
class Resume extends \Magento\Framework\View\Element\Template
{

    public function getResumeXml()
    {
        $url = $this->getViewFileUrl('RussellAlbin_Resume::xml/resume.xml');
        $xml_file = file_get_contents($url, FILE_TEXT);

        // create a simplexml object from the contents of the current file
        $xml = simplexml_load_string($xml_file);
        return $xml;
    }

}