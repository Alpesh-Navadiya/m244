<?php
namespace Custom\MyViewModel\ViewModel;

class Second implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
     protected $productCollectionFactory;
    public  function __construct(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory  $productCollectionFactory){
        $this->productCollectionFactory = $productCollectionFactory;

    }
    public function getProduct() {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(5); // fetching only 3 products
        return $collection;

    }
}
