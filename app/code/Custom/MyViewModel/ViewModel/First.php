<?php
namespace Custom\MyViewModel\ViewModel;

class First implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function firstMessage() {

        $customerObj = 'message from view model';
        return $customerObj;
    }
}
