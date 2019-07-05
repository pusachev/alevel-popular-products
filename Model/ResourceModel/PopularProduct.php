<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Model\ResourceModel;

use ALevel\PopularProducts\Api\Scheme\PopularProductInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PopularProduct extends AbstractDb
{
    /** {@inheritDoc} */
    protected function _construct()
    {
        $this->_init(
            PopularProductInterface::TABLE_NAME,
            PopularProductInterface::ID_COLUMN_NAME
        );
    }
}
