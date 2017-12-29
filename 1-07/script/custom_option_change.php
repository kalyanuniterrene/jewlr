<?php

$magePath = 'app/Mage.php'; 

require_once $magePath;

Varien_Profiler::enable(); 

Mage::setIsDeveloperMode(true); 

ini_set('display_errors', 1);

umask(0);

Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$product_ids = array(8578);

$productmodel = Mage::getModel('catalog/product');

foreach ($product_ids as $product_id) 
{ 

/**i use this two arrays for collecte value because i uses inside setData of 
current option*/

$cos=array();
$co=array();

$product = $productmodel->load($product_id);

$options = $product->getProductOptionsCollection();

if (isset($options)) 
{ 

foreach ($options as $o) 
{
	$options = array(
    "title" => "Custom Text Field Option Title",
    "type" => "field",
    "is_require" => 1,
    "sort_order" => 0,
    "additional_fields" => array(
        array(
            "price" => 10.00,
            "price_type" => "fixed",
            "sku" => "custom_text_option_sku",
            "max_characters" => 255
        )
    )
); // Look at guides how to create this array
$product->setCanSaveCustomOptions(true);
$product->getOptionInstance()->addOption($options);
$product->setHasOptions(true);
	 
$product->save();
$title = $o->getTitle();

/**
this block is for changing information of specific option from collection options inside
current product
the save method for this option in end of code
*/

if ($title == "Line-Ftont") 
{ 

$o->setProduct($product); 

$o->setTitle("LineFtont"); 

$o->setType("drop_down"); 

$o->setIsRequire(1);

$o->setSortOrder(10);


}

/**
this block for update or add information of specific value inside current option
*/

$optionType = $o->getType(); 

//test type

if ($optionType == "drop_down") 
{ 

//getting collection of value related to current option

$values = $o->getValuesCollection(); 

$found = false; 

foreach ($values as $k => $v) 
{ 

//test existing of value for update

if (1 == preg_match("/valueiwant/i", $v->getTitle())) { 

//update and save

$v->setTitle("Sliconize")

->setSku("kk")

->setPriceType("fixed")

->setSortOrder(0)

->setPrice(floatval(13.0000));

$v->setOption($o)->save();

/**
this ligne is important i collecte all value required for normalize save function 
related to current option
*/

$cos[]=$v->toArray($co);

} 
} 


/**
create new value object you can use $option->getValueInstance() for working with 
getSingleton
*/
//~ 
$value = Mage::getModel('catalog/product_option_value'); 

$value->setOption($o) 

->setTitle('valueiwant') 

->setSku("nn")

->setPriceType("fixed")

->setSortOrder(1)

->setPrice(12)

/**
this ligne is important (relation forigien key) for related this new value
to specific option
*/

->setOptionId($o->getId());

$value->save();
//~ 
//~ /**
//~ this ligne is important i collecte all value required for normalize save function   
//~ related to current option
//~ */
$cos[]=$value->toArray($co);
} 


$o->setData("values",$cos)->save();

//var_dump($cos);

}


}
else
{
	
	echo "here";
	
}
}
