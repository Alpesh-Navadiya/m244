<?php
namespace Custom\EventsObservers\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class GetRecord implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $recordData = $observer->getEvent()->getRecord();
        $recordId = $recordData->getRecordId(); //get record id
        $name = $recordData->getName(); //get record name

        return $this;
    }
}
