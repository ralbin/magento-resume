<?php

namespace RussellAlbin\Api\Data;
/**
 * Interface ResumeSearchResultsInterface
 * @package RussellAlbin\Api\Data
 */
interface ResumeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Resume list.
     * @api
     * @return \RussellAlbin\Resume\Api\Data\Resumenterface[]
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