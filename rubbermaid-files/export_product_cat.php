<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');

$fp = fopen("pro-categories.csv", 'r');// open the csv 

$j = 0; //initialization the variable

while(($website=fgetcsv($fp))) 
{

		/*Skip The First Row Of The CSV*/

		if($j==0)
		{
			$j++;
			continue;
				
		}
		/******/

		$sku=$website[1];//get the sku
		$cat1=$website[2];//get the cat1
		$cat2=$website[3];//get the cat2
		$cat3=$website[4];//get the cat3
		$cat4=$website[5];//get the cat4
		$cat5=$website[6];//get the cat5
		$cat6=$website[7];//get the cat6
		$cat7=$website[8];//get the cat7
		$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);//Load the product by sku
		for($i=1;$i<=7;$i++)
		{
			$cat[$i] = $website[$i+1];
			
			
			if($cat[$i] !='')
			{
				$collection=Mage::getResourceModel('catalog/category_collection')
				->addAttributeToFilter('name',$cat[$i])->addAttributeToSelect('*');
				foreach ($collection as $category) 
				{
						$categoryId = $category->getId();
						$categories[] = $categoryId;
						$product->setCategoryIds($categories);
						$product->save();
					//$cat_arr = array($category->getId());
					//$product->setCategoryIds("2,6,66");
					//product->save();
					//echo "Product updated------------product sku is--------- ".$sku;
					
				}
				echo "Product updated------------product sku is--------- ".$sku."<br/>";
				
			}
			
			
		}
		
		
				
				
		
				//$product->setCategoryIds($cat_arr);

				try 
				{ 
					//$product->save(); //save the product
					//echo "Product updated------------product sku is--------- ".$sku;
					//echo "<br/>";
					
				}
				catch(Exception $ex) 
				{ 
					//echo "Product not updated------------product sku is--------- ".$sku;
					//echo "<br/>";
				} 
						
				
				//~ $product->setCategoryIds($categories);
				//~ $product->save();
		
 
		
		
		if($j==100)
		{
		exit();
		}


		$j++;// increment the j value
		
}// end while

fclose($fp);// close the csv
?>
