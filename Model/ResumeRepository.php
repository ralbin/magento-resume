<?php
namespace RussellAlbin\Resume\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use RussellAlbin\Resume\Model\ResourceModel\Resume as ResumeResource;
use RussellAlbin\Resume\Model\ResourceModel\Resume\CollectionFactory;
use RussellAlbin\Resume\Api\Data\ResumeSearchResultsInterfaceFactory as SearchResultFactory;
use RussellAlbin\Resume\Api\Data\ResumeInterface;
use RussellAlbin\Resume\Api\ResumeRepositoryInterface;

/**
 * Class ResumeRepository
 * @package RussellAlbin\Resume\Model
 */
class ResumeRepository implements ResumeRepositoryInterface
{
    /**
     * @var ResumeResource
     */
    private $resumeResource;
    /**
     * @var ResumeFactory
     */
    private $resumeFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteria;


    /**
     * ResumeRepository constructor.
     * @param ResumeResource $resume
     * @param ResumeFactory $resumeFactory
     * @param CollectionFactory $collectionFactory
     * @param SearchResultFactory $searchResultFactory
     * @param SearchCriteriaInterface $searchCriteria
     */
    public function __construct(
        ResumeResource $resume,
        ResumeFactory $resumeFactory,
        CollectionFactory $collectionFactory,
        SearchResultFactory $searchResultFactory,
        SearchCriteriaInterface $searchCriteria)
    {
        $this->resumeResource           = $resume;
        $this->resumeFactory            = $resumeFactory;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $searchResultFactory;
        $this->searchCriteria           = $searchCriteria;
    }
    /**
     * @param ResumeInterface $resume
     * @return int|null
     * @throws \Exception
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(ResumeInterface $resume)
    {
        /* @var $resume ResumeInterface */
        $this->resumeResource->save($resume);
        return $resume->getId();
    }
    /**
     * {@inheritdoc}
     */
    public function get($resumeId)
    {
        return $this->getById($resumeId);
    }
    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        /** @var \Magento\Framework\Api\SortOrder $sortOrder */
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $field = $sortOrder->getField();
            $collection->addOrder(
                $field,
                $this->getDirection($sortOrder->getDirection())
            );
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->load();

        $searchResults = $this->searchResultsFactory->create();

        $collectionItems = $collection->getItems();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collectionItems);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
    /**
     * {@inheritdoc}
     */
    public function getById($resumeId)
    {
        $resume = $this->resumeFactory->create();
        $this->resumeResource->load($resume, $resumeId);
        if (!$resume->getId()) {
            throw NoSuchEntityException::singleField('entity_id', $resumeId);
        }
        return $resume;
    }
    /**
     * {@inheritdoc}
     */
    public function delete(ResumeInterface $resume)
    {
        try {
            $this->resumeResource->delete($resume);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function deleteById($resumeId)
    {
        // try to delete by the ID
        return $this->delete($this->getById($resumeId));
    }

    /**
     * @param $direction
     * @return string
     */
    private function getDirection($direction)
    {
        return $direction == SortOrder::SORT_ASC ?: SortOrder::SORT_DESC;
    }

    /**
     * @param \Magento\Framework\Api\Search\FilterGroup $group
     * @param $collection
     */
    private function addFilterGroupToCollection($group, $collection)
    {
        foreach ($group->getFilters() as $filter) {
            $condition = $filter->getConditionType() ?: 'eq';
            $field = $filter->getField();
            $value = $filter->getValue();

            /**
             * If $condition is array - one of the following structures is expected:
             * - array("from" => $fromValue, "to" => $toValue)
             * - array("eq" => $equalValue)
             * - array("neq" => $notEqualValue)
             * - array("like" => $likeValue)
             * - array("in" => array($inValues))
             * - array("nin" => array($notInValues))
             * - array("notnull" => $valueIsNotNull)
             * - array("null" => $valueIsNull)
             * - array("moreq" => $moreOrEqualValue)
             * - array("gt" => $greaterValue)
             * - array("lt" => $lessValue)
             * - array("gteq" => $greaterOrEqualValue)
             * - array("lteq" => $lessOrEqualValue)
             * - array("finset" => $valueInSet)
             * - array("regexp" => $regularExpression)
             * - array("seq" => $stringValue)
             * - array("sneq" => $stringValue)
             *
             * If non matched - sequential array is expected and OR conditions
             * will be built using above mentioned structure
             */
            $collection->addFieldToFilter($field, [$condition => $value]);
        }
    }
}
