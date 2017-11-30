<?php

$this->startSetup();


$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'class1', 'TEXT NULL');
$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'class2', 'double NULL');


$this->endSetup();
