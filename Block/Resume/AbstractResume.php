<?php
namespace RussellAlbin\Resume\Block\Resume;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\Template;
use RussellAlbin\Resume\Api\Data\ResumeInterface;
use RussellAlbin\Resume\Api\ResumeRepositoryInterface;

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

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var Filter
     */
    private $filter;
    /**
     * @var FilterGroup
     */
    private $filterGroup;
    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteria;
    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    private $resumeRepository;

    /**
     * AbstractResume constructor.
     * @param Template\Context $context
     * @param ResumeInterface $resume
     * @param Filter $filter
     * @param SearchCriteriaInterface $searchCriteria
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ResumeInterface $resume,
        Filter $filter,
        SearchCriteriaInterface $searchCriteria,
        ResumeRepositoryInterface $resumeRepository,
        array $data = []
    ) {
        $this->resume                   = $resume;
        $this->filter                   = $filter;
        $this->searchCriteria           = $searchCriteria;
        $this->resumeRepository         = $resumeRepository;
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
        //$filter = $this->filter;
        //$filter->setField(\SecondSwing\ClubFinder\Model\Wishlist::WISHLIST_EMAIL);
        //$filter->setValue($wishlistId);
        //$filter->setConditionType('eq');
        //$filter_group   = $this->filterGroup->setData('filters', [$filter]);
        //$search         = $this->searchCriteria->setFilterGroups([$filter_group]);
        $search         = $this->searchCriteria;
        /* @var $search \RussellAlbin\Resume\Model\ResumeRepository */
        $results        = $this->resumeRepository->getList($search);
        foreach ($results->getItems() as $_item)
        {
            return $_item;
            break;
        }
    }
}
