<?php
 
class Canvassignages_Editorsave_Model_Resource_Enquiry extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('editorsave/enquiry', 'enquiry_id');
    }
}
