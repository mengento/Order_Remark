<?php
namespace Mengento\OrderRemark\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $connection = $installer->getConnection();
        $installer->startSetup();

	$table = $installer->getConnection()
	->newTable($installer->getTable('order_remark'))
	->addColumn(
		'id',
		\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
		 null,
		['identity' => true, 'unsigned'  => true, 'nullable' => false, 'primary' => true],
		 'Id')
	->addColumn(
		'increment_id',
		\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		50,
		['nullable' => true],
		'Order Increment Id')
	->addColumn(
		'entity_id',
		\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
		null,
		['unsigned'  => true,'nullable'  => true],
		'Magento Order Id')
	->addColumn(
		'created_at',
		\Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
		null,
		['unsigned'  => true,'nullable'  => true],
		'Created')
	->addColumn(
		'user',
		\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		50,
		['nullable' => true],
		'User')
	->addColumn(
		'remark',
		\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		5000,
		['nullable'  => true],
		'Remark')
	->setComment('Order Remark');
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
