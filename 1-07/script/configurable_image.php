
<?php

echo $_SERVER['REMOTE_ADDR'];
     if($_SERVER['REMOTE_ADDR']=="123.237.8.112" || $_SERVER['REMOTE_ADDR']=="117.222.74.159" || $_SERVER['REMOTE_ADDR']=="117.217.37.84"  || $_SERVER['REMOTE_ADDR']=="117.208.36.100")
	{ 
   
	
    require_once '../app/Mage.php';
    Mage::app('admin');

	$j = 0;
	$img=$sku=array(); 
	
	
	$_product = Mage::getModel('catalog/product')->loadByAttribute('sku','DO-3S');
	echo $_product->getId();
	
	if($_product->getTypeId() == "configurable"){
		$media = Mage::getModel('catalog/product_attribute_media_api');
		 $mediaApi = Mage::getModel("catalog/product_attribute_media_api");
		$items = $mediaApi->items($_product->getId());
		$img_count=0;
		foreach($items as $item){
			echo $path='media/catalog/product'.$item['file'];
			echo "<br/>";
		}
    
  
}
	
	
	
  }//remote address
 
?>
