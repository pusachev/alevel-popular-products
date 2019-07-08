<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Model\Indexer;

use ALevel\PopularProducts\Model\ResourceModel\PopularProduct;
use Magento\Framework\Indexer\ActionInterface as ActionInterface;
use Magento\Framework\Mview\ActionInterface as MViewActionInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class PopularProducts implements ActionInterface, MViewActionInterface
{
    private $resource;

    public function __construct(PopularProduct $resource)
    {
        $this->resource = $resource;

    }


    public function executeFull()
    {
        $connection = $this->resource->getConnection();
        $name ='name';
        $small_image = 'small_image';
        $price = 'price';
        $is_popular = 'is_popular';
        $pv4value = 1;

        $tableName = $this->resource->getTable('alevel_popular_products');
        $connection->truncateTable($tableName);

        $select = $connection->select()->from(
            ["p" => $this->resource->getTable('catalog_product_entity')],[])
        ->joinInner(['pv' => $this->resource->getTable('catalog_product_entity_varchar')],
            'pv.entity_id = p.entity_id',[])
        ->joinInner(['pv2' => $this->resource->getTable('catalog_product_entity_varchar')],
            'pv2.entity_id = p.entity_id',[])
        ->joinInner(['pv3' => $this->resource->getTable('catalog_product_entity_decimal')],
            'pv3.entity_id = p.entity_id',[])
        ->joinRight(['pv4' => $this->resource->getTable('catalog_product_entity_int')],
            'pv4.entity_id = p.entity_id',[])
        ->joinInner(['ea' => $this->resource->getTable('eav_attribute')],
            'ea.`attribute_id`= pv.`attribute_id`',[])
        ->joinInner(['ea2' => $this->resource->getTable('eav_attribute')],
            'ea2.`attribute_id`= pv2.`attribute_id`',[])
        ->joinInner(['ea3' => $this->resource->getTable('eav_attribute')],
            'ea3.`attribute_id`= pv3.`attribute_id`',[])
        ->joinRight(['ea4' => $this->resource->getTable('eav_attribute')],
            'ea4.`attribute_id`= pv4.`attribute_id`',[])

        ->where('ea.attribute_code = ?', $name)
        ->where('ea2.attribute_code= ?',$small_image)
        ->where('ea3.attribute_code= ?',$price)
        ->where('ea4.attribute_code= ?',$is_popular)
        ->where( 'pv4.value = ?',$pv4value)
        ->columns([
         'final_price' => 'pv3.value',
            'small_image' => 'pv2.value',
            'sku' => 'p.sku',
            'name' => 'pv.value',
        'product_id' => 'p.entity_id'
        ]);

        $connection->query(
        $connection->insertFromSelect(
            $select,
            $this->resource->getTable('alevel_popular_products'),
            ['final_price','small_image','sku','name','product_id'],
            AdapterInterface::INSERT_IGNORE)
    );
    }

    /**
     * Execute partial indexation by ID list
     *
     * @param int[] $ids
     * @return void
     */
    public function executeList(array $ids)
    {
        $test = 1;
    }

    /**
     * Execute partial indexation by ID
     *
     * @param int $id
     * @return void
     */
    public function executeRow($sku)
    {

        $connection = $this->resource->getConnection();
        $name ='name';
        $small_image = 'small_image';
        $price = 'price';
        $is_popular = 'is_popular';
        $pv4value = 1;

        $tableName = $this->resource->getTable('alevel_popular_products');
        $connection->delete($tableName,['sku = ?' => $sku]);

        $select = $connection->select()->from(
            ["p" => $this->resource->getTable('catalog_product_entity')],[])
            ->joinInner(['pv' => $this->resource->getTable('catalog_product_entity_varchar')],
                'pv.entity_id = p.entity_id',[])
            ->joinInner(['pv2' => $this->resource->getTable('catalog_product_entity_varchar')],
                'pv2.entity_id = p.entity_id',[])
            ->joinInner(['pv3' => $this->resource->getTable('catalog_product_entity_decimal')],
                'pv3.entity_id = p.entity_id',[])
            ->joinRight(['pv4' => $this->resource->getTable('catalog_product_entity_int')],
                'pv4.entity_id = p.entity_id',[])
            ->joinInner(['ea' => $this->resource->getTable('eav_attribute')],
                'ea.`attribute_id`= pv.`attribute_id`',[])
            ->joinInner(['ea2' => $this->resource->getTable('eav_attribute')],
                'ea2.`attribute_id`= pv2.`attribute_id`',[])
            ->joinInner(['ea3' => $this->resource->getTable('eav_attribute')],
                'ea3.`attribute_id`= pv3.`attribute_id`',[])
            ->joinRight(['ea4' => $this->resource->getTable('eav_attribute')],
                'ea4.`attribute_id`= pv4.`attribute_id`',[])

            ->where('ea.attribute_code = ?', $name)
            ->where('ea2.attribute_code= ?',$small_image)
            ->where('ea3.attribute_code= ?',$price)
            ->where('ea4.attribute_code= ?',$is_popular)
            ->where( 'pv4.value = ?',$pv4value)
            ->where('p.sku = ?',$sku)
            ->columns([
                'final_price' => 'pv3.value',
                'small_image' => 'pv2.value',
                'sku' => 'p.sku',
                'name' => 'pv.value',
                'product_id' => 'p.entity_id'
            ]);

        $connection->query(
            $connection->insertFromSelect(
                $select,
                $this->resource->getTable('alevel_popular_products'),
                ['final_price','small_image','sku','name','product_id'],
                AdapterInterface::INSERT_IGNORE
            )
        );
    }

    /**
     * Execute materialization on ids entities
     *
     * @param int[] $ids
     * @return void
     * @api
     */
    public function execute($ids)
    {
        $test = 1;
    }
    public function executeDeleteRow($sku)
    {
        $tableName = $this->resource->getTable('alevel_popular_products');
        $connection = $this->resource->getConnection();

        $where = $connection->quoteInto('sku = ?', $sku);
        $connection->delete($tableName, $where);
    }
}
