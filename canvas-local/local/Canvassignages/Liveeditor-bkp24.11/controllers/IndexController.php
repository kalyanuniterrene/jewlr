<?php

class Canvassignages_Liveeditor_IndexController extends Mage_Core_Controller_Front_Action
{
   public function indexAction()
   {
     //echo 'test index' ;
     $this->loadLayout();
          $this->renderLayout();
   }
   public function canvasprintAction()
   {
     //echo 'test mamethode';
     
     $block = $this->getLayout()->createBlock('core/template');
     
     

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setData('key', 'some value')->setTemplate('canvassignages_liveeditor/liveeditor.phtml');
        
        
        // Render the template to the browser
        echo $block->toHtml();
     
    }
    
    public function walldisplayAction()
   {
    // echo 'test mamethode';
     
     $block = $this->getLayout()->createBlock('core/template');
     
     

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setData('key', 'some value')->setTemplate('canvassignages_liveeditor/wall-liveeditor.phtml');
        
        
        // Render the template to the browser
        echo $block->toHtml();
     
    }
    
    public function steelplateAction()
    {
		$block = $this->getLayout()->createBlock('core/template');
     
     

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setData('key', 'some value')->setTemplate('canvassignages_liveeditor/liveeditor-stell.phtml');
        
        
        // Render the template to the browser
        echo $block->toHtml();
		
	}
	
	
	public function acrylicAction()
    {
		$block = $this->getLayout()->createBlock('core/template');
     
     

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setData('key', 'some value')->setTemplate('canvassignages_liveeditor/liveeditor-acrylic.phtml');
        
        
        // Render the template to the browser
        echo $block->toHtml();
		
	}
    
    public function editAction()
    
    {
  //echo "here";
  
  
   $id = $this->getRequest()->getPost('data_id');
  
  $block = $this->getLayout()->createBlock('core/template');
  
  Mage::getSingleton('core/session')->setEditId($id);

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setData('key', $id)->setTemplate('canvassignages_liveeditor/liveeditor-save.phtml');

        // Render the template to the browser
        echo $block->toHtml();
 }
    

    public function editstellAction()
    
    {
  //echo "here";
  
  
   $id = $this->getRequest()->getPost('data_id');
  
  $block = $this->getLayout()->createBlock('core/template');
  
  Mage::getSingleton('core/session')->setEditId($id);

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setData('key', $id)->setTemplate('canvassignages_liveeditor/liveeditor-stell-save.phtml');

        // Render the template to the browser
        echo $block->toHtml();
 }
 
 public function editwallAction()
    
    {
  //echo "here";
  
  
   $id = $this->getRequest()->getPost('data_id');
  
  $block = $this->getLayout()->createBlock('core/template');
  
  Mage::getSingleton('core/session')->setEditId($id);

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setData('key', $id)->setTemplate('canvassignages_liveeditor/wall-liveeditor-save.phtml');

        // Render the template to the browser
        echo $block->toHtml();
 }
 
 
    
    public function saveAction()
    
    {
  //echo "here";
  
  
  echo $name = ''.$this->getRequest()->getPost('name');
  
  $block = $this->getLayout()->createBlock('core/template');

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setTemplate('canvassignages_liveeditor/liveeditor.phtml');

        // Render the template to the browser
        //echo $block->toHtml();
 }
    
    
    
    public function custompriceAction()
    {	
		
		
		 $dw = $this->getRequest()->getPost('dw');
		 $dh = $this->getRequest()->getPost('dh');
		 $option_type = $this->getRequest()->getPost('option_type');
		//die;
	
		$sku = 'custom-canvas-print'; 
		$opt_title_custom = $option_type;
		$product_data_cus = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title_custom);
		//$ratio = Mage::app()->getRequest()->getParam('ratio');
		foreach($product_data_cus as $canvas_data)
		{	
			 $canvas_type_option_title = $canvas_data['default_title'];	
			//$data_wh = explode('*',$ratio);
			$data_wh_new = explode('*',$canvas_type_option_title);
			
			//var_dump($data_wh_new[0]);
			
			//echo $canvas_type_option_title."<br/>";
			if( intval($dw) == intval($data_wh_new[0]) && intval($dh) == intval($data_wh_new[1]) )
			{
				
				echo $price = number_format((float) $canvas_data['price'], 2, '.', '');
				//~ $price['initial_price'] = number_format((float) $canvas_data['initial_price'], 2, '.', '');
				//~ echo json_encode($price);
			}
			else
			{
				if( intval($dw) == intval($data_wh_new[1]) && intval($dh) == intval($data_wh_new[0]) )
				{
					echo $price = number_format((float) $canvas_data['price'], 2, '.', '');
				}
			}
		}
    } 
    
      public function steeladminAction()
	 {
		 $block = $this->getLayout()->createBlock('core/template');

			// Assign your template to it
			// This path is relative to your current theme (eg: rwd/default/template/...)
			$block->setTemplate('canvassignages_liveeditor/liveeditor-stell-admin.phtml');

			// Render the template to the browser
			echo $block->toHtml();
		 
	 }
	
    
}
