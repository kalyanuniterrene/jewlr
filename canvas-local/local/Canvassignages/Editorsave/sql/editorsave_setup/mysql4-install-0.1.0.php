<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
  DROP TABLE IF EXISTS {$this->getTable('enquiry')};
CREATE TABLE {$this->getTable('enquiry')} (
  `enquiry_id` int(11) unsigned NOT NULL auto_increment,
  `cus_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `edited_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `data_field` varchar(100) DEFAULT NULL,
  `data_states` varchar(100) DEFAULT NULL,
  `extra_filed3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`enquiry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
