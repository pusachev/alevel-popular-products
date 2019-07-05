<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Api\Data;

use ALevel\PopularProducts\Api\Scheme\PopularProductInterface;

/**
 * Class PopularProductsInterface
 * @package ALevel\PopularProducts\Api\Data
 */
interface PopularProductsInterface extends PopularProductInterface
{
    const CACHE_TAG_ID = 'alevel_popular_product';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $productId
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setProductId(int $productId) : PopularProductsInterface;

    /**
     * @return int|null
     */
    public function getProductId() : ?int;

    /**
     * @param string $sku
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setSku(string $sku) : PopularProductsInterface;

    /**
     * @return string|null
     */
    public function getSku() : ?string;

    /**
     * @param string $productName
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setName(string $productName) : PopularProductsInterface;

    /**
     * @return string|null
     */
    public function getName() : ?string;

    /**
     * @param float $finalPrice
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setFinalPrice(float $finalPrice) : PopularProductsInterface;

    /**
     * @return float|null
     */
    public function getFinalPrice() : ?float;

    /**
     * @param string $smallImage
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setSmallImage(string $smallImage) : PopularProductsInterface;

    /**
     * @return string|null
     */
    public function getSmallImage() : ?string;
}
