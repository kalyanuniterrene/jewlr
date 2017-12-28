<?php

require_once 'app/Mage.php';

umask(0);
Mage::init('default');
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

$productId = $_REQUEST['pid'];
$product = Mage::getModel('catalog/product')->load($productId);

$customOptions = $product->getOptions();

foreach ($customOptions as $option) {

    $option_name = $_REQUEST['name'];
    if ($option->getDefaultTitle() == $option_name) {
        $option->delete();
    }
}

$product->setHasOptions(1);
$product->save();
echo "you are done now";
