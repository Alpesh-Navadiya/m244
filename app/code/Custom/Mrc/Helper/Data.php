<?php
namespace Custom\Mrc\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
class Data extends AbstractHelper
{
    protected $moduleList;
    protected $moduleReader;
    protected $_productCollectionFactory;
    protected $product;
    protected $orderModel;
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product $product,
        \Magento\Sales\Model\Order $orderModel,
        \Magento\Framework\Module\ModuleList $moduleList,
        \Magento\Framework\Module\Dir\Reader $moduleReader

    ) {
        $this->product = $product;
        $this->order = $orderModel;
        $this->moduleList = $moduleList;
        $this->moduleReader = $moduleReader;
        $this->_productCollectionFactory = $productCollectionFactory;

    }

    public function getCustomModules()
    {
            $modules = $this->moduleList->getNames();

        return $modules;
    }

    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create()
            ->addAttributeToSelect('*')
        ->setPageSize(3); // fetching only 3 products
        return $collection;
    }
    public function getProduct(){

        $collection = $this->_productCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->setPageSize(3); // fetching only 3 products


        $cusCollection = array(); //Custom Collection for retriving required data in controller
        $i=0;
        $productCollection = $this->product->collection;
        dd($productCollection);
        foreach ($productCollection as $product) {
            $cusCollection['items'][$i]['itemID'] = $product->getId();
            $id = $product->getId();
            $_productStock = $this->order->getStockItem($id);
            $productQty = $_productStock->getQty();
            $cusCollection['items'][$i]['name '] = $product->getName().' '.$productQty;
            $cusCollection['items'][$i]['sku '] = $product->getSku();
            $i++;
        }
        return $cusCollection;
    }

}
