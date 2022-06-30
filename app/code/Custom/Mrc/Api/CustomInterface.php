<?php
 namespace  Custom\Mrc\Api;


interface CustomInterface {

     /**
      * @return mixed
      */

     public function getData();

    /**
     * POST for test api
     * @param string[] $data
     * @return string
     */

    public function setData($data);
 }

 ?>
