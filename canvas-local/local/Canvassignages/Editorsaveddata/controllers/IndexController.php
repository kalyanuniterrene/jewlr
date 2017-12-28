<?php
class Canvassignages_Editorsaveddata_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
		
		echo $editorsaveddata = $this->getRequest()->getParam('savedJSONdata');
      
	  //~ $this->loadLayout();   
	  //~ $this->getLayout()->getBlock("head")->setTitle($this->__("Editorsaveddata"));
	        //~ $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      //~ $breadcrumbs->addCrumb("home", array(
                //~ "label" => $this->__("Home Page"),
                //~ "title" => $this->__("Home Page"),
                //~ "link"  => Mage::getBaseUrl()
		   //~ ));

      //~ $breadcrumbs->addCrumb("editorsaveddata", array(
                //~ "label" => $this->__("Editorsaveddata"),
                //~ "title" => $this->__("Editorsaveddata")
		   //~ ));

      //~ $this->renderLayout(); 
	  
    }
}
