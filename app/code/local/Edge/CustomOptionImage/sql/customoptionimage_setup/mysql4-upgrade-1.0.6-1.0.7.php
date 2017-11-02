<?php

$this->startSetup();


$this->getConnection()->addColumn($this->getTable('catalog/product_option'), 'min_image_size_y', 'smallint(5) NULL');
$this->getConnection()->addColumn($this->getTable('catalog/product_option'), 'min_image_size_x', 'smallint(5) NULL');
$this->getConnection()->addColumn($this->getTable('catalog/product_option'), 'min_val_msg', 'TEXT NULL');




$this->endSetup();
