<?php
namespace Custom\EventsObservers\Observer;
class CustomObserver implements \Magento\Framework\Event\ObserverInterface {
    public function execute(\Magento\Framework\Event\Observer $observer) {
       $observer_data = $observer->getData('custom_text');
     
    //    $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/admin.log');
    //    $logger = new \Zend\Log\Logger();
    //    $logger->addWriter($writer);
    //    $logger->info($observer_data);
       return $this;
    }
}