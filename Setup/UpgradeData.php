<?php

namespace RussellAlbin\Resume\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use RussellAlbin\Resume\Api\Data\ResumeInterface;
/**
 * Class UpgradeData
 * @package RussellAlbin\Resume\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $adapter = $setup->getConnection();
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            try {
                // Insert Resume
                $adapter->insertMultiple(ResumeInterface::TABLE_NAME, $this->getResumeRecords());

            }catch (\Exception $e){

            }
        }

        $setup->endSetup();
    }

    private function getResumeRecords()
    {
        $records = [
            [
                ResumeInterface::FIRSTNAME => 'Russell',
                ResumeInterface::LASTNAME => 'Albin',
                ResumeInterface::EMAIL => 'russell@russellalbin.com',
                ResumeInterface::PHONE => '(402)871-5167',
                ResumeInterface::SKILLS => 'Magento 1, Magento 2, Magento Cloud, PHP, MySQL, DevOps, Magento Architect, troubleshooting, diagnosis of coding and hosting issues, all aspects of Magento developent and hosting'
            ]
        ];
        return $records;
    }
}
