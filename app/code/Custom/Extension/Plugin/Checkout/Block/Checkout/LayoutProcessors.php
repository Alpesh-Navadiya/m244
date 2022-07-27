<?php
/**
 * *
 *  @author DCKAP Team
 *  @copyright Copyright (c) 2018 DCKAP (https://www.dckap.com)
 *  @package Dckap_CustomFields
 */

namespace Custom\Extension\Plugin\Checkout\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

/**
 * Class LayoutProcessor
 * @package Custom\Extension\Plugin\Checkout\Block\Checkout
 */
class LayoutProcessors
{
    /**
     * @param LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    protected $_stateOption;
    public function __construct(
               \Custom\Repository\Model\Source\Salesoptions $stateOption
    ) {

        $this->_stateOption    = $stateOption;
    }
    public function afterProcess(
        LayoutProcessor $subject,
        array $jsLayout
    ) {
        $region = $this->_stateOption->getStates();
        $regionOptions[] = ['label' => 'Please Select..', 'value' => ''];
        foreach ($region as $field) {
            $regionOptions[] = ['label' => $field['title'], 'value' => $field['title']];
        }
        $shippingAddressFieldSet['region'] = '';


        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['drop_down'] = [

            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'region',
            ],
            'dataScope' => 'shippingAddress.delivery_comment',

            'label' => 'Sales man',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 251,
            'id' => 'delivery_comment',
            'options' => $regionOptions

        ];

        return $jsLayout;
    }


}
