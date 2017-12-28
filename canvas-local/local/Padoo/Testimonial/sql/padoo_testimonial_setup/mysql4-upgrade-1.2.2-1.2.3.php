<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();

$installer->getConnection()->addColumn(
        $installer->getTable('padoo_testimonial'), 
        'video_embed_code',
        'varchar(1000) NOT NULL  AFTER testimonial_date'
);

$installer->endSetup();