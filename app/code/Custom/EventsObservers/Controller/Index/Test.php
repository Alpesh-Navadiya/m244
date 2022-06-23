<?php
namespace Custom\EventsObservers\Controller\Index;
class Test extends \Magento\Framework\App\Action\Action {
    protected $resultPageFactory;

protected $dataHelper;

     public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $resultPageFactory,
       \Custom\EventsObservers\Helper\Data $dataHelper

    ) {
       $this->resultPageFactory = $resultPageFactory;
       $this->dataHelper = $dataHelper;

       parent::__construct($context);
    }
    public function execute() {
     
       $resultPage = $this->resultPageFactory->create();
       
       return $resultPage;
    }
}