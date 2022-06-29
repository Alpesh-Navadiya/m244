<?php

namespace Custom\Mrc\Model;

/**
 * Class CustomApi
 *
 * @package Rk\CustomRestApi\Model
 */
class Custom implements \Custom\Mrc\Api\CustomInterface
{
    protected $_customerFactory;

    public function __construct(
        \Custom\Mrc\Model\ResourceModel\Hero\CollectionFactory $customerFactory
    ) {
        $this->_customerFactory = $customerFactory;
    }

    /**
     * Get Customer List
     * @return string
     */

    public function getData()
    {
        $response = ['success' => false];
        try {
            $customerCollection = $this->_customerFactory->create();

            $response = ['status' => false, 'message' => 'Error while fetching data'];
            if (count($customerCollection->getData())) {
                $customList = $customerCollection->getData();

                $response = ['status' => true, 'data' => $customList];
            } else {
                $response = ['status' => false, 'message' => 'No record found'];
            }

        } catch (\Exception $e) {
         dd($e);
        }
        echo $returnArray = json_encode($response);
            die();
       // return $returnArray;
    }

}
