<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');
$fp = fopen("missing_sku_final.csv", 'r'); 
$j = 0;
while(($website=fgetcsv($fp))) 
{

if($j==0)
				{
					$j++;
					continue;
						
				}

$sku=$website[0];
$final_sku=$website[1];
$price=$website[2];
$spl_price_org=$website[3];
$weight=$website[4];
$ups=$website[5];
if($ups=="Y")
{
	$ups_code=4;
}
else
{
	$ups_code =3;
}


//Load the product by sku

$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
$product_id = Mage::getModel("catalog/product")->getIdBySku( $sku );


//this code is running under a controllers action method.
echo $product_id;

if($spl_price_org<=100)
		{
			$spc_price = $spl_price_org*1.08;//special price is incremented 8%
			
		}

		else
		{
			$spc_price = $spl_price_org*1.06;//special price is incremented 6%
			
		}


        //important
        Mage::setIsDeveloperMode(true);
        Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));

        //load product
        $product = Mage::getModel("catalog/product")->load($product_id);

        //Update product details
        
        $product->setPrice($price);
        $product->setSku($final_sku);
        $product->setSpecialPrice($spc_price);
        $product->setWeight($weight);
        $product->setPackageName($ups_code);
       
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
if($j==150)
{
exit();
}
}
fclose($fp);
?>
