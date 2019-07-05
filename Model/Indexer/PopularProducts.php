<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Model\Indexer;

use ALevel\PopularProducts\Model\ResourceModel\PopularProduct;
use Magento\Framework\Indexer\ActionInterface as ActionInterface;
use Magento\Framework\Mview\ActionInterface as MViewActionInterface;

class PopularProducts implements ActionInterface, MViewActionInterface
{
    private $resource;


    public function __construct(PopularProduct $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Execute full indexation
     *
     * @return void
     */
    public function executeFull()
    {
        $select = $this->resource->getConnection()->select();

        $select->from(
            ["p" => $this->resource->getTable('catalog_product_entity')]
        )->join([
            'v' => $this->resource->getTable('catalog_product_entity_varchar')
        ], 'p.entity_id = v.');
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
    public function executeRow($id)
    {
        $test = 1;
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
}
