<?php

class Company_Web_Adminhtml_WebController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('web/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('web/web')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('web_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('web/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('web/adminhtml_web_edit'))
				->_addLeft($this->getLayout()->createBlock('web/adminhtml_web_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('web')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			
			if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('filename');

					print_r($uploader);
					//exit();
					
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('csv'));
					$uploader->setAllowRenameFiles(false);
					
					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);
							
					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS ;
					$uploader->save($path, $_FILES['filename']['name'] );
					
				} catch (Exception $e) {
		      
		        }
	        
		        //this way the name is saved in DB
	  			$data['filename'] = $_FILES['filename']['name'];
			}
	  			
	  			
			$model = Mage::getModel('web/web');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('web')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('web')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('web/web');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $webIds = $this->getRequest()->getParam('web');
        if(!is_array($webIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                    $web = Mage::getModel('web/web')->load($webId);
                    $web->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($webIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $webIds = $this->getRequest()->getParam('web');
        if(!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                    $web = Mage::getSingleton('web/web')
                        ->load($webId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($webIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
    public function importAction()
    {
    	$webId = $this->getRequest()->getParam('id');
    	$web = Mage::getSingleton('web/web')->load($webId);
    	//print_r($web->getFilename());

    	 $path = Mage::getBaseDir('media') .'/'. $web->getFilename() ;
		$fp = fopen($path, 'r'); 
 
    	$j=0;

    	$params = array();

    	while(($website=fgetcsv($fp))) 
		{

			if($j == 0)
			{
				$j++;
				continue;
			}
			if($website[2] != '') {
			 $canvas_type_name = $website[2]." Custom Size";
			
			 $canvas_label = $website[0];
		
			 $canvas_title = $website[3];
			
			 $initial_price = $website[4];
			
			 $discount_price = $website[6];
			 
			 $id = $website[8];
			 

			 $sku = $website[7];

			    $params['name'][$j]['title'] =  $canvas_title;
				$params['name'][$j]['price'] =  $discount_price;
				$params['name'][$j]['class'] =  $canvas_label;
				$params['name'][$j]['class2'] =  $initial_price;
				$params['name'][$j]['sku'] =  $sku;
				
			
			}
					
			$j++;
					
			
		}
		echo "$canvas_type_name <br />";
		$arrayOptionOne[] = $this->getOptions($params,$canvas_type_name);
	
		
		$obj1 = Mage::getModel('catalog/product');

			
			$product1 = $obj1->load($id);
			$optionInstance = $product1->getOptionInstance()->unsetOptions();
			$product1->setHasOptions(1);

			foreach ($product1->getOptions() as $o) {
           				$p = $o->getValues();
           				//print_r($o->getStoreTitle());
           				if($o->getStoreTitle() == $canvas_type_name)
           				{
           					//echo "here";
           				}
        	}


			foreach($arrayOptionOne as $arrayOption){
			
				$optionInstance->addOption($arrayOption);
			
			}
			$optionInstance->setProduct($product1);
			$product1->save();
			
			unset($product1);
			
     

       

}

function getOptions($params,$canvas_type_name){
   $i = 0;
		$optionval = array();

		//print_r($params);
		foreach($params['name'] as $value){
			/*echo "<pre>";
			print_r($value);*/
			$optionval[] = array(
                'title' => $value['title'],
                'class1' => $value['class'],
                'class2' => $value['class2'],
                'price' =>$value['price'],
			    'price_type' => 'fixed',
			    'sku' => $value['sku'],
			    'sort_order' => '1'
			                
                
            );
		}

		return $option = array(
			'title' => $canvas_type_name,
			'type' => 'drop_down', // could be drop_down ,checkbox , multiple
			'is_require' => 0,
			'sort_order' => 0,
			'values' => $optionval
		);

		
}

public function customupdateAction()
    {

    	$webId = $this->getRequest()->getParam('id');
    	$web = Mage::getSingleton('web/web')->load($webId);
    	//print_r($web->getFilename());

    	 $path = Mage::getBaseDir('media') .'/'. $web->getFilename() ;
		$fp = fopen($path, 'r'); 
 
    	$j=0;

    	$params = array();

    	while(($website=fgetcsv($fp))) 
		{

			if($j == 0)
			{
				$j++;
				continue;
			}
			if($website[2] != '') {
			 $canvas_type_name = $website[2]." Custom Size";
			
			 $canvas_label = $website[0];
		
			 $canvas_title = $website[3];
			
			 $initial_price = $website[4];
			
			 $discount_price = $website[6];
			 
			 $id = $website[8];
			 

			 $sku = $website[7];

			    $params[$j]['title'] =  $canvas_title;
				$params[$j]['price'] =  $discount_price;
				$params[$j]['class'] =  $canvas_label;
				$params[$j]['class2'] =  $initial_price;
				$params[$j]['sku'] =  $sku;
				
			
			}
					
			$j++;
					
			
		}
		echo "$canvas_type_name <br />";
		//$arrayOptionOne[] = $this->getOptions($params,$canvas_type_name);
	
		
		$obj1 = Mage::getModel('catalog/product');

			
			$product1 = $obj1->load($id);
			$optionInstance = $product1->getOptionInstance()->unsetOptions();
			$product1->setHasOptions(1);

			foreach ($product1->getOptions() as $o) {
           				
           				//print_r($o->getStoreTitle());
           				if($o->getStoreTitle() == $canvas_type_name)
           				{
           					$values = $o->getValues();
           					foreach ($values as $k => $v) 
							{
								echo "<pre>";
								$ipt_title = $v->getData();

								//print_r($params);

								$custom_option_value = $params;

								foreach ($custom_option_value as $custom_key => $custom_value) {
									

									if($custom_value['sku'] == $v->getSku())
									{

										$option_title = $custom_value['title'];
										$option_price = $custom_value['price'];
										$option_label = $custom_value['class'];
										$option_int_price = $custom_value['class2'];

										if($v->getTitle() != $option_title || $v->getClass1() != $option_label || $v->getClass2() != $option_int_price || $v->getPrice() != $option_price)
										{
											$v->setStoreId('0');
											$v->setTitle($option_title);
											$v->setClass1($option_label);
											$v->setClass2($option_int_price);
											$v->setPrice($option_price);
											$v->setOption($o)->save();
										}


										//print_r($v->getData());
									}
								}

								//echo $v->getSku();
								
							}
           				}
        	}


			

    }




}
