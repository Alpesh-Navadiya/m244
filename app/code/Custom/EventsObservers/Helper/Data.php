<?php
namespace Custom\EventsObservers\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
class Data extends AbstractHelper
{
       public function CustomerData()
       {
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $om->get('Magento\Customer\Model\Session');
        
       return  $customerData = $customerSession->getCustomer()->getData(); //get all data of customerData
        //$customerData = $customerSession->getCustomer()->getId();//get id of customer
       }
}
