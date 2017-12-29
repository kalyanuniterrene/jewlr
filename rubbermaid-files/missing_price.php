<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');

$fp = fopen("product_sheet.csv", 'r'); 
	
	$export_file = "miss-price.csv";
	

$collection = Mage::getResourceModel('catalog/product_collection');
foreach($collection as $product) 
{
   $pro_id = $product->getId();
	$_product = Mage::getModel('catalog/product')->load($pro_id);
	
	if ($pro_id) 
	{
		
		if($_product->getSpecialPrice() ==$_product->getPrice())
		{
			//echo $name = $_product->getName();echo "<br/>";
			//echo "here";
		echo $sku = $_product->getSku();echo "<br/>";
		//$shortdescription = $_product->getFinalPrice();
			
		}
		
		
	}
	
	
	
	
	
	
}




?>
