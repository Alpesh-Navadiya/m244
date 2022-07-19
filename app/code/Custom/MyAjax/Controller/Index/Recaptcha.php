<?php

namespace Custom\MyAjax\Controller\Index;

class Recaptcha extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Recaptcha Form'));
        return $resultPage;
    }

//    public function execute()
//    {
//        $post = $this->getRequest()->getParams();
//        $request = $this->getRequest();
//        $remoteAddress = new \Magento\Framework\Http\PhpEnvironment\RemoteAddress($this->getRequest());
//        $visitorIp = $remoteAddress->getRemoteAddress();
//
//        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
//        $secret = '6LcXMeQgAAAAADJGi7IUbwTCdvwmdOeFnnN76Ia-';
//        $response = null;
//        $path = 'https://www.google.com/recaptcha/api/siteverify?';
//        $secretKey = $secret;
//        $response = $post["g-recaptcha-response"];
//        $remoteIp = $visitorIp;
//
//        $response = file_get_contents($path."secret=$secretKey&response=$response&remoteip=$remoteIp");
//        $answers = json_decode($response, true);
//        if (trim($answers['success']) != true) {
//            echo 'Invalid captcha please enter the valid captcha';exit;
//        } else {
//            echo 'Captcha is valid';exit;
//        }
//
//    }
}
