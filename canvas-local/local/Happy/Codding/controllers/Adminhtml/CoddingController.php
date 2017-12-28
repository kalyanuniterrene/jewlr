<?php
class Happy_Codding_Adminhtml_CoddingController extends 
Mage_Adminhtml_Controller_Action {
  /**
   * Instantiate our grid container block and add to the page content.
   * When accessing this admin index page, we will see a grid of all
   * customerforuminfos currently available in our Magento instance, along with
   * a button to add a new one if we wish.
   */
    public function indexAction() {
    // instantiate the grid container
	$feedbackBlock = $this->getLayout()
			->createBlock('happy_codding_adminhtml/codding');
	$this->loadLayout();
	$this->_setActiveMenu('happy_codding');
	$this->_addContent($feedbackBlock);
	$this->renderLayout();
    }
    public function gridAction()
    {
        $this->loadLayout();
	$this->_removeButton('add');
        $this->getResponse()->setBody(
            $this->getLayout()
                 ->createBlock('happy_codding/adminhtml_codding_grid')
                 ->toHtml()
        );
    }
}
