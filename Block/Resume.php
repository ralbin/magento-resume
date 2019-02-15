<?php
namespace RussellAlbin\Resume\Block;

use RussellAlbin\Resume\Api\Data\ResumeInterface;

class Resume extends AbstractResume
{
    /**
     * @var ResumeInterface
     */
    protected $resume;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ResumeInterface $resume,
        array $data = []
    ) {
        $this->resume = $resume;
        parent::__construct($context, $data);
    }

    public function getResumeData()
    {
        $this->getResumeXml();
    }
}
