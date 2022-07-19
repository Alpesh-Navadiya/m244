<?php
namespace Custom\MyAjax\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contact extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('myajax_contact', 'id');
    }
}
