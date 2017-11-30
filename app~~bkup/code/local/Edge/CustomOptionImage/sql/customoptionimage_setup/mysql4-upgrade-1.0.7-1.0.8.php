<?php

$this->startSetup();

$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'description', 'longtext NULL');




$this->endSetup();
