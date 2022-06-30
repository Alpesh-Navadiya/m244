<?php

namespace Custom\Mrc\Model;


class Custom  implements \Custom\Mrc\Api\CustomInterface
{
    protected $_customerFactory;

    public function __construct(
        \Custom\Mrc\Model\ResourceModel\Hero\CollectionFactory $customerFactory
    ) {
        $this->_customerFactory = $customerFactory;
    }
    /** * @return string */

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
      //  return $returnArray;
    }


    /**
     * {@inheritdoc}
     */
    public function setData($data)
    {
        try {
        $title =  $data['title'];
        $content =$data['content'];
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('jc_superhero');

        $sql = "Insert Into " . $tableName . " ( title, content) Values ('".$title."','".$content."')";
         $connection->query($sql);
             $response = ['status' => true, 'data' => "Record successfully saved"];

        } catch (\Exception $e) {
            dd($e);
        }
        echo $returnArray = json_encode($response);
        die();
    }

}
