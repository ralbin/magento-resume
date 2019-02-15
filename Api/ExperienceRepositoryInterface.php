<?php
namespace RussellAlbin\Resume\Api;

/**
 * Interface for experience repository.
 *
 * @api
 */
interface ExperienceRepositoryInterface
{
    /**
     * Save Experience
     *
     * @param \RussellAlbin\Resume\Api\Data\ExperienceInterface $experience
     * @return int|null
     */
    public function save(\RussellAlbin\Resume\Api\Data\ExperienceInterface $experience);

    /**
     * Get Resume
     *
     * @param int $experienceId
     * @return \RussellAlbin\Resume\Api\Data\ExperienceInterface
     */
    public function get($experienceId);

    /**
     * Get Experience by ID
     *
     * @param $experienceId
     * @return \RussellAlbin\Resume\Api\Data\ExperienceInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($experienceId);

    /**
     * Get product list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Resume
     *
     * @param  \RussellAlbin\Resume\Api\Data\ExperienceInterface $experience
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\RussellAlbin\Resume\Api\Data\ExperienceInterface $experience);

    /**
     * Delete Experience by ID.
     *
     * @param  mixed $experienceId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($experienceId);
}