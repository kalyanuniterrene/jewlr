<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');
$product_collection = Mage::getModel('catalog/product')->getCollection()->setOrder('name', 'desc'); 
 //getting the product collection, results are ordered by product name
       $j=0;
      foreach($product_collection as $_product)
       {
		 echo  $sku_final = $_product->getSku();
		 echo "<br/>";
           $sku = $_product->getSku();
           $sku = preg_replace('/\s+/', '', $sku);
           $sku = preg_replace('/\-+/', '', $sku);
          // echo $sku."<br/>";
           
           $_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku_final);
		   $product_id = Mage::getModel("catalog/product")->getIdBySku( $sku_final );	
		   
			Mage::setIsDeveloperMode(true);
			Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));

			//load product
			$product = Mage::getModel("catalog/product")->load($product_id);

			//Update product details
			$product->setStatus(1); 
			$product->setSku($sku);
			//using the setAttributeName we can update any other detail of the product.

			try { 
				if($j<=1300)
				
				{
					if($j>900)
					{
					//$product->save(); 
					}
				}
			//echo "Product updated------------product sku is--------- ".$sku;
			echo "<br/>";

			}
			catch(Exception $ex) 
			{ 
			echo "Product not updated------------product sku is--------- ".$sku;
			echo "<br/>";
			} 
		   $j++;
		   
       }

?>
