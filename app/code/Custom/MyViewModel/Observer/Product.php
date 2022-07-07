<?php
namespace Custom\MyViewModel\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Product implements ObserverInterface
{
    public function execute(Observer $observer)
    {

        $recordData = $observer->getEvent()->getData('collection');
        foreach($recordData as $product){
            $price = $product->getData('price');
            $name = $product->getData('name');
            if($price < 100){
                $name .= '- ev';
            } else {
                $name .= '- ob';
            }
            $product->setData('name',$name);
        }

    }
}
