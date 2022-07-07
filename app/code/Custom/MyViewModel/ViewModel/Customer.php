<?php
namespace Custom\MyViewModel\ViewModel;

class Customer implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getMessage() {
        $customerObj = 'message from view model';
        return $customerObj;
    }
}
