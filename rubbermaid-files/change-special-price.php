<?php


// drop into Magento root directory updateprice.php and execute

require_once('app/Mage.php');
ob_implicit_flush(true);
umask(0);
set_time_limit(0);
ini_set('display_errors', 1);
ini_set('memory_limit', '12048M');
Mage::setIsDeveloperMode(true);
Mage::app();
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$_productCollection = Mage::getModel('catalog/product')
                        ->getCollection()
                        ->addAttributeToSort('created_at', 'DESC')
                        ->addAttributeToSelect('*')
                        ->load();
                        $j=0;
foreach ($_productCollection as $_product){
	
	if($j>=1200 && $j<=1300 )
	{
  
   echo "Special Price is ".$_product->getSpecialPrice().'</br>';
   
   $new_price = $_product->getSpecialPrice()*1.08;
   
    $_product->setSpecialPrice($new_price);
   
   echo "Price Updated is ".($_product->getSpecialPrice()*1.08).'</br>';
   
   try { 
            $_product->save(); 
            echo "Product updated------------product sku is--------- ".$_product->getSku();
            echo "<br/>";
            
        }catch(Exception $ex) { 
            echo "Product not updated------------product sku is--------- ".$_product->getSku();
            echo "<br/>";
        } 
       
	}
	 $j++;
}
