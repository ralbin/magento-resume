<?php
/**
 * @package RussellAlbin\Resume
 */
namespace RussellAlbin\Resume\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use RussellAlbin\Resume\Api\Data\ResumeInterface;
/**
 * Class Resume
 * @package RussellAlbin\Resume\Model\ResourceModel
 */
class Resume extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResumeInterface::TABLE_NAME, ResumeInterface::ENTITY_ID);
    }

}