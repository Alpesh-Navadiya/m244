<?php
namespace Custom\MyOrder\Observer\Admin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;

class LoginSuccess implements ObserverInterface
{

    /**
     * @var \Magento\Framework\HTTP\Header
     */
    protected $_httpHeader;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlInterface;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\Timezone
     */
    protected $_dateTimeFormater;

    /**
     * @var TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\HTTP\Header $httpHeader,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\Stdlib\DateTime\Timezone $dateTimeFormater,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->_httpHeader = $httpHeader;
        $this->_urlInterface = $urlInterface;
        $this->_dateTimeFormater = $dateTimeFormater;
        $this->_transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
    }

    public function execute(Observer $observer)
    {
        $authUser = $observer->getEvent()->getUser();
        $name = $authUser->getName();
        $email = $authUser->getEmail();

        $store = $this->_storeManager->getStore();
        $userData = new \Magento\Framework\DataObject();
        $templateParams = [
            'name' => $name,
            'ip_address' => $this->getIpAddress(),
            'login_url' => $this->getCurrentUrl(),
            'referrer_url' => $this->getReferrerUrl(),
            'logged_in_at' => $this->getLoggedInAt(),
            'browser_information' => $this->getHttpUserAgent()
        ];

        $userData->setData($templateParams);
        $this->_transportBuilder->setTemplateIdentifier(
            'admin_emails_login_success_email_template'
        )->setTemplateOptions(
            [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $store->getId(),
            ]
        )->setTemplateVars(
            ['user' => $userData, 'store' => $store]
        )->setFrom(
            'general'
        )->addTo(
            $email,
            $name
        );

        $transport = $this->_transportBuilder->getTransport();

        try {
            $transport->sendMessage();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Get Current Time
     *
     * @return string
     */
    private function getLoggedInAt()
    {
        foreach ($this->_dateTimeFormater->date() as $key => $value) {
            if ($key == 'date') {
                return $value;
            }
        }
        return '';
    }

    /**
     * Get Current URL
     *
     * @return string
     */
    private function getCurrentUrl()
    {
        return $this->_urlInterface->getCurrentUrl();
    }

    /**
     * Get Referer URL
     *
     * @return string
     */
    private function getReferrerUrl()
    {
        return !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    }

    /**
     * Get User agent (i.e. browser) of the device used during the login.
     *
     * @return string
     */
    private function getHttpUserAgent()
    {
        return $this->_httpHeader->getHttpUserAgent();
    }

    /**
     * Get the ip property
     * The function can get Real IP address from visitors when they are using proxy
     *
     * @return string
     */
    private function getIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipAddress = 'UNKNOWN';
        }
        return $ipAddress;
    }
}
