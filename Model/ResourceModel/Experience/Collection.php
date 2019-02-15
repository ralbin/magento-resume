<?php
/**
 * @package RussellAlbin\Resume
 */
namespace RussellAlbin\Resume\Model\ResourceModel\Experience;
/**
 * Class Collection
 * @package RussellAlbin\Resume\Model\ResourceModel\Experience
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Constructor
     * Configures collection
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('RussellAlbin\Resume\Model\Experience', 'RussellAlbin\Resume\Model\ResourceModel\Experience');
    }

}