<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

use ALevel\PopularProducts\Api\Data\PopularProductsInterface;
use ALevel\PopularProducts\Model\ResourceModel\PopularProduct as ResourceModel;

class PopularProduct
    extends AbstractModel
    implements PopularProductsInterface, IdentityInterface
{
    /** {@inheritDoc} */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [
            sprintf(
                "%s_%d",
                self::CACHE_TAG_ID,
                (int)$this->getId()
            )
        ];
    }

    /**
     * @param int $productId
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setProductId(int $productId): PopularProductsInterface
    {
        $this->setData(self::PRODUCT_ID_COLUMN_NAME, $productId);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->getData(self::PRODUCT_ID_COLUMN_NAME);
    }

    /**
     * @param string $sku
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setSku(string $sku): PopularProductsInterface
    {
        $this->setData(self::SKU_COLUMN_NAME, $sku);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->getData(self::SKU_COLUMN_NAME);
    }

    /**
     * @param string $productName
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setName(string $productName): PopularProductsInterface
    {
        $this->setData(self::PRODUCT_NAME_COLUMN_NAME, $productName);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(self::PRODUCT_NAME_COLUMN_NAME);
    }

    /**
     * @param float $finalPrice
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setFinalPrice(float $finalPrice): PopularProductsInterface
    {
        $this->setData(self::FINAL_PRICE_COLUMN_NAME, $finalPrice);

        return $this;
    }

    /**
     * @return float|null
     */
    public function getFinalPrice(): ?float
    {
        return $this->getData(self::FINAL_PRICE_COLUMN_NAME);
    }

    /**
     * @param string $smallImage
     * @return \ALevel\PopularProducts\Api\Data\PopularProductsInterface
     */
    public function setSmallImage(string $smallImage): PopularProductsInterface
    {
        $this->setData(self::SMALL_IMAGE_COLUMN_NAME);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSmallImage(): ?string
    {
        return $this->getData(self::SMALL_IMAGE_COLUMN_NAME);
    }
}
