<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Model\ResourceModel\PopularProduct;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use ALevel\PopularProducts\Model\PopularProduct as Model;
use ALevel\PopularProducts\Model\ResourceModel\PopularProduct as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritDoc} */
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
