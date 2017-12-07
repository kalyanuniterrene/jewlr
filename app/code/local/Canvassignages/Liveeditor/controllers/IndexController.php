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

   public function orderjewlerAction(){

     echo "Takla";

     $selectedTypeArray = $this->getRequest()->getParam('selectedTypeArray');

     $arrayObj = json_decode($selectedTypeArray);

      $product = Mage::getModel('catalog/product')->load(518);


      $order_arr = array();

      foreach ($arrayObj as $key => $value) {


                  $order_arr[$value->parent_id] = $value->option_id;

                   //$value->parent_id => $value->option_id,
            
                }

      $request = new Varien_Object();
      $request->setData($params);
  
      $cart = Mage::getModel('checkout/cart');
        $cart->init();
        $cart->addProduct($product, array('qty' => $qty,'options' => $order_arr
        
        ),$request);
       $cart->save();

     echo "Product added successfully";

     //print_r();

   }

   public function wishlistjewlerAction(){

     echo "Takla";

     $selectedTypeArray = $this->getRequest()->getParam('selectedTypeArray');

     $arrayObj = json_decode($selectedTypeArray);

      $product = Mage::getModel('catalog/product')->load(518);


      $order_arr = array();

      foreach ($arrayObj as $key => $value) {


                  $order_arr[$value->parent_id] = $value->option_id;
                  
                   //$value->parent_id => $value->option_id,
            
                }

                 //$supp =  ;

      /*$wishlist = Mage::helper('wishlist')->getWishlist();

      $storeId = Mage::app()->getStore()->getId();
      $model = Mage::getModel('catalog/product');
      $_product = $product; 
      $params = array('product' => $data['229'],
                      'qty' => 1,
                      'store_id' => $storeId,
                      'super_attribute' => array ( [132] => 4,[135] => 17, [136] => 20)
                      );
       $request = new Varien_Object();
       $request->setData($params);
      $result = $wishlist->addNewItem($_product, $request);*/
       $customer = Mage::getSingleton('customer/session')->getCustomer();
        $wishlist = Mage::getModel('wishlist/wishlist')->loadByCustomer($customer, true);

       $product = Mage::getModel('catalog/product')->load(518);

       $options = array(
        'product' => 518,
        'options' => $order_arr
);


       $buyRequest = new Varien_Object($options);

       $result = $wishlist->addNewItem($product, $buyRequest);

      $wishlist->save();

      Mage::dispatchEvent('wishlist_add_product', array(
         'wishlist'  => $wishlist,
         'product'   => $product,
         'item'      => $result
      ));

      Mage::helper('wishlist')->calculate();


     echo "Product added successfully";

     //print_r();

   }
    
    
}
