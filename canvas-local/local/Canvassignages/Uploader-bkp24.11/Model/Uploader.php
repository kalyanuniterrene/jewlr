<?php
 
class Canvassignages_Uploader_Model_Enquiry extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('uploader/uploader');
    }
}
