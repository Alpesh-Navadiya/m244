<?php
namespace Custom\EventsObservers\Block;

/*
 * Webkul Hello Block
 */

class Depen extends \Magento\Framework\View\Element\Template
{
    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * getContentForDisplay
     * @return string
     */
    public function getContentForDisplay()
    {
        //return __("Successful! This is a sample module in Magento 2 by webkul.");
    }
}