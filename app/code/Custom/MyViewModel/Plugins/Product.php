<?php
namespace Custom\MyViewModel\Plugins;
class product {
    public function aftergetName(\Magento\Catalog\Model\Product $product,$name){
         $price = $product->getData('price');
         if($price < 60){
             $name .= ' - '.' its cool price using plugin';
         } else{
             $name .= ' - '.' Expensive product';
         }
         return $name;
    }
}
?>
