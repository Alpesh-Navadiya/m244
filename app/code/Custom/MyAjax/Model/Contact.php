<?php

namespace Custom\MyAjax\Model;

use Magento\Framework\Model\AbstractModel;
use Custom\MyAjax\Model\ResourceModel\Contact as ContactResourceModel;

class Contact extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ContactResourceModel::class);
    }
}
