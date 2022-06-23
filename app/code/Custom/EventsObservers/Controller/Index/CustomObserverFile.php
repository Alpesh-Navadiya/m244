<?php
namespace Custom\EventsObservers\Controller\Index;
class CustomObserverFile extends \Magento\Framework\App\Action\Action {
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
       $helper = $this->dataHelper->CustomerData();
       
       $data = $this->_eventManager->dispatch('md_customobserver_log', ['custom_text' =>  $helper]);
        
       $resultPage->getConfig()->getTitle()->prepend(__('Welcome to MD Custom Observer module ok.'));
       
       return $resultPage;
    }
}
?>
