<?php

namespace Custom\Repo\Controller\Index;

class Edit extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $request;
    protected $coreRegistry;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->pageFactory = $pageFactory;
        $this->request = $request;
        $this->coreRegistry = $coreRegistry;
        return parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->request->getParam('id');
        $this->coreRegistry->register('editId', $id);
        return $this->pageFactory->create();
    }
}
