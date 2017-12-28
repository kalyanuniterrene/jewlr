<?php
 
class Canvassignages_Uploader_Model_Resource_Enquiry extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('uploader/uploader', 'uploader_id');
    }
}
