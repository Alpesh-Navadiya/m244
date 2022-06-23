<?php

namespace Ak\DemoRecaptcha\Controller\Index;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_request;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->_request = $request;
        parent::__construct($context);
    }
    public function execute()
    {
        echo "<pre>";
        $data = $this->_request->getPostValue();
        print_r($data);
        echo "save you data here";
        exit();
    } // main Executtion function
}