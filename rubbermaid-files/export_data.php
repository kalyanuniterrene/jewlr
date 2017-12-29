<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
require_once 'app/Mage.php';
Mage::app('admin');

$fp = fopen("pro-categories2.csv", 'r');// open the csv 

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

		echo $sku=$website[0];//get the sku
		
		$cat1=$website[1];//get the cat1
		$cat2=$website[2];//get the cat2
		$cat3=$website[3];//get the cat3
		$cat4=$website[4];//get the cat4
		$cat5=$website[5];//get the cat5
		$cat6=$website[6];//get the cat6
		$cat7=$website[7];//get the cat7
		$cat =$cat1;
		if($cat2 !='')
		{
			$cat ="";
			$cat = $cat1.",".$cat2;
		}
		if($cat3 !='')
		{
			$cat ="";
			$cat = $cat1.",".$cat2.",".$cat3;
		}
		if($cat4 !='')
		{
			$cat ="";
			$cat = $cat1.",".$cat2.",".$cat3.",".$cat4;
		}
		if($cat5 !='')
		{
			$cat ="";
			$cat = $cat1.",".$cat2.",".$cat3.",".$cat4.",".$cat5;
		}
		if($cat6 !='')
		{
			$cat ="";
			$cat = $cat1.",".$cat2.",".$cat3.",".$cat4.",".$cat5.",".$cat6;
		}
		if($cat7 !='')
		{
			$cat ="";
			$cat = $cat1.",".$cat2.",".$cat3.",".$cat4.",".$cat5.",".$cat6.",".$cat7;
		}
		
		$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);//Load the product by sku
		
		$product->setCategoryIds($cat);
						$product->save();
		
		
				echo "Product updated------------product sku is--------- ".$sku;
				
		
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
		
 
		
		
		if($j==200)
		{
		exit();
		}


		$j++;// increment the j value
		
}// end while

fclose($fp);// close the csv
?>

