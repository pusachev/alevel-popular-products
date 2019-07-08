<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 08.07.19
 * Time: 22:33
 */

namespace ALevel\PopularProducts\Model\Observer\Backend;

use Magento\Framework\Event\Observer;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\Framework\Event\ObserverInterface;

use ALevel\PopularProducts\Model\Indexer\PopularProducts;

class CatalogProductSaveAfterObserver implements ObserverInterface
{
    /**
     * @var IndexerRegistry
     */
    private $indexerRegistry;
    private $indexerPopularProducts;

    public function __construct(IndexerRegistry $indexerRegistry , PopularProducts $popularProducts)
    {
        $this->indexerRegistry = $indexerRegistry;
        $this->indexerPopularProducts = $popularProducts;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();

        if ($product) {
            $this->indexerPopularProducts->executeRow($product->getSku());
        }
    }
}