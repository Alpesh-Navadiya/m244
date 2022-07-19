<?php

namespace Custom\MyAjax\Block;

use Custom\MyAjax\Model\ContactFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Template
{
    protected $pageFactory;
    protected $coreRegistry;
    protected $contactLoader;

    public function __construct(
        Context        $context,
        PageFactory    $pageFactory,
        Registry       $coreRegistry,
        ContactFactory $contactLoader,
        array          $data = []
    ) {
        $this->pageFactory = $pageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->contactLoader = $contactLoader;
        return parent::__construct($context, $data);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }

    public function getEditData()
    {
        $id = $this->coreRegistry->registry('editId');
        $postData = $this->contactLoader->create();
        $result = $postData->load($id);
        $result = $result->getData();
        return $result;
    }
}
