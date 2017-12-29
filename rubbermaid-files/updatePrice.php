<?php
	require_once('app/Mage.php');
	Mage::app('default');
	class ITEMS
	{
		public function index()    
		{
			//$products = Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect('*')->load();
			
			$products = Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect(array('name','price','special_price'));
			
			$i=1;
		
			foreach ($products as $product) {
			
				if($i>=1201 && $i<=1300){
					if($product->getSpecialPrice()!=''){
						$oldPrice = $product->getSpecialPrice();
						$increase = (8*$oldPrice)/100;
						$newPrice = round($oldPrice + $increase , 1);
						
						$product->setSpecialPrice($newPrice);
						$product->setId($product->getID());
						$product->save();
						echo $product->getName();
						echo "</br>";
					}					
				}
				
				$i++;
			}
			
			
		}
	}
	$obj = new ITEMS();
	$obj->index();
?>