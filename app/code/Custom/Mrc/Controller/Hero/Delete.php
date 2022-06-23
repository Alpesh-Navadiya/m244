<?php
namespace Custom\Mrc\Controller\Hero;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

class Delete extends Action
{
    protected $_pageFactory;
     protected $_request;
     protected $_modelFactory;

     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\App\Request\Http $request,
          \Custom\Mrc\Model\HeroFactory $modelFactory
     ){
          $this->_pageFactory = $pageFactory;
          $this->_request = $request;
          $this->_modelFactory = $modelFactory;
          return parent::__construct($context);
     }

     public function execute()
     {
       try {
         
            $id = $this->_request->getParam('id');
            $postData = $this->_modelFactory->create();
            $result = $postData->setId($id);
            $result = $result->delete();
            $this->messageManager->addSuccessMessage(__("Record deleted successfully..."));
        } catch (\Exception $e) {
            dd($e);
        }
         // return $this->_redirect('superhero/index/index');
     }

}
