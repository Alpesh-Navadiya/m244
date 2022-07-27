<?php
namespace Custom\Repository\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    protected $logger;

    protected $_stateOption;

    /**
     * LayoutProcessor constructor.
     *
     * @param \Custom\Repository\Model\Stateoptions $stateOptions
     */
    public function __construct(
        \Custom\Repository\Model\Source\Salesoptions $stateOption
      ) {
        $this->_stateOption    = $stateOption;
    }


    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_date'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/date',
                'options' => [],
                'id' => 'delivery-date'
            ],
            'dataScope' => 'shippingAddress.delivery_date',
            'label' => 'Delivery Date',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 250,
            'id' => 'delivery-date'
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_comment'] = [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/textarea',
                'options' => [],
                'id' => 'delivery-comment'
            ],
            'dataScope' => 'shippingAddress.delivery_comment',
            'label' => 'Delivery Comment',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 250,
            'id' => 'delivery-comment'
        ];
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
            'dataScope' => 'shippingAddress.region',

            'label' => 'Sales man',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 251,
            'id' => 'region',
            'options' => $regionOptions

        ];

        return $jsLayout;
    }
}
