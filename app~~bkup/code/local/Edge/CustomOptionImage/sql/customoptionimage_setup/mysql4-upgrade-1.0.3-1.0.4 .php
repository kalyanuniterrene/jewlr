<?php

$this->startSetup();


$this->getConnection()->addColumn($this->getTable('catalog/product_option'), 'message', 'TEXT NULL');




$this->endSetup();
