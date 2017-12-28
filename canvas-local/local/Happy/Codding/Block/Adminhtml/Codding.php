<?php

class Happy_Codding_Block_Adminhtml_Codding extends 
Mage_Adminhtml_Block_Widget_Grid_Container {

  protected function _construct() {
    
	/**
     * The $_blockGroup property tells Magento which alias to use to
     * locate the blocks to be displayed in this grid container.
     * In our example, this corresponds to Folio3_Feedback/Block/Adminhtml.
     */
    $this->_blockGroup = 'happy_codding_adminhtml';

    /**
     * $_controller is a slightly confusing name for this property.
     * This value, in fact, refers to the folder containing our
     * Grid.php and Edit.php - in our example,
     * Folio3_Feedback/Block/Adminhtml/Feedback. So, we'll use 'feedback'.
     */
    $this->_controller = 'codding';

    /**
     * The title of the page in the admin panel.
     */
    $this->_headerText = Mage::helper('happy_codding')
        ->__('Codding');
	parent::_construct();
  }
}
