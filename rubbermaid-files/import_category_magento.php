<?php
/*
 * Author name: Shourya Chowdhury
 *
 * Description: Import All The Categroies From The Old Site To The New Site
 */

$mageFilename = 'app/Mage.php';
require_once $mageFilename;
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
umask(0);
Mage::app('admin');
Mage::register('isSecureArea', 1);
//$parentId = '2';
$j=1;
$fp = fopen("categories.csv", 'r'); //Csv File Which Consists All The Categroies of the old site

while(($website=fgetcsv($fp))) 
	{
		if($j==1)
		{
			$j++;
			continue;
		
		}
	$id=$website[0];
	$name=$website[1];
	$parentname=$website[2];
	
	try
	{
	$category = Mage::getModel('catalog/category');
	$category->setName($name);
	 //$category->setId($id);
	//$category->setUrlKey('your-cat-url-key');
	$category->setIsActive(1);
	$category->setDisplayMode('PRODUCTS');
	$category->setIsAnchor(1); //for active anchor
	//$category->setStoreId(Mage::app()->getStore()->getId());
	//$parentCategory = Mage::getModel('catalog/category')->load($parentid);
	
	$Category = Mage::getResourceModel('catalog/category_collection')
    ->addFieldToFilter('name', $parentname)
    ->getFirstItem();
    
   
	
	$categoryId = $Category->getId();
	
	$category->setStoreId(Mage::app()->getStore()->getId());
	$parentCategory = Mage::getModel('catalog/category')->load($categoryId);
	
	//die;
	
	$category->setPath($parentCategory->getPath());
	 $category->save();
	} 
	catch(Exception $e) 
	{
	print_r($e);
	}
	
	
	
	}
	//print_r($sku);
	//print_r($img);
	fclose($fp);

?>
