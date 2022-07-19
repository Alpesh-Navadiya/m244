<?php

namespace Custom\MyAjax\Controller\Index;

use Custom\MyAjax\Model\ContactFactory;

class recaptchaData extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $contactFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        ContactFactory $contactFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->contactFactory = $contactFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getParams();
        $request = $this->getRequest();
        $postData = $this->contactFactory->create();
        $remoteAddress = new \Magento\Framework\Http\PhpEnvironment\RemoteAddress($this->getRequest());
        $visitorIp = $remoteAddress->getRemoteAddress();

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $secret = '6LcXMeQgAAAAADJGi7IUbwTCdvwmdOeFnnN76Ia-';
        $response = null;
        $path = 'https://www.google.com/recaptcha/api/siteverify?';
        $secretKey = $secret;
        $response = $post["g-recaptcha-response"];
        $remoteIp = $visitorIp;

        $response = file_get_contents($path . "secret=$secretKey&response=$response&remoteip=$remoteIp");
        $answers = json_decode($response, true);
        if (trim($answers['success']) != true) {
            echo 'Invalid captcha please enter the valid captcha';
            exit;
        } else {
            $postData->setData($post)->save();
            $this->messageManager->addSuccessMessage(__("Successfully added the Hero %1"));

            return $this->_redirect('myajax/index/recaptcha');
        }
    }
}
