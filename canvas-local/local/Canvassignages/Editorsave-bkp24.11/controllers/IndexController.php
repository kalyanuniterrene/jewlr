<?php
class Canvassignages_Editorsave_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		
		
		 //getting the customer id
		 if(Mage::getSingleton('customer/session')->isLoggedIn()) 
		 {
			  $customerData = Mage::getSingleton('customer/session')->getCustomer();
			  $customer_id = $customerData->getId();
			  $customer_name = $customerData->getName();
			  $sid="";
		 }
		 else
		 {
		 	$session = Mage::getSingleton('core/session');
			echo $sid = $session->getEncryptedSessionId(); //current session id
		 }
 
		  //getting the json data
		 echo $editorsaveddata = $this->getRequest()->getParam('savedJSONdata');
		  $name = $this->getRequest()->getParam('name');
		  $saved_status = $this->getRequest()->getParam('saved_status');
		 
		 $phparray = json_decode($editorsaveddata);
		
		//$collection = Mage::getModel('editorsave/enquiry')->getCollection();
		
		// getting the model
		$model = Mage::getModel('editorsave/enquiry');

 
 
	   //we create an entry in the database
	  $contact = Mage::getModel('editorsave/enquiry');
	  $contact->setData('cus_id',$customer_id);
	  $contact->setData('customer_name',$name);
	  $contact->setData('data_field',serialize($phparray));
	  $contact->setData('data_states',serialize($saved_status));
	  $contact->setData('extra_filed3','custom-canvas-print');	
	  $contact->setData('sid',$sid);
	  $contact->save();
		//echo "i am done half part";
			
		
    } // end action

		
		 public function stellAction()
    {
    	//getting the customer id
		 if(Mage::getSingleton('customer/session')->isLoggedIn()) 
		 {
			  $customerData = Mage::getSingleton('customer/session')->getCustomer();
			  $customer_id = $customerData->getId();
			  $customer_name = $customerData->getName();
			  $sid="";
		 }
		 else
		 {
		 	$session = Mage::getSingleton('core/session');
			echo $sid = $session->getEncryptedSessionId(); //current session id
		 }
 
		  //getting the json data
		 echo $editorsaveddata = $this->getRequest()->getParam('savedJSONdata');

		  $name = $this->getRequest()->getParam('name');
		  $saved_status = $this->getRequest()->getParam('saved_status');
		 
		 $phparray = json_decode($editorsaveddata);
		
		//$collection = Mage::getModel('editorsave/enquiry')->getCollection();
		
		// getting the model
		$model = Mage::getModel('editorsave/enquiry');

 
 
	   //we create an entry in the database
	  $contact = Mage::getModel('editorsave/enquiry');
	  $contact->setData('cus_id',$customer_id);
	  $contact->setData('customer_name',$name);
	  $contact->setData('data_field',serialize($phparray));
	  $contact->setData('data_states',serialize($saved_status));
	  $contact->setData('extra_filed3','steel-plates');
	  $contact->save();
    }
    
    public function wallAction()
    {
    	//getting the customer id
		 if(Mage::getSingleton('customer/session')->isLoggedIn()) 
		 {
			 
			 
			 
			  $customerData = Mage::getSingleton('customer/session')->getCustomer();
			  $customer_id = $customerData->getId();
			  $customer_name = $customerData->getName();
			  $sid=$customer_id;
		 }
		 else
		 {
		 	$session = Mage::getSingleton('core/session');
			echo $sid = $session->getEncryptedSessionId(); //current session id
		 }
		 //echo $sid;
		 
 
		  //getting the json data
		  $editorsaveddata = $this->getRequest()->getParam('savedJSONdata');
		  
		  //print_r($editorsaveddata);

		  $name = $this->getRequest()->getParam('name');
		  $saved_status = $this->getRequest()->getParam('saved_status');
		 
		 $phparray = ($editorsaveddata);
		 
		 print_r($phparray);
		
		//$collection = Mage::getModel('editorsave/enquiry')->getCollection();
		
		// getting the model
		$model = Mage::getModel('editorsave/enquiry');

 
 
	   //we create an entry in the database
	  $contact = Mage::getModel('editorsave/enquiry');
	  $contact->setData('cus_id',$sid);
	  $contact->setData('customer_name',$name);
	  $contact->setData('data_field',serialize($phparray));
	  $contact->setData('data_states',serialize($saved_status));
	  $contact->setData('extra_filed3','wall-display');
	  $contact->save();
    }

	
	
	 public function stelljsonAction()
    {
		$name = $this->getRequest()->getParam('saved_name');
		$finalJson = $this->getRequest()->getParam('finalJson');
		
		$filename = ('/home/canvassignages/public_html/canvas_uploader/steelfile/').$name.".txt";
		
		$myfile = fopen($filename, "w") or die("Unable to open file!");
		fwrite($myfile, $finalJson);

		fclose($myfile);
		
		echo $filename;
	}
	

}
