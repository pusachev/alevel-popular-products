<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Setup;


use ALevel\PopularProducts\Api\Scheme\PopularProductInterface;
use MageNet\MagicApi\Api\Schema\BillingAddressSchemaInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /** {@inheritDoc} */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /** create table `alevel_popular_products` */
        $table = $setup->getConnection()->newTable(
            $setup->getTable(PopularProductInterface::TABLE_NAME)
        )->addColumn(
            PopularProductInterface::ID_COLUMN_NAME,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Row ID'
        )->addColumn(
            PopularProductInterface::PRODUCT_ID_COLUMN_NAME,
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'Product Id'
        )->addColumn(
            PopularProductInterface::SKU_COLUMN_NAME,
            Table::TYPE_TEXT,
            64,
            ['nullable' => false],
            'Product SKU'
        )->addColumn(
            PopularProductInterface::FINAL_PRICE_COLUMN_NAME,
            Table::TYPE_DECIMAL,
            '12,4',
            ['nullable' => false],
            'Final Proce'
        )->addColumn(
            PopularProductInterface::SMALL_IMAGE_COLUMN_NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Product Image'
        )->addColumn(
            PopularProductInterface::PRODUCT_NAME_COLUMN_NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Product Name'
        )->setComment(
            'ALevel Popular Products Table'
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
