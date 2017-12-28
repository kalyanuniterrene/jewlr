<?php 

require_once ( "../app/Mage.php" );
Mage::app();

			$img_arr=$_POST['img_arr'];
 			 $session = Mage::getSingleton('core/session');
			// $SID=$session->getEncryptedSessionId(); //current session id		
			$SID = $_POST['sessionid']	 ;
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
				$img = Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID.'/'.$img_name.'.jpg';
				  file_put_contents($img, file_get_contents($url));	
			  }
			 echo $count." Images Uploaded successfully ." ;
?>