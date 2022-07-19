<?php
namespace Custom\MyOrder\Model;

use Magento\Framework\App\ObjectManager;

class Subscriber extends \Magento\Newsletter\Model\Subscriber
{
    /**
     * @var \Magento\Customer\Model\GroupFactory
     */
    protected $_customerGroup;
    /**
     * @var \Magento\Store\Model\Website
     */
    protected $_website;

    /**
     * @var \Magento\SalesRule\Model\Rule
     */
    protected $_salesRule;

    public function sendConfirmationSuccessEmail()
    {

//        if ($this->getImportMode()) {
//            dd($this);
//            return $this;
//        }
      //  dd('asdasd');
        if (!$this->_scopeConfig->getValue(
            self::XML_PATH_SUCCESS_EMAIL_TEMPLATE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        ) || !$this->_scopeConfig->getValue(
                self::XML_PATH_SUCCESS_EMAIL_IDENTITY,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        ) {
            return $this;
        }

        $this->inlineTranslation->suspend();

        $this->_transportBuilder->setTemplateIdentifier(
            $this->_scopeConfig->getValue(
                self::XML_PATH_SUCCESS_EMAIL_TEMPLATE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        )->setTemplateOptions(
            [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->_storeManager->getStore()->getId(),
            ]
        )->setTemplateVars(
            ['subscriber' => $this, 'coupon_code' => $this->generateCouponCode()]
        )->setFrom(
            $this->_scopeConfig->getValue(
                self::XML_PATH_SUCCESS_EMAIL_IDENTITY,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        )->addTo(
            $this->getEmail(),
            $this->getName()
        );
        $transport = $this->_transportBuilder->getTransport();


        try {
            $transport->sendMessage();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }


        $this->inlineTranslation->resume();

        return $this;
    }

    protected function generateCouponCode()
    {
        try {
            $couponData = [];
            $couponData['name'] = '$5 Gift Voucher Newsletter Subscription (' . $this->getEmail() . ')';
            $couponData['is_active'] = '1';
            $couponData['simple_action'] = 'by_fixed';
            $couponData['discount_amount'] = '5';
            $couponData['from_date'] = date('Y-m-d');
            $couponData['to_date'] =  date('Y-m-d', strtotime($couponData['from_date'] . ' + 7 days'));
            $couponData['uses_per_coupon'] = '1';
            $couponData['coupon_type'] = '2';
            $couponData['customer_group_ids'] = $this->getCustomerGroupIds();
            $couponData['website_ids'] = $this->getWebsiteIds();
            /** @var \Magento\SalesRule\Model\Rule $rule */
            $rule = $this->_getSalesRule();
            $couponCode = $rule->getCouponCodeGenerator()->setLength(10)->setAlphabet(
                'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijk$#'
            )->generateCode();
            $couponData['coupon_code'] = $couponCode;
            $rule->loadPost($couponData);
            $rule->save();
            return $couponCode;
        } catch (\Exception $e) {
            dd($e);//return null;
        }
    }

    /**
     * @return \Magento\Customer\Model\Group
     */
    protected function _getCustomerGroup()
    {
        if ($this->_customerGroup === null) {
            $this->_customerGroup = ObjectManager::getInstance()->get(\Magento\Customer\Model\Group::class);
        }
        return $this->_customerGroup;
    }
    /**
     * Retrieve the customer group ids
     *
     * @return array
     */
    protected function getCustomerGroupIds()
    {
        $groupsIds = [];
        $collection = $this->_getCustomerGroup()->getCollection();

        foreach ($collection as $group) {
            $groupsIds[] = $group->getId();
        }
        return $groupsIds;
    }

    /**
     * @return \Magento\Store\Model\Website
     */
    protected function _getWebsite()
    {
        if ($this->_website === null) {
            $this->_website = ObjectManager::getInstance()->get(\Magento\Store\Model\Website::class);
        }
        return $this->_website;
    }
    /**
     * Retrieve the website ids
     *
     * @return array
     */
    protected function getWebsiteIds()
    {
        $websiteIds = [];
        $collection = $this->_getWebsite()->getCollection();

        foreach ($collection as $website) {
            $websiteIds[] = $website->getId();
        }
        return $websiteIds;
    }
    /**
     * @return \Magento\SalesRule\Model\Rule
     */
    protected function _getSalesRule()
    {
        if ($this->_salesRule === null) {
            $this->_salesRule = ObjectManager::getInstance()->get(\Magento\SalesRule\Model\Rule::class);
        }
        return $this->_salesRule;
    }
}
