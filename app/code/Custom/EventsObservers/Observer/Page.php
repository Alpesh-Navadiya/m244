<?php
namespace Custom\EventsObservers\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Page implements ObserverInterface
{
    public function execute(Observer $observer)
    {
       // dd($observer);
       $_page = $observer->getPage();  // you will get page object
       // dd($_page);
        return $this;
    }
}
