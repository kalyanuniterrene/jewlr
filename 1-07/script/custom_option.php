<?php
require_once 'app/Mage.php';
umask(0);

Mage::app('admin');

// If your database is having lots of data then use set_time_limit / ini_set
//set_time_limit(0);
//ini_set('memory_limit','1024M');

$option = array(
    'title' => 'custom option title',
    'type' => 'radio', // could be drop_down ,checkbox , multiple
    'is_require' => 1,
    'sort_order' => 0,
    'values' => getOptions()
    );

$collection = Mage::getModel('catalog/product')->getCollection();

foreach ($collection as $product_all) {

        $sku = $product_all['sku'];
        // retrieve product id using sku
        $product_id = Mage::getModel('catalog/product')->getIdBySku($sku);

        //In Case of creating a new product.
        /*$product = Mage::getModel('catalog/product');
        $product->setProductOptions(array($option));
        $product->setCanSaveCustomOptions(true);*/

        //Or if we are adding the options to a already created product.
        $product = Mage::getModel('catalog/product')->load($product_id);
        $product->setProductOptions(array($option));
        $product->setCanSaveCustomOptions(true);

        //Do not forget to save the product
        $product->save();
        echo "Done
";
}

function getOptions(){
   return array(
   array(
    'title' => 'Option Value 1',
    'price' =>100,
    'price_type' => 'fixed',
    'sku' => 'sku for 1',
    'sort_order' => '1'
    ),
array(
    'title' => 'Option Value 2',
    'price' =>100,
    'price_type' => 'fixed',
    'sku' => 'sku for 2',
    'sort_order' => '1'
    ),
  array(
    'title' => 'Option Value 3',
    'price' =>100,
    'price_type' => 'fixed',
    'sku' => 'sku for 3',
    'sort_order' => '1'
    )
);
}
