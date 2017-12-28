<?php
class Happy_Codding_Block_Adminhtml_Codding_Grid 
extends Mage_Adminhtml_Block_Widget_Grid {
  protected function _prepareCollection() {
    $collection = Mage::getResourceModel(
            'happy_codding/codding_collection'
    );
    $this->setCollection($collection);
    return parent::_prepareCollection();
  }
  protected function _prepareColumns() {
    $this->addColumn('id', array(
      'header' => $this->_getHelper()->__('ID'),
      'type' => 'number',
      'index' => 'id',
    ));
    $this->addColumn('customer_name', array(
      'header' => $this->_getHelper()->__('Name'),
      'type' => 'text',
      'index' => 'customer_name',
    ));
    $this->addColumn('customer_email', array(
      'header' => $this->_getHelper()->__('Email'),
      'type' => 'text',
      'index' => 'customer_email',
    ));
	$this->addColumn('customer_phone', array(
      'header' => $this->_getHelper()->__('Phone'),
      'type' => 'text',
      'index' => 'customer_phone',
    ));
	$this->addColumn('customer_mnorder', array(
      'header' => $this->_getHelper()->__('Monthly No Of Order'),
      'type' => 'text',
      'index' => 'customer_mnorder',
    ));
    $this->addColumn('customer_feedback', array(
      'header' => $this->_getHelper()->__('Comment'),
      'type' => 'text',
      'index' => 'customer_feedback',
    ));
    return parent::_prepareColumns();
  }
  protected function _getHelper() {
    return Mage::helper('happy_codding');
  }
}
