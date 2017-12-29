<?php
	
	umask(0);
	require 'app/Mage.php'; //include magento libraries
	Mage::app('admin');
	$collection = Mage::getResourceModel('catalog/product_collection');
	$pro_count = 0;
	$fp = fopen("sku_name.csv", 'r');// open the csv 

	$pro_count = 0; //initialization the variable

	while(($website=fgetcsv($fp))) 
	{
		if($pro_count==0)
		{
			$pro_count++;
			continue;
				
		}
		$pro_count++;
		$sku=$website[1];//get the sku
		$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);//Load the product by sku
		
		if($pro_count == 50)
		{ 
			exit();
			 
		}
		$pro_id = $product->getId();

		$sku = $product->getSku();
		
		$dirname = "/home/uniterrene2015/public_html/dev/rmaid/products/design/".$sku."/";
		$media = Mage::getModel('catalog/product_attribute_media_api'); 
		$count = 0;
		
		//~ $dirname = '.';

$pattern="(\.jpg$)|(\.png$)|(\.jpeg$)"; //valid image extensions 



if($handle = opendir($dirname)) {



	while(false !== ($file = readdir($handle)))
	{
		$sku = $product->getSku();

		if(eregi($pattern, $file))
		{ 

			$source = "http://uniterreneprojects.com/dev/rmaid/products/design/".$sku."/";

			$items = $media->items($product->getId());
			$label="";
			$positn="";
			$import = $dirname.$file;
				

			if (count($items) > 0) 
			{
				echo "image Successfully Removed from----".$sku."<br/>"; 
				foreach($items as $item) 
				{
				$media->remove($product->getId(), $item['file']);
				}
			}
			$newImage = array(
			'file' => array(
			'content' => base64_encode($import),
			'mime' => 'image/jpeg',
			'name' => basename($import),
			),
			'label' => $label, // change this. 
			'position' => $positn,
			'types' => array('small_image','thumbnail','image'),
			'exclude' => 0,
			); 
			$media->create($sku, $newImage);
			echo "image succesfully inserted into product-----".$sku."--with image name ".$file."<br/>";
			echo "<br/>";

		}

	}



	closedir($handle);



} 


		
		
		
		
	
	

	}




		

	
		
	
    
	
?>
