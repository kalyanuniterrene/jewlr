<?php

class Canvassignages_Liveeditor_IndexController extends Mage_Core_Controller_Front_Action
{
   public function indexAction()
   {
     //echo 'test index' ;
     $this->loadLayout();
          $this->renderLayout();
   }

   public function imageAction()
   {
    
      $sku = $this->getRequest()->getParam('sku');
      $default_sku = $this->getRequest()->getParam('default_sku');

     $dir = "/home/web/public_sc/jewlr/media/fancy-halo-flip-ring/metal-10k-yellow-gold/";
   



   $path = realpath(Mage::getBaseDir().'/media/fancy-images/'.$default_sku.'/'.$sku.'/');

      if($path !="") // check if the path is blank or not
      {



          // getting the url of the folder not real path
        $path_url = Mage::getBaseUrl().'/canvas_uploader/uploads/'.$SID.'/';

        $di = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::LEAVES_ONLY
        );
        
        
        $image_name = array();

        $html ="";
        $i =0;

        //echo Mage::getBaseUrl().'/media/fancy-images/'.$default_sku.'/'.$sku.'/';
        
        foreach($di as $name => $fio) 
        {
          $filename = Mage::getBaseUrl().'/media/fancy-images/'.$default_sku.'/'.$sku.'/' .( $fio->getFilename() );
          $filename_resized = Mage::getBaseUrl().'/media/fancy-images/'.$default_sku.'/'.$sku.'/resized/' .( $fio->getFilename() );
          

         $html.= '<div class="owl-item" style="width: 585px;"><div class="item">
                            <img src="'.$filename.'" alt="" class="image" />
                         </div> </div>';
          
         $image_name[$i]['img_full'] = $filename;
         $image_name[$i]['img_small'] = $filename_resized;
          
          
          
          $i++;  
          
        }
         print_r( json_encode($image_name));
        
      }

     
   }

   public function createimageAction()
   {
      // Now coming to the most interesting part of the project. where we can go with the dynamic image creation.

        $metal = $this->getRequest()->getParam('metal');
        $style = $this->getRequest()->getParam('style');
        $stone = $this->getRequest()->getParam('stone');
        $color = $this->getRequest()->getParam('color');
        $default_sku = $this->getRequest()->getParam('default_sku');

         for ($i=1; $i <=5 ; $i++) { 

            
          
           
         }

         $block = $this->getLayout()->createBlock('core/template');

         //print_r($block);

           $block->setTemplate('canvassignages_liveeditor/image-create.phml');

            // Render the template to the browser
        echo $block->toHtml();
      //echo "die";  
     
   }
   
   public function filterAction()
   {
    
      $metal = $this->getRequest()->getParam('metal');
    // echo $path = realpath(Mage::getBaseDir().'/media/fancy-images/'.$default_sku.'/'.$sku.'/');
	echo $metal;
     
   }
    
    
}
