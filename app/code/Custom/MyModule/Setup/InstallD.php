<?php

namespace Custom\Mymodule\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table; 

class InstallD implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    
       {
        $installer = $setup;

        $installer->startSetup();
        $table  = $installer->getConnection()
            ->newTable($installer->getTable('my_code'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity'=>true, 'nullable'=>false, 'primary'=>true],
                'Item ID'
                )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Item Name'
            )
            ->addColumn(
                'content',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Content'
            )
            ->addColumn(
                'status',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false],
                'Status'
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Created At'
            )
            ->addIndex(
                $setup->getIdxName('my_code', ['name']),
                ['name']
            )->setComment(
                'Sample Items'
            );

        $installer->getConnection()->createTable($table);
       }
}
