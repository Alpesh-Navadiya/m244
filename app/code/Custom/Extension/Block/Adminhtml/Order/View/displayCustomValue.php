<?php
namespace Custom\Extension\Block\Adminhtml\Order\View;

use Magento\Sales\Api\Data\OrderInterface;
class displayCustomValue extends \Magento\Backend\Block\Template
{
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        OrderInterface $orderInterface,
        array $data = []
    ) {
        $this->orderInterface = $orderInterface;
        parent::__construct($context, $data);
    }
    public function getDeliveryComment(){
        $orderId = $this->getRequest()->getParam('order_id');
        $order = $this->orderInterface->load($orderId);

        return $order->getDeliveryComment();
    }
}
