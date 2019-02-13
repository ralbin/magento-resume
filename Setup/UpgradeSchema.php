<?php
/**
 * Main Table resume
 * entity_id
 * firstname
 * lastname
 * email
 * phone
 * objective
 * skills
 *
 * Table experience
 *
 * entity_id int(11) primary key auto increment
 * resume_id int(11) with FK resume entity_id
 * employer varchar(255)
 * job_description text
 * start_date datetime
 * end_date datetime nullable
 *
 * Table urls
 * entity_id int(11)
 * resume_id int(11) with FK resume entity_id
 * url varchar(255)
 *
 * Table Certifications
 * entity_id int(11)
 * resume_id int(11) with FK resume entity_id
 * certification_name varchar(255)
 * date_certified datetime
 * exipration_date datetime
 * image
 *
 * Table volunteer
 * entity_id int(11)
 * description varchar(255)
 */
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use RussellAlbin\Resume\Api\Data\ResumeInterface;
/**
 * Class UpgradeSchema
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Create our tables needed for the resume
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->oneZeroOne($setup);
        }

        $setup->endSetup();
    }

    /**
     * Create our 5 tables to manage our resume attributes
     * @param SchemaSetupInterface $setup
     */
    private function oneZeroOne(SchemaSetupInterface $setup)
    {
        try{
            $this->createResumeTable($setup);
            //$this->createExperienceTable($setup);
        }catch (\Exception $e){

        }
    }

    /**
     * Resume Table
     * @param $setup
     */
    private function createResumeTable($setup)
    {
        /**
         * Resume table
         * entity_id
         * description
         * firstname
         * lastname
         * email
         * phone
         * objective
         * skills
         */
        $resumeTable = $setup->getConnection()
            ->newTable($setup->getTable(ResumeInterface::TABLE_NAME))
            ->newColumn(
                ResumeInterface::ENTITY_ID,
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Resume ID'
            )
            ->newColumn(
                ResumeInterface::FIRSTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Resume'
            )
            ->newColumn(
                ResumeInterface::LASTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Last Name'
            )
            ->newColumn(
                ResumeInterface::EMAIL,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Email'
            )
            ->newColumn(
                ResumeInterface::PHONE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                15,
                ['nullable' => false],
                'PHone max 15 characters format (xxx)xxx-xxxx'
            )
            ->newColumn(
                ResumeInterface::OBJECTIVE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Objective'
            )
            ->newColumn(
                ResumeInterface::SKILLS,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Skills'
            )
            ->setComment('Main Resume Table');
        $setup->getConnection->createTable($resumeTable);
    }

    private function createExperienceTable($setup)
    {
        /**
         *  * Table experience
         *
         * entity_id int(11) primary key auto increment
         * resume_id int(11) with FK resume entity_id
         * employer varchar(255)
         * job_description text
         * start_date datetime
         * end_date datetime nullable

        $resumeTable = $setup->getConnection()
            ->newTable($setup->getTable(ResumeInterface::TABLE_NAME))
            ->newColumn(
                ResumeInterface::ENTITY_ID,
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Resume ID'
            )
            ->newColumn(
                ResumeInterface::FIRSTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Resume'
            )
            ->newColumn(
                ResumeInterface::LASTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Last Name'
            )
            ->newColumn(
                ResumeInterface::EMAIL,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Email'
            )
            ->newColumn(
                ResumeInterface::PHONE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                15,
                ['nullable' => false],
                'PHone max 15 characters format (xxx)xxx-xxxx'
            )
            ->newColumn(
                ResumeInterface::OBJECTIVE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Objective'
            )
            ->newColumn(
                ResumeInterface::SKILLS,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Skills'
            )
            ->addColumn(
                AthleteInterface::CREATED_AT,
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
            )
            ->addColumn(
                AthleteInterface::UPDATED_AT,
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )
            ->setComment('Main Resume Table');
        $setup->getConnection->createTable($resumeTable);
        */
    }

}
