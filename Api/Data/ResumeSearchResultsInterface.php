<?php

namespace RussellAlbin\Resume\Api\Data;
/**
 * Interface ResumeSearchResultsInterface
 * @package RussellAlbin\Resume\Api\Data
 */
interface ResumeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Resume list.
     * @api
     * @return \RussellAlbin\Resume\Api\Data\ResumeInterface[]
     */
    public function getItems();

    /**
     * Set Resume list.
     *
     * @api
     * @param  \RussellAlbin\Resume\Api\Data\ResumeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}