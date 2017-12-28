<?php
class Folio3_Feedback_Adminhtml_FeedbackController extends 
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
			->createBlock('folio3_feedback_adminhtml/feedback');
	$this->loadLayout();
	$this->_setActiveMenu('folio3_feedback');
	$this->_addContent($feedbackBlock);
	$this->renderLayout();
    }
    public function gridAction()
    {
        $this->loadLayout();
	$this->_removeButton('add');
        $this->getResponse()->setBody(
            $this->getLayout()
                 ->createBlock('folio3_feedback/adminhtml_feedback_grid')
                 ->toHtml()
        );
    }
}
