<?php

/**
 */
$installer = $this;

$installer->startSetup();


$installer->run("CREATE TABLE IF NOT EXISTS `" . $this->getTable("happy_codding") . "` (
  `id` int unsigned NOT NULL auto_increment,
  `customer_name` varchar(200) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_phone` varchar(200) NOT NULL,
  `customer_mnorder` varchar(200) NOT NULL,
  `customer_feedback` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB charset=utf8 COLLATE=utf8_unicode_ci COMMENT='this table is for customer feedback'");

$installer->endSetup();
