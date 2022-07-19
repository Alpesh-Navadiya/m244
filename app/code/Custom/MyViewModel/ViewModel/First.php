<?php

namespace Custom\MyViewModel\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class First implements ArgumentInterface
{
    public function firstMessage()
    {

        $customerObj = 'message from view model';
        return $customerObj;
    }
}
