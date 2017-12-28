<?php
	
	class Folio3_Feedback_IndexController extends Mage_Core_Controller_Front_Action{
		
		public function indexAction() {
			$this->loadLayout();
			$block = $this->getLayout()->createBlock(
			'Mage_Core_Block_Template', 'folio3_feedback.feedback', array(
			'template' => 'folio3_feedback/feedback.phtml'
			)
			);
			$this->getLayout()->getBlock('content')->append($block);
			$this->_initLayoutMessages('core/session');
			$this->renderLayout();
		}
		
		public function postAction() {
			if ($data = $this->getRequest()->getPost()) {
				
				/*print_r($data);
				die();*/
				//create CustomerFeedback model object
				$model = Mage::getModel('folio3_feedback/feedback');
				$model->setData($data);
				try {
					if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
						$model->setCreatedTime(now())
						->setUpdateTime(now());
					}
					else {
						$model->setUpdateTime(now());
					}
					/*image upload code*/
					//$postData = $this->getRequest()->getPost();
					$img_name = $_FILES['customer_image']['name'];
					if($img_name!=''){
						
					
						$uploader = new Varien_File_Uploader('customer_image');
						$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','.svg','.pdf','.psd','.ai')); 
						$uploader->setAllowRenameFiles(true);
						$uploader->setFilesDispersion(false);
						$path = Mage::getBaseDir('media').DS.'vectorization'.DS; 
						$path_url = Mage::getBaseUrl('media').'vectorization/';
						 $img = $path. $_FILES['customer_image']['name'];
						$filename = $uploader->getNewFileName($img);
						$uploader->save($path, $filename); 
						
						//die;
					}
					else{
						$path_url='';
						$filename='';
					}
					
					$model
					->setCustomerName($data['customer_name'])
					->setCustomerEmail($data['customer_email'])
					->setCustomerPhone($data['customer_phone'])
					->setCustomerArtwork($data['customer_artwork'])
					->setCustomerPlan($data['customer_plan'])
					->setCustomerImage($path_url.$filename)
					->setCustomerFeedback($data['customer_feedback'])
					->save();
					
					//email code
					
					$msg ="Name:".$data['customer_name']."<br/>";
					 $msg .="Email:".$data['customer_email']."<br/>";
					 $msg .="Phone:".$data['customer_artwork']."<br/>";
					 $msg .="Plan:".$data['customer_plan']."<br/>";
					 $msg .="Image:".$path_url.$filename."<br/>";
					 $msg .="Comment:".$data['customer_feedback']."<br/>";
					 
					 /* $suc = mail("someone@example.com","My subject",$msg);
					  if($suc == 1){
					  echo "sucess ful";
					  }
					  else{
					  echo "something wrong";
					 }*/
					 
					 $body =$msg;
					 $mail = Mage::getModel('core/email');
					 $mail->setToName('test');
					 $mail->setToEmail(Mage::getStoreConfig('tab1/general/text_field'));
					 $mail->setBody($body);
					 $mail->setSubject('Vectorization');
					 $mail->setFromEmail('canvassignages.com');
					 $mail->setType('html');// You can use 'html' or 'text'
					 
					 $mail->send();
					
					
					//email code end
					//To unset model object -- do not comment out this
					$model->unsetData();
					Mage::getSingleton('core/session')
					->addSuccess(Mage::helper('folio3_feedback')
					->__('Item was successfully saved'));
					Mage::getSingleton('core/session')->setFormData(false);
					if ($this->getRequest()->getParam('back')) {
						$this->_redirect('*/*/edit', array('id' => $model->getId()));
						return;
					}
					$this->_redirect('vectorization', array('_query' => 'post=success'));
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
				->addError(Mage::helper('feedback')
				->__('Unable to find item to save'));
				$this->_redirect('*/*/');
			}
			
		}
		
