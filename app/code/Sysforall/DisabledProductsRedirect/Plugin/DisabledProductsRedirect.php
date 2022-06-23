<?php
/**
 * Sysforall
 *
 * @category  Sysforall
 * @package   sysforall/module-disabledproductsredirect
 * @version   1.2.0
 * @author    Fransy
 */
namespace Sysforall\DisabledProductsRedirect\Plugin;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Request\Http;
use \Magento\Catalog\Controller\Product as ProductController;

class DisabledProductsRedirect
{
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     * 
     */

    protected $_storeManager;


    private $productRepository;

    /**
     * @var \Magento\Catalog\Api\CategoryRepositoryInterface
     */
    private $categoryInterface;
    
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private $messageManager;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    private $resultRedirectFactory;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface $categoryInterface
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryInterface,
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        Http $request
    ) {
        $this->_storeManager = $storeManager;
        $this->productRepository = $productRepository;
        $this->categoryInterface = $categoryInterface;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->scopeConfig = $scopeConfig;
        $this->request = $request;
    }
    /**
     * @param ProductController $subject
     */
    public function aroundExecute(ProductController $subject, callable $proceed)
    {
        $enable = $this->enable();
       
        if($enable)
        { 
            $productId = (int) $this->request->getParam('id');
            $product =  $this->productRepository->getById($productId);
            if ($product->isDisabled()) 
            {
                $cats = $product->getCategoryIds();
                if ($cats) {
                    try {
                        $firstCategoryId = $cats[0];
                        $category = $this->categoryInterface->get($firstCategoryId);
                        if ($category->getIsActive()) {
                            $message = $this->getMessage();
                             $base_url = $this->_storeManager->getStore()->getBaseUrl();
                            $categoryUrl = $base_url.$message;
                            $this->messageManager->addNoticeMessage($message);
                            $resultRedirect = $this->resultRedirectFactory->create();
                            $resultRedirect->setHttpResponseCode(301);
                            return $resultRedirect->setPath($categoryUrl); 
                        } else {
                            // TODO consider cases where category can't be displayed, maybe check other categories
                            throw new \Magento\Framework\Exception\LocalizedException(__('First category is not active'));
                        }
                    } catch (\Exception $e) {
                        return $proceed();
                    }
                }
            }
            return $proceed();
        } 
    }

    private function enable()
    {
     $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $message =  $this->scopeConfig->getValue(
            'sysforall/disabled_products_redirect/enable',
            $storeScope
        );
        return $message;   
    }

    private function getMessage()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $message =  $this->scopeConfig->getValue(
            'sysforall/disabled_products_redirect/redirection_message',
            $storeScope
        );
        if (!$message) {
            $message = __('The product you tried to view is not available but here are some other options instead');
        }
        return $message;
    }
}
