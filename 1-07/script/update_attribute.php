	<?php	
	set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
die;
    require_once 'app/Mage.php';
    Mage::app('admin');
Mage::app ()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
//$productCollection = Mage::getModel('catalog/product')->getCollection();


	/*$_product = Mage::getModel('catalog/product')->loadByAttribute('sku','FYFI-7S-LEFT');
	
	if($_product->getTypeId() == "configurable"){
    $conf = Mage::getModel('catalog/product_type_configurable')->setProduct($_product);
$simple_collection = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();
$i=0;
echo "count".count($simple_collection);
foreach($simple_collection as $_product) 
{*/
//die('kdjf');
$fp = fopen("media/import/fyfield.csv", 'r'); 

	
	$j = 0;
	$img=$skuc=array();  
	
	while(($website=fgetcsv($fp))) 
	{
	$skuc[$j]=$website[0];

	$j++;
	}
echo "<br/> count ".count($skuc);
$k=0;
$skuc=array("");
	for($i=0;$i<count($skuc);$i++)
	{
		$sku = trim($skuc[$i]);
		echo "<br/><br/>".'updating '.$sku."...\n";
      $product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);    
  echo  $pid= $product->getId() ;
	
	
  //echo "count".substr_count($sku, "Seven");
    
    
   // $product = Mage::getModel('catalog/product')->load($_product->getEntityId());
		if(substr_count($sku, "Seven")>0)
		{
			continue;
			echo 'in if';
		
		$product->setData('size_sofabed', 223)->getResource()->saveAttribute($product, 'size_sofabed');
		}
		else if(substr_count($sku, "Eight")>0)
		{
			
			echo 'in else';
		$product->setData('size_sofabed', 222)->getResource()->saveAttribute($product, 'size_sofabed');
		}
	
		
   echo  $k++;
  // if($k==5)
  //  exit;
    
}


			
			
			
			
			
			
			
	?>
