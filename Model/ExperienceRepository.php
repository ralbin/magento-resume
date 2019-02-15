<?php
namespace RussellAlbin\Resume\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use RussellAlbin\Resume\Model\ResourceModel\Experience as ExperienceResource;
use RussellAlbin\Resume\Model\ResourceModel\Experience\CollectionFactory;
use RussellAlbin\Resume\Api\Data\ExperienceSearchResultsInterfaceFactory as SearchResultFactory;
use RussellAlbin\Resume\Api\Data\ExperienceInterface;
use RussellAlbin\Resume\Api\ExperienceRepositoryInterface;

/**
 * Class ExperienceRepository
 * @package RussellAlbin\Resume\Model
 */
class ExperienceRepository implements ExperienceRepositoryInterface
{
    /**
     * @var ExperienceResource
     */
    private $experienceResource;
    /**
     * @var ExperienceFactory
     */
    private $experienceFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteria;


    /**
     * ExperienceRepository constructor.
     * @param ExperienceResource $experience
     * @param ExperienceFactory $experienceFactory
     * @param CollectionFactory $collectionFactory
     * @param SearchResultFactory $searchResultFactory
     * @param SearchCriteriaInterface $searchCriteria
     */
    public function __construct(
        ExperienceResource $experience,
        ExperienceFactory $experienceFactory,
        CollectionFactory $collectionFactory,
        SearchResultFactory $searchResultFactory,
        SearchCriteriaInterface $searchCriteria)
    {
        $this->experienceResource       = $experience;
        $this->experienceFactory        = $experienceFactory;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $searchResultFactory;
        $this->searchCriteria           = $searchCriteria;
    }
    /**
     * @param ExperienceInterface $experience
     * @return int|null
     * @throws \Exception
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(ExperienceInterface $experience)
    {
        /* @var $experience ExperienceInterface */
        $this->experienceResource->save($experience);
        return $experience->getId();
    }
    /**
     * {@inheritdoc}
     */
    public function get($experienceId)
    {
        return $this->getById($experienceId);
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
    public function getById($experienceId)
    {
        $experience = $this->experienceFactory->create();
        $this->experienceResource->load($experience, $experienceId);
        if (!$experience->getId()) {
            throw NoSuchEntityException::singleField('entity_id', $experienceId);
        }
        return $experience;
    }
    /**
     * {@inheritdoc}
     */
    public function delete(ExperienceInterface $experience)
    {
        try {
            $this->experienceResource->delete($experience);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function deleteById($experienceId)
    {
        // try to delete by the ID
        return $this->delete($this->getById($experienceId));
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
