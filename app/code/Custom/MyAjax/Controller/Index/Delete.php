<?php

namespace Custom\MyAjax\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $request;
    protected $contactFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Custom\MyAjax\Model\ContactFactory $contactFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->request = $request;
        $this->contactFactory = $contactFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->request->getParam('id');

        $postData = $this->contactFactory->create();
        $result = $postData->setId($id);
        $result = $result->delete();
        return $this->_redirect('myajax/index/index');
    }
}
