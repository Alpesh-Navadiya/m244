<?php

namespace Custom\Repo\Model\ResourceModel;

class Custom extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_repo', 'entity_id');
    }
}
