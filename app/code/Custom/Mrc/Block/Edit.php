<?php

namespace Custom\Mrc\Block;

class Edit extends \Magento\Framework\View\Element\Template
{
     protected $_pageFactory;
     protected $_coreRegistry;
     protected $_modelLoader;

     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\Registry $coreRegistry,
          \Custom\Mrc\Model\HeroFactory $modelLoader,
          array $data = []
     ){
          $this->_pageFactory = $pageFactory;
          $this->_coreRegistry = $coreRegistry;
          $this->_modelLoader = $modelLoader;
          return parent::__construct($context,$data);
     }

     public function execute()
     {
          return $this->_pageFactory->create();
     }

     public function getEditData()
     {
           $id = $this->_coreRegistry->registry('id');
           $postData = $this->_modelLoader->create();
           $result = $postData->load($id);
           $result = $result->getData();
           return $result;
     }
}