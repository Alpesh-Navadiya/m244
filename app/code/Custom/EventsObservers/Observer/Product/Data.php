<?php
namespace Custom\EventsObservers\Observer\Product;
use Magento\Framework\Event\Observer;

use Magento\Framework\Event\ObserverInterface;

class Data implements ObserverInterface

{

    /**

     * Below is the method that will fire whenever the event runs!

     *

     * @param Observer $observer

     */

    public function execute(Observer $observer)

    {

        $product = $observer->getProduct();

        $originalName = $product->getName();

        $modifiedName = $originalName . ' - Events and Observers';

        $product->setName($modifiedName);

    }

}