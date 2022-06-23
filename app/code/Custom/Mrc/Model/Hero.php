<?php
namespace Custom\Mrc\Model;
use Magento\Framework\Model\AbstractModel;

class Hero extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Hero::class);
    }
}
