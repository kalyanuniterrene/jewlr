<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');
$fp = fopen("product-price.csv", 'r'); 
$j = 0;
while(($website=fgetcsv($fp))) 
{

$sku=$website[0];
$manufracture_name=$website[1];
$price=$website[2];
$weight=$website[3];
//Load the product by sku

$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
$product_id = Mage::getModel("catalog/product")->getIdBySku( $sku );


//this code is running under a controllers action method.
echo $product_id;
        //important
        Mage::setIsDeveloperMode(true);
        Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));

        //load product
        $product = Mage::getModel("catalog/product")->load($product_id);

        //Update product details
        $product->setStatus(1); 
        $product->setPrice($price);
        $product->setWeight($weight);
        $product->setManufacturerLongName($manufracture_name);
        //using the setAttributeName we can update any other detail of the product.

        try { 
            $product->save(); 
            echo "Product updated------------product sku is--------- ".$sku;
            echo "<br/>";
            
        }catch(Exception $ex) { 
            echo "Product not updated------------product sku is--------- ".$sku;
            echo "<br/>";
        } 



$j++;
if($j==200)
{
exit();
}
}
fclose($fp);
?>
