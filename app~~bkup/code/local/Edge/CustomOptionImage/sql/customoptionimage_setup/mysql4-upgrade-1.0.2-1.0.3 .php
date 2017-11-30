<?php

$this->startSetup();


$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'template', 'TEXT NULL');
$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'height', 'TEXT NULL');
$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'width', 'TEXT NULL');


$this->endSetup();
