<?php

namespace Custom\Repo\Controller\Index;

use Custom\Repo\Api\CustomRepositoryInterface;
use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;

class Delete extends Action
{

    protected $_testReporitory;
    protected $_request;

    public function __construct(Context $context, Http $request, CustomRepositoryInterface $testReporitory)
    {
        $this->_testReporitory = $testReporitory;
        $this->_request = $request;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $testId = $this->_request->getParam('id');
            $this->_testReporitory->deleteById($testId);
        } catch (Exception $e) {
            $this->messageManager->addException($e, $e->getMessage());
        }
    }
}
