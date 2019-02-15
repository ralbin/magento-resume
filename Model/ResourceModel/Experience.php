<?php
/**
 * @package RussellAlbin\Resume
 */
namespace RussellAlbin\Resume\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use RussellAlbin\Resume\Api\Data\ExperienceInterface;

/**
 * Class Experience
 * @package RussellAlbin\Resume\Model\ResourceModel
 */
class Experience extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ExperienceInterface::TABLE_NAME, ExperienceInterface::ENTITY_ID);
    }

}