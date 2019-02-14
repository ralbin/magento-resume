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
namespace RussellAlbin\Resume\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Psr\Log\LoggerInterface;
use RussellAlbin\Resume\Api\Data\ResumeInterface;

/**
 * Class UpgradeSchema
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * UpgradeSchema constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Create our tables needed for the resume
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $this->oneZeroTwo($setup);
        }

        $setup->endSetup();
    }

    /**
     * Create our main Resume table to manage our resume attributes
     * @param SchemaSetupInterface $setup
     */
    private function oneZeroTwo(SchemaSetupInterface $setup)
    {
        try {
            $this->createResumeTable($setup);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function createResumeTable(SchemaSetupInterface $setup)
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
        try {
            $resumeTable = $setup->getConnection()
            ->newTable($setup->getTable(ResumeInterface::TABLE_NAME))
            ->addColumn(
                ResumeInterface::ENTITY_ID,
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Resume ID'
            )
            ->addColumn(
                ResumeInterface::DESCRIPTION,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Resume Description'
            )
            ->addColumn(
                ResumeInterface::FIRSTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Resume'
            )
            ->addColumn(
                ResumeInterface::LASTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Last Name'
            )
            ->addColumn(
                ResumeInterface::EMAIL,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Email'
            )
            ->addColumn(
                ResumeInterface::PHONE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                15,
                ['nullable' => false],
                'PHone max 15 characters format (xxx)xxx-xxxx'
            )
            ->addColumn(
                ResumeInterface::OBJECTIVE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Objective'
            )
            ->addColumn(
                ResumeInterface::SKILLS,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Skills'
            )
            ->setComment('Main Resume Table');

            $setup->getConnection()->createTable($resumeTable);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }

    /**
     * @param $setup
     */
    private function createExperienceTable(SchemaSetupInterface $setup)
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
        */
        $resumeTable = $setup->getConnection()
            ->newTable($setup->getTable(ResumeInterface::TABLE_NAME))
            ->addColumn(
                ResumeInterface::ENTITY_ID,
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                ResumeInterface::FIRSTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Resume'
            )
            ->addColumn(
                ResumeInterface::LASTNAME,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Last Name'
            )
            ->addColumn(
                ResumeInterface::EMAIL,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Email'
            )
            ->addColumn(
                ResumeInterface::PHONE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                15,
                ['nullable' => false],
                'PHone max 15 characters format (xxx)xxx-xxxx'
            )
            ->addColumn(
                ResumeInterface::OBJECTIVE,
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Objective'
            )
            ->addColumn(
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

    }
}
