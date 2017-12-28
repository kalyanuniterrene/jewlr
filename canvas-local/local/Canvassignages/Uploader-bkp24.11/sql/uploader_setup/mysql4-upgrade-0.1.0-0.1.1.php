<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
  DROP TABLE IF EXISTS {$this->getTable('uploader')};
CREATE TABLE {$this->getTable('uploader')} (
  `uploader_id` int(11) unsigned NOT NULL auto_increment,
  `cus_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `edited_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `data_field` varchar(100) DEFAULT NULL,
  `data_states` varchar(100) DEFAULT NULL,
  `extra_filed3` varchar(100) DEFAULT NULL,
  `sid` text(100) DEFAULT NONE,
  PRIMARY KEY (`uploader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
