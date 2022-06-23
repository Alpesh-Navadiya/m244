<?php
namespace Custom\Repository\Model\ResourceModel\Allnews;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
	
	protected $_eventPrefix = 'news_allnews_collection';

    protected $_eventObject = 'allnews_collection';
	
	/**
     * Define model & resource model
     */
	protected function _construct()
	{
		$this->_init('Custom\Repository\Model\Allnews', 'Custom\Repository\Model\ResourceModel\Allnews');
	}
}