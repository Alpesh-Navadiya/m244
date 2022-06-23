<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace custom\MyModule\Controller\Adminhtml\crud;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Custom\MyModule\Helper\Data $helperData)
    {
        $this->_pageFactory = $pageFactory;
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->helperData->getGeneralConfig('enable');
        return $this->_pageFactory->create();
    }
}
