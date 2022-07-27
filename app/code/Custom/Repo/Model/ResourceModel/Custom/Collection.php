<?php

namespace Custom\Repo\Model\ResourceModel\Custom;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Custom\Repo\Model\Custom::class,
            \Custom\Repo\Model\ResourceModel\Custom::class
        );
    }
}
