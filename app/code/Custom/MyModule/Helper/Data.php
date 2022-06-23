<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\MyModule\Helper;

use Magento\Store\Model\ScopeInterface;

/**
 * Customer address helper
 *
 * @api
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @since 100.0.2
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * VAT Validation parameters XML paths
     */
    
    const XML_PATH_RSGITECH_PATH = 'rsgitech_news/';

  
    /**
     * Address constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\View\Element\BlockFactory $blockFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param CustomerMetadataInterface $customerMetadataService
     * @param AddressMetadataInterface $addressMetadataService
     * @param \Magento\Customer\Model\Address\Config $addressConfig
     */


    public function getConfigValue($field,$store = null)
    {

        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getGeneralConfig($fieldid,$store = null)
    {       
        return $this->getConfigValue(self::XML_PATH_RSGITECH_PATH.'General/'.$fieldid,$store);
    }
}
