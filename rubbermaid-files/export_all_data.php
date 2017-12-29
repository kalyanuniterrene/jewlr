<?php

/* Author: Shourya Chowdhury
 * 
 * 
 * 
 * */

require_once 'app/Mage.php';
umask(0);
Mage::app('default');

$export_file = "var/export/allprodata-final.csv"; // assumes that you're running from the web root. var/ is typically writable
 $export = fopen($export_file, 'w') or die("Permissions error."); // open the file for writing.  if you see the error then check the folder permissions.

 $output = "";

 $output = "sku,price,special_price,weight,ups,shipping_cost\r\n"; // column names. end with a newline.
 fwrite($export, $output); // write the file header with the column names

$collection = Mage::getResourceModel('catalog/product_collection');
foreach($collection as $product) {
   $pro_id = $product->getId();
	$_product = Mage::getModel('catalog/product')->load($pro_id);
	
	
	
	
	if ($pro_id) 
	{
		//print_r($_product->getData());
		$sku = $_product->getSku();
		$price = $_product->getPrice();
		$spl_price = $_product->getSpecialPrice();
		$weight = $_product->getWeight();
		$shipping_cost = $_product->getShippingCost();
		
		$package_name = $_product->getPackageName();
			
			if($package_name == 4)
			{
				$ups = "Y";
			}
			else
			{
				$ups = "N";
			}
		
	}
	
	$output = ""; // re-initialize $output on each iteration
    
     $output .= '"'.$_product->getSku().'",'; 
     $output .= '"'.$price.'",'; 
     $output .= '"'.$spl_price.'",'; 
     $output .= '"'.$weight.'",'; 
     $output .= '"'.$ups.'",'; 
     $output .= '"'.$shipping_cost.'",'; 
    
     // add any other fields you want here 
     $output .= "\r\n"; // add end of line
		
	//die;
	fwrite($export, $output); // write to the file handle "$export" with the string "$output".
}
   fclose($export); // close the file handle.
