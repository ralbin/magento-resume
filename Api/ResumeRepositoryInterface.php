<?php

namespace RussellAlbin\Resume\Api;

/**
 * Interface for resume repository.
 *
 * @api
 */
interface ResumeRepositoryInterface
{
    /**
     * Save Resume
     *
     * @param \RussellAlbin\Resume\Api\Data\ResumeInterface $resume
     * @return int|null
     */
    public function save(\RussellAlbin\Resume\Api\Data\ResumeInterface $resume);

    /**
     * Get Resume
     *
     * @param int $resumeId
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface
     */
    public function get($resumeId);

    /**
     * Get Resume by ID
     *
     * @param $resumeId
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($resumeId);

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
     * @param  \RussellAlbin\Resume\Api\Data\ResumeInterface $resume
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\RussellAlbin\Resume\Api\Data\ResumeInterface $resume);

    /**
     * Delete Resume by ID.
     *
     * @param  mixed $resumeId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($resumeId);
}