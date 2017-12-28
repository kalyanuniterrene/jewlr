<?php
class Happy_Codding_IndexController extends Mage_Core_Controller_Front_Action{

  public function indexAction() {
    $this->loadLayout();
    $block = $this->getLayout()->createBlock(
        'Mage_Core_Block_Template', 'happy_codding.codding', array(
      'template' => 'happy_codding/codding.phtml'
        )
    );
    $this->getLayout()->getBlock('content')->append($block);
    $this->_initLayoutMessages('core/session');
    $this->renderLayout();
  }

  public function postAction() {
    if ($data = $this->getRequest()->getPost()) {
      //create CustomerFeedback model object
        $model = Mage::getModel('happy_codding/codding');
        $model->setData($data);
      try {
        if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
            $model->setCreatedTime(now())
                ->setUpdateTime(now());
        }
        else {
            $model->setUpdateTime(now());
        }
        $model
            ->setCustomerName($data['customer_name'])
            ->setCustomerEmail($data['customer_email'])
			->setCustomerPhone($data['customer_phone'])
			->setCustomerMnorder($data['customer_mnorder'])
            ->setCustomerFeedback($data['customer_feedback'])
            ->save();
            
            //mail code
            $msg ="Name:".$data['customer_name']."<br/>";
			$msg .="Email:".$data['customer_email']."<br/>";
			$msg .="Phone:".$data['customer_phone']."<br/>";
			$msg .="Average Monthly no of Order:".$data['customer_mnorder']."<br/>";
			$msg .="Comment:".$data['customer_feedback']."<br/>";

			$body =$msg;
			$mail = Mage::getModel('core/email');
			$mail->setToEmail(Mage::getStoreConfig('tab1/general/text_field1'));
			$mail->setBody($body);
			$mail->setSubject('Volume Sale');
			$mail->setFromEmail('canvassignages.com');
			$mail->setType('html');// You can use 'html' or 'text'

			$mail->send();
			
			//mail code end
            
            
        //To unset model object -- do not comment out this
        $model->unsetData();
        Mage::getSingleton('core/session')
        ->addSuccess(Mage::helper('happy_codding')
                ->__('Item was successfully saved'));
        Mage::getSingleton('core/session')->setFormData(false);
        if ($this->getRequest()->getParam('back')) {
          $this->_redirect('*/*/edit', array('id' => $model->getId()));
          return;
        }
	$this->_redirect('volume-sale', array('_query' => 'post=success'));
        return;
      }
      catch (Exception $e) {
        Mage::getSingleton('core/session')->addError($e->getMessage());
        Mage::getSingleton('core/session')->setFormData($data);
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()
                                                        ->getParam('id')));
        return;
      }
    }
    Mage::getSingleton('core/session')
            ->addError(Mage::helper('codding')
                    ->__('Unable to find item to save'));
    $this->_redirect('*/*/');
  }

}
