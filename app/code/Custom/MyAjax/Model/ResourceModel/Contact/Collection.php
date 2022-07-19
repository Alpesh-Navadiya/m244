<?php

namespace Custom\MyAjax\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Custom\MyAjax\Model\Contact as ContactModel;
use Custom\MyAjax\Model\ResourceModel\Contact as ContactResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(ContactModel::class, ContactResourceModel::class);
    }
}
