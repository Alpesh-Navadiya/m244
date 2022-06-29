<?php
namespace Custom\MyOrder\Model\Api;

class Custom {

    protected $orderCollectionFactory;
    protected $orderModel;

    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
       \Magento\Sales\Model\Order $orderModel
    ) {
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->orderModel = $orderModel;

    }

    public function getPost()
    {
        $collection = $this->orderCollectionFactory->create()
            ->addAttributeToSelect('increment_id')
            ->addAttributeToSelect('customer_email')
            ->addAttributeToSelect('customer_firstname')
            ->addAttributeToSelect('customer_lastname')
            ->addAttributeToSelect('entity_id')
            ->addAttributeToSelect('grand_total')
            ->addAttributeToSelect('shipping_method');
        $res = array();
        if(!empty($collection->getData())) {
            foreach ($collection->getData() as $data) {
                $orderIncrementId = $data["increment_id"];
                $order = $this->orderModel->loadByIncrementId($orderIncrementId);

                $payment = $order->getPayment();
                $method = $payment->getMethodInstance();
                $pay = $method->getTitle();
                $res[] = ["increment_id" => $data["increment_id"],
                    "entity_id" => $data["entity_id"],
                    "customer_name" => $data["customer_firstname"] . " " . $data["customer_lastname"],
                    "customer_email" => $data["customer_email"],
                    "shipping_method" => $data["shipping_method"],
                    "grand_total" => $data["grand_total"],
                    "pay_method" => $pay,
                ];
            }
            $response = ['status' => true, 'data' => $res];
            echo $returnArray = json_encode($response);
            die();
        }
    }

}
