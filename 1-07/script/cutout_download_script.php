
<?php
set_time_limit(0);
//echo("hi");
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
echo $_SERVER['REMOTE_ADDR'];
     if($_SERVER['REMOTE_ADDR']=="123.237.8.112" || $_SERVER['REMOTE_ADDR']=="117.222.74.159" || $_SERVER['REMOTE_ADDR']=="117.217.37.84"  || $_SERVER['REMOTE_ADDR']=="117.208.36.100")
	{ 
		//echo("hii");
		
		mkdir("media/export/Hamp/Hamp-2SO", 0777);
		define('DIRECTORY', '/home/dev.willowandhall.co.uk/public_html/media/export/Hamp/Hamp-2SO');
		
		require_once 'app/Mage.php';
		Mage::app('admin');
		$j = 0;
		$img=$sku=$filename=array(); 
		$_product = Mage::getModel('catalog/product')->loadByAttribute('sku','BTR-2SO');
		
		if($_product->getTypeId() == "configurable"){
		$conf = Mage::getModel('catalog/product_type_configurable')->setProduct($_product);
		$simple_collection = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();
		foreach($simple_collection as $simple_product){
		if(substr_count($simple_product->getSku(),'Two')>0){	
		 $sku[$j]=$simple_product->getSku();
		}
			$j++;
	   }
	  
	}
	
	
	$media = Mage::getModel('catalog/product_attribute_media_api');
	$count = 0;
	echo " count:".count($sku);
	for($i=0;$i<count($sku);$i++)
	{
		
		$sk = trim($sku[$i]);
   
    $product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sk);
    echo "<br/>".$product->getId().'	<=product_id <br>';
	
    if ($product->getId() > 0)
    {
		
		echo $count."	<=Count<br>";
		$count++;
		$pos=-1;
		$mediaApi = Mage::getModel("catalog/product_attribute_media_api");
		$items = $mediaApi->items($product->getId());
		
		echo "<br/>image count: ".count($items);
		
		
			 
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
				file_put_contents(DIRECTORY.$filename[8], $content);
				echo "</br>downlaoded---".$path."----pos:".$pos;
				break;
			}
			
			
			}  
			
		} 
	
			//-------------- end removal of repeated image -------------------------
		/*****/
     //  print_r($import); 
	//  echo "----Deleted---";
	
    }
		if($i==1)
		{
			break;
			}
       
  }//remote address

 
?>
