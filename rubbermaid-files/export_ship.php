<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');
$fp = fopen("missing-ship-cost.csv", 'r'); 
$j = 0;
while(($website=fgetcsv($fp))) 
{

$sku=$website[0];
$price=$website[1];



if($price>250)
{
	$shipping_cost = $price*.11;
}
else
{
	$shipping_cost = $price*.13;
}



$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
$product_id = Mage::getModel("catalog/product")->getIdBySku( $sku );

Mage::setIsDeveloperMode(true);
        Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));


//this code is running under a controllers action method.
echo $product_id;
if($product_id)
{
$_product->setShippingCost($shipping_cost);
       
       
        //using the setAttributeName we can update any other detail of the product.

        try { 
            $_product->save(); 
            echo "Product updated------------product sku is--------- ".$sku;
            echo "<br/>";
            
        }catch(Exception $ex) { 
            echo "Product not updated------------product sku is--------- ".$sku;
            echo "<br/>";
        } 

    if($j==200)
    
    {
		exit();
	}


$j++;
}
        
}
fclose($fp);
?>
