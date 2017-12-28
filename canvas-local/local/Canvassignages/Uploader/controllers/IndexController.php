<?php
class Canvassignages_Uploader_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		$block = $this->getLayout()->createBlock('core/template');
     
     

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setTemplate('canvassignages_uploader/uploader.phtml');
        
        
        // Render the template to the browser
        echo $block->toHtml();
		
		
			
		
    } // end action
    
    
    //upload action
    
    public function uploadaddAction()
    {
			 $url = Mage::getBaseDir().'/canvas_uploader/src/class.fileuploader.php';
			 include($url);
			 $session = Mage::getSingleton('core/session');
			 $SID=$session->getEncryptedSessionId(); //current session id
			 
			 $customer_id="";
			 
			  // check customer logged in or not
			  if(Mage::getSingleton('customer/session')->isLoggedIn()) 
			  {
				 $customerData = Mage::getSingleton('customer/session')->getCustomer();
				 $customer_id = $customerData->getId();
				 // create folder with customer id if not exist
				 
				// $date = '/'.date("F j, Y");
				 
				    if (!file_exists(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id)) 
					{
						mkdir(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id, 0777, true);
						//$upload_id = $customer_id;
					}
					
					if(!file_exists(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id))
				    {
						mkdir(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id, 0777, true);
					}
				  
			  }
			  else
			  {
					// create folder with session id
					if (!file_exists(Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID)) 
					{
						mkdir(Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID, 0777, true);
						//$upload_id = $SID;
					}
			  }	
			  
			  if($customer_id !="")
			  {
				  $SID=$customer_id;
			  }
		
				// get custom name field
				$customName = isset($_POST['custom_name']) && !empty($_POST['custom_name']) ? $_POST['custom_name'] : null;
				
				// initialize FileUploader
				$FileUploader = new FileUploader('files', array(
					'limit' => null,
					'maxSize' => null,
					'fileMaxSize' => null,
					'extensions' => array('gif','png' ,'jpg' ,'svg'),
					'required' => false,
					'uploadDir' => Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID.'/',
					'title' => $customName ? $customName : 'name',
					'replace' => false,
					'listInput' => true,
					'files' => null
				));
				
				// call to upload the files
				$data = $FileUploader->upload();

				// export to js
					echo json_encode($data);
			//echo "i added here";
			//echo "i added here";
	}
	
	
	// show images in profile
	
	public function showimagesAction()
	{
			//echo "hello now need to show images";
			
			$block = $this->getLayout()->createBlock('core/template');
			
			$block->setTemplate('canvassignages_uploader/show_image.phtml');       
        
			// Render the template to the browser
			echo $block->toHtml();		  
			  
	}
	
	// remove image and unlink it from folder
	public function removeimagesAction()
	{
		 $remove_url = $this->getRequest()->getParam('remove_url');
			$remove_url_root = $this->getRequest()->getParam('remove_url_root');
		
		$file = $remove_url;
		$file_root = $remove_url_root;
	
		if(file_exists($file))
		{
			unlink($file);
			//echo "need to delete this block";
		}
		
		if(file_exists($file_root))
		{
			unlink($file_root);
			//echo "need to delete this block";
		}
	}
	
	public function allimagesAction()
	{
		  $original_url = $this->getRequest()->getParam('original_url');
		  $resized_url = $this->getRequest()->getParam('resized_url');
		  $skin_url =  Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		
		  $image_html ="";
		  $image_html.='<div class="uploaded-photo-box" data-full="'.$original_url.'">';
           $image_html.='<div class="remove_image_alt"><img src="'.$skin_url.'/frontend/rwd/default/images/canvas_live_editor/images/remove-white.png" class="remove" ></div>';
           $image_html.='<img src="'.$skin_url.'/frontend/rwd/default/images/canvas_live_editor/images/select-check.png" class="select-check">';
          $image_html.='<img src="'. $original_url .'" data-full="'.$original_url.'"  class="enable_dragging ui-draggable ui-draggable-handle">';
          $image_html.='</div>';
          
          echo $image_html;
	}
	//11-12-17
	public function flickerimagesAction()
	{		
		
		  $search = $this->getRequest()->getParam('srch_result');
		  $result = $this->getRequest()->getParam('srch_count');
		  $size = $this->getRequest()->getParam('img_size');
		  $url = Mage::getBaseDir().'/social/flicker_image.php';
			 include($url);		  
				if($size > 500)
				{
					$size = 500;
				}
				$flickr= new flickr('bef4f663c1d31f72ee4b0e06497b1451');
				$gbr = $flickr->flickr_photos_search($search,$result,$size);
				if($gbr){
					echo "<ul class='flicker_imagedata'>";
				foreach($gbr as $hasil)
					{
						echo '<li style="display:inline-block;">'. $hasil.'</li>';
					}
					echo "</ul>";
					echo "<button type='button' class='flickimage_upload'>Upload Image</button>";
				}	
				else{
					echo "No Such Image Found .";
				}	  
          
          //echo $image_html;
	}

   public function flickerupload_imagesAction()
    {
			 //$url = Mage::getBaseDir().'/canvas_uploader/src/class.fileuploader.php';
			// include($url);
			$img_arr= $this->getRequest()->getParam('img_arr');
			//print_r($img_arr);
			 $session = Mage::getSingleton('core/session');
			 $SID=$session->getEncryptedSessionId(); //current session id			 
			 $customer_id="";			 
			  // check customer logged in or not
			  if(Mage::getSingleton('customer/session')->isLoggedIn()) 
			  {
				 $customerData = Mage::getSingleton('customer/session')->getCustomer();
				 $customer_id = $customerData->getId();
				 // create folder with customer id if not exist				 
				// $date = '/'.date("F j, Y");				 
				    if (!file_exists(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id)) 
					{
						mkdir(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id, 0777, true);
						//$upload_id = $customer_id;
					}				
					if(!file_exists(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id))
				    {
						mkdir(Mage::getBaseDir().'/canvas_uploader/uploads/'.$customer_id, 0777, true);
					}				  
			  }
			  else
			  {
					// create folder with session id
					if (!file_exists(Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID)) 
					{
						mkdir(Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID, 0777, true);
						//$upload_id = $SID;
					}
			  }	
			  
			  if($customer_id !="")
			  {
				  $SID=$customer_id;
			  }	
			  //echo Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID.'/'.$count.'.jpg';
			  $count=0;
			  foreach ($img_arr as $img_src) {
			  	$count++;
			  	 $url = $img_src;
			  	 $imagepath=pathinfo($url);
			  	$img_name=$imagepath['filename'];
			  	//echo $img_name.'</br>';	
				  $img = Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID.'/'.$img_name.'.jpg';
				  file_put_contents($img, file_get_contents($url));	
			  }
			 echo $count." image uploaded Successfully" ;

			 // copy(source, dest)
				// get custom name field
				//$customName = isset($_POST['custom_name']) && !empty($_POST['custom_name']) ? $_POST['custom_name'] : null;
				
				// initialize FileUploader
				// $FileUploader = new FileUploader('files', array(
				// 	'limit' => null,
				// 	'maxSize' => null,
				// 	'fileMaxSize' => null,
				// 	'extensions' => array('gif','png' ,'jpg' ,'svg'),
				// 	'required' => false,
				// 	'uploadDir' => Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID.'/',
				// 	'title' => $customName ? $customName : 'name',
				// 	'replace' => false,
				// 	'listInput' => true,
				// 	'files' => null
				// ));
				
				// call to upload the files
			//	$data = $FileUploader->upload();

				// export to js
					//echo json_encode($data);
			//echo "i added here";
			//echo "i added here";
	}



	//11-12-17
	
	public function newsletterAction()
	{
		
			 $email = $this->getRequest()->getParam('email');
			 
			 //check if the email already exist
			 
			 $subscriber_old = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
			if($subscriber_old->getId() !="")
			{
				echo "Email Already Exist";
			}
			else
			{
				// THE "EASY" WAY (but sends a confirmation email to the customer
				$subscriber = Mage::getModel('newsletter/subscriber')->subscribe($email);
				
				
				// THE "HARD" WAY (Doesn't send confirmation email to customer)
				// load up the customer we want to subscribe
				$customer = Mage::getModel('customer/customer')
				->setWebsiteId(1)
				->loadByEmail($email);
				
				echo "Thank you For Your Subscription";
				// if we found the customer
				if ($customer->getId()){
				// load up the subscriber if possible
					$subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
					if (!$subscriber->getId() 
					|| $subscriber->getStatus() == Mage_Newsletter_Model_Subscriber::STATUS_UNSUBSCRIBED 
					|| $subscriber->getStatus() == Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE) {
					$subscriber->setStatus(Mage_Newsletter_Model_Subscriber::STATUS_SUBSCRIBED);
					$subscriber->setSubscriberEmail($email);
					$subscriber->setSubscriberConfirmCode($subscriber->RandomSequence());
					}
					$subscriber->setStoreId(Mage::app()->getStore()->getId());
					$subscriber->setCustomerId($customer->getId());
						try {
							
							$subscriber->save();
							
						}
						catch (Exception $e) {
							echo "Find Some Issue";
						//throw new Exception($e->getMessage());
							echo $e->getMessage();
						}
				}
				
			}
			
			
				
			
			 
			
		
	}

}
