
<?php
		set_time_limit(0);
		error_reporting(E_ALL ^ E_NOTICE);
		ini_set("display_errors",'On');
		$_SERVER['REMOTE_ADDR'];
		
		if($_SERVER['REMOTE_ADDR']=="123.237.8.112" || $_SERVER['REMOTE_ADDR']=="117.222.74.159" || $_SERVER['REMOTE_ADDR']=="117.217.37.84"  || $_SERVER['REMOTE_ADDR']=="117.208.36.100")
		
	{ 
		    $folder_Name=$_GET['name'];/*Get The Name of the folder*/
		    //$csv_Name=$_GET['csv'];/*Get The Name of the Csv*/
			
			require_once 'app/Mage.php';
			Mage::app('admin');
			$j = 0;
			$img=$sku=$filename=array(); 
			$_product = Mage::getModel('catalog/product')->loadByAttribute('sku','WE2');
			
			if($_product->getTypeId() == "configurable")
			{
			$conf = Mage::getModel('catalog/product_type_configurable')->setProduct($_product);
			echo"hi";
			$simple_collection = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();
				/*foreach($simple_collection as $simple_product)
				{
			if(substr_count($simple_product->getSku(),'two-seater')>0)
			echo "<br/>sk:".$sku[$j]=$simple_product->getSku();
			$j++;
		}
	  }
		
			$media = Mage::getModel('catalog/product_attribute_media_api');
			$count = 0;
			echo " count:".count($sku);
			var_dump($sku);
			
			foreach($sku as $key=>$sk)
		{
				echo "<br/><br/>".$sk;
				$productid = Mage::getModel('catalog/product')->getIdBySku(trim($sk));
				// Initiate product model
				$product = Mage::getModel('catalog/product');
				// Load specific product whose tier price want to update
				$product ->load($productid);
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
					$source='media/catalog/product'.$item['file'];
					$sourceArr= explode('/', $source);
					$countSourceArr=count($sourceArr);
					$destFilename =$sourceArr[$countSourceArr-1];
					$destination = DIRECTORY.$destFilename;
					echo $source.'###'.$destination."<br>";
					copy($source, $destination);
					break;
				}
			}  
		}
	}*/	/*for loop end*/
       
  }//remote address

 
?>
