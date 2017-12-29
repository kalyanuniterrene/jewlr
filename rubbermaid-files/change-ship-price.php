<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');

$collection = Mage::getResourceModel('catalog/product_collection');
$j=1;
foreach($collection as $product) 
{
		$pro_id = $product->getId();
		$_product = Mage::getModel('catalog/product')->load($pro_id);
		$shipping_rate =  $_product->getShippingCost();
		$package_name  =  $_product->getPackageName();
		//~ if($package_name==3)
		//~ {
			//~ $shipping_rate =  $_product->setShippingCost('');
			//~ $_product->save(); //save the product
			//~ echo "Product updated------------product id is--------- ".$pro_id;
			//~ //echo "Product Id Is ".$pro_id;
			//~ echo "<br/>";
		//~ }
		if($shipping_rate>89)
		{
			
			if($package_name ==4)
			{
				echo $shipping_rate."<br/>";
				 $_product->setShippingCost(12.50);
				
				echo "shipping price change ";
				//$_product->save(); //save the product
				echo "Product updated------------product id is--------- ".$pro_id;
				echo "<br/>";
			
			}
			 
		}
		//~ $j=1;
		//~ if($package_name==4)
		//~ {
			//~ if($pro_id>871)
			//~ {
			//~ $spcl_price = $_product->getSpecialPrice();
				//~ if($spcl_price<=250)
				//~ {
					//~ $shipping_rate_final =  $spcl_price*.13;
					
					 //~ $_product->setShippingCost($shipping_rate_final);
					
					 //~ echo "shipping price change ";
					 //~ $_product->save(); //save the product
					 //~ echo "Product updated------------product id is--------- ".$pro_id." with the shipping Price ".$shipping_rate_final;
					 //~ echo "<br/>";
				//~ }
				//~ else
				//~ {
					//~ $shipping_rate_final =  $spcl_price*.11;
					 //~ $_product->setShippingCost($shipping_rate_final);
					
					 //~ echo "shipping price change ";
					 //~ $_product->save(); //save the product
					 //~ echo "Product updated------------product id is--------- ".$pro_id." with the shipping Price ".$shipping_rate_final;
					 //~ echo "<br/>";
				//~ }
				
				
			//~ }
			//~ $j++;
		//~ }
		
}

 ?>   
