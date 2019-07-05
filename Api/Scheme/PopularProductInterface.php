<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Api\Scheme;

/**
 * Interface PopularProductInterface
 * @package ALevel\PopularProducts\Api\Scheme
 */
interface PopularProductInterface
{
    const TABLE_NAME = 'alevel_popular_products';

    const ID_COLUMN_NAME           = 'row_id';
    const PRODUCT_ID_COLUMN_NAME   = 'product_id';
    const SKU_COLUMN_NAME          = 'sku';
    const PRODUCT_NAME_COLUMN_NAME = 'name';
    const FINAL_PRICE_COLUMN_NAME  = 'final_price';
    const SMALL_IMAGE_COLUMN_NAME  = 'small_image';
}
