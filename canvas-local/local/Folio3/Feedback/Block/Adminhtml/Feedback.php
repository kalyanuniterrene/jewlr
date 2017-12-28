<?php

class Folio3_Feedback_Block_Adminhtml_Feedback extends 
Mage_Adminhtml_Block_Widget_Grid_Container {
	
  public function __construct() {
    
	/**
     * The $_blockGroup property tells Magento which alias to use to
     * locate the blocks to be displayed in this grid container.
     * In our example, this corresponds to Folio3_Feedback/Block/Adminhtml.
     */
    $this->_blockGroup = 'folio3_feedback_adminhtml';

    /**
		* $_controller is a slightly confusing name for this property.
     * This value, in fact, refers to the folder containing our
     * Grid.php and Edit.php - in our example,
     * Folio3_Feedback/Block/Adminhtml/Feedback. So, we'll use 'feedback'.
     */
    $this->_controller = 'feedback';

    /**
     * The title of the page in the admin panel.
     */
    $this->_headerText = Mage::helper('folio3_feedback')
        ->__('Feedback');
	//$this->_addButtonLabel = Mage::helper('folio3_feedback')->__('Add Report');	
	//parent::__construct();
	/*parent::_construct();
	$this->_removeButton('add');*/
	parent::__construct();
	
$this->_removeButton('add');
	
	
	/*$this->_addButton('add', array(
                 'label'     => $this->getAddButtonLabel() ,
                'class'     => 'add1',
             ));*/
  }
  
}
