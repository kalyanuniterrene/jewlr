
<?php
set_time_limit(0);
//echo("hi");
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
echo $_SERVER['REMOTE_ADDR'];
     if($_SERVER['REMOTE_ADDR']=="123.237.8.112" || $_SERVER['REMOTE_ADDR']=="117.222.74.159" || $_SERVER['REMOTE_ADDR']=="117.217.37.84"  || $_SERVER['REMOTE_ADDR']=="117.208.36.100")
	{ 
		//echo("hii");
		
		//mkdir("media/Lifestyle/Som_sofabed1", 0777);
		define('DIRECTORY', '/home/dev.willowandhall.co.uk/public_html/media/Lifestyle/Som_sofabed1/');
		
		require_once 'app/Mage.php';
		Mage::app('admin');
		$j = 0;
		$img=$sku=$filename=array(); 
		$_product = Mage::getModel('catalog/product')->loadByAttribute('sku','som22');
		
		if($_product->getTypeId() == "configurable"){
		$conf = Mage::getModel('catalog/product_type_configurable')->setProduct($_product);
		$simple_collection = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();
		foreach($simple_collection as $simple_product){
		if(substr_count($simple_product->getSku(),'Two seater-Open sprung')>0)
		echo "<br/>sk:".$sku[$j]=$simple_product->getSku();
		
		
			$j++;
	   }
	  }
	
	
	$media = Mage::getModel('catalog/product_attribute_media_api');
	$count = 0;
	echo " count:".count($sku);
	var_dump($sku);
//	for($i=0;$i<count($sku);$i++)
	foreach($sku as $key=>$sk)
	{
		
		/*8if(empty($sku[$i]))
		{
			continue;
		}
		$sk = $sku[$i];*/
		
		echo "<br/><br/>".$sk;
		
  $productid = Mage::getModel('catalog/product')
	                  ->getIdBySku(trim($sk));
 
// Initiate product model
$product = Mage::getModel('catalog/product');
 
// Load specific product whose tier price want to update
$product ->load($productid);
    //$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sk);
//echo "<pre>";
//print_r($product->getData());
    echo "<br/> pid:".$product->getId().'	<=product_id <br>';
	
    if ($product->getId() > 0)
    {
		
		echo $count."	<=Count<br>";
		$count++;
		$pos=-1;
		$mediaApi = Mage::getModel("catalog/product_attribute_media_api");
		$items = $mediaApi->items($product->getId());
		
		echo "image count: ".count($items);
		
		
			 
			echo "<br/>sku:".$sk;
				
			foreach($items as $item){
			
			if($pos==-1)
			{
				$pos=$item['position'];
			}
			
			if($item['position']==$pos )
			{
				
				$path='http://www.dev.willowandhall.co.uk/media/catalog/product'.$item['file'];
				echo "<br/>path:".$path;
				
				 $content = file_get_contents($path);
				$filename= explode('/', $path);
				
				 echo "<br/>filename:".$filename[8];
				echo $variable=substr($filename[8],'snow',strpos($filename[8],"."));
				file_put_contents(DIRECTORY.$filename[8], $content);
				echo "</br>downlaoded---".$path."----pos:".$pos;
				//break;
			}
			
			
			}  
			


	
    }
}	/*for loop end*/
       
  }//remote address

 
?>
