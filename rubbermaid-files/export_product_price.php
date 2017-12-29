<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');

$fp = fopen("product_sheet.csv", 'r');// open the csv 

$j = 0; //initialization the variable

while(($website=fgetcsv($fp))) 
{

		/*Skip The First Row Of The CSV*/

		if($j==0)
		{
			$j++;
			continue;
				
		}
		/******/

		$sku=$website[0];//get the sku
		$price=$website[1];// get the price
		$spl_price_org=$website[2];// get the special price
		
		/*Check The Price is below 100 or Not*/
		
		if($spl_price_org<=100)
		{
			$spc_price = $spl_price_org*1.08;//special price is incremented 8%
			
		}

		else
		{
			$spc_price = $spl_price_org*1.06;//special price is incremented 6%
			
		}

		/*****/
		
		$weight=$website[3];// get the product weight
		
		$ups=$website[4];// get the ups value yes or not
		
		if($ups == "Y")
		{
			$pcg_id = 4;// Package  set as UPS
		}
		else
		{
			$pcg_id = 3;// Package set as LTL
		}
		
		

		$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);//Load the product by sku
		$product_id = Mage::getModel("catalog/product")->getIdBySku( $sku );//Load the product id


		//this code is running under a controllers action method.
		
		Mage::setIsDeveloperMode(true);
		Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));

		//load product by product id
		$product = Mage::getModel("catalog/product")->load($product_id);


		$product->setPrice($price);// set the price of the product
		$product->setSpecialPrice($spc_price);// set the special price of the product
		$product->setWeight($weight);// set the weight of the product
		$product->setPackageName($pcg_id);// set the package name of the product
		

		try 
		{ 
			$product->save(); //save the product
			echo "Product updated------------product sku is--------- ".$sku;
			echo "<br/>";
			
		}
		catch(Exception $ex) 
		{ 
			echo "Product not updated------------product sku is--------- ".$sku;
			echo "<br/>";
		} 
		
		if($j==2)
		{
		//exit();
		}


		$j++;// increment the j value
		
}// end while

fclose($fp);// close the csv
?>
