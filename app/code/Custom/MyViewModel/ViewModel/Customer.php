<?php

namespace Custom\MyViewModel\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Customer implements ArgumentInterface
{
    public function getMessage()
    {
        $customerObj = 'message from view model';
        return $customerObj;
    }
}
