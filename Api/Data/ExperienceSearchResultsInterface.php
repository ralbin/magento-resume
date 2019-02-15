<?php

namespace RussellAlbin\Resume\Api\Data;
/**
 * Interface ExperienceSearchResultsInterface
 * @package RussellAlbin\Resume\Api\Data
 */
interface ExperienceSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Resume list.
     * @api
     * @return \RussellAlbin\Resume\Api\Data\ExperienceInterface[]
     */
    public function getItems();

    /**
     * Set Resume list.
     *
     * @api
     * @param  \RussellAlbin\Resume\Api\Data\ExperienceInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}