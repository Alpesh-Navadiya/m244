<?php
namespace Custom\Mrc\Model\ResourceModel\Hero;


use Custom\Mrc\Model\Hero;
use Custom\Mrc\Model\ResourceModel\Hero as HeroResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Hero::class, HeroResourceModel::class);
    }
}
