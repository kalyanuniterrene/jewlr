<?php
$installer = $this;
$installer->startSetup();
$sql="create table editor_saved_data(editor_saved_id int not null auto_increment,cus_id int not null,customer_name varchar(100),edited_time datetime,updated_time datetime,extra_filed1 varchar(100),extra_filed2 varchar(100),extra_filed3 varchar(100), primary key(editor_saved_id));";

$installer->run($sql);

$installer->endSetup();
	 
