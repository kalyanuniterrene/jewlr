<?php
/**
 * @category    Herve
 * @package     Herve_ProductEditButton
 * @copyright   Copyright (c) 2013 Hervé Guétin (http://www.herveguetin.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Herve_ProductEditButton_Adminhtml_ButtonController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Behavior of our new button when it is clicked
     */
    public function myButtonAction()
    {
        // Retrieve product id from which the button has been clicked
        $productId = $this->getRequest()->getParam('id');
       

        /**
         *
         * All custom controller logic goes here
         *
         */

        /*
        * Load Product By Id
        */

        $_product = Mage::getModel('catalog/product')->load($productId);

        echo "<pre>";

       foreach ($_product->getMediaGalleryImages() as $image) 
        { 
            //will load all gallery images in loop
            $media_image_path = $image->getPath();
            $media_image_label  = $image->getLabel();


           
            
            $mage_dir_url =  Mage::getBaseDir();

            $j=1;
           

           
             

            if (!file_exists($mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label)) {
                mkdir($mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label, 0777, true);

              //  copy($media_image_path , $mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label.'/'.$j.'.png');
                $j++;
            }

            //copy($media_image_path , $mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label.'/'.'shadow'.'.png');
            


            

        }

        foreach($_product->getOptions() as $o)

        {
            
            $options = $o->getData();
            $optionType = $o->getType();
            $option_title = $options['default_title'];

            $sort_order = $o->getSortOrder();

            if($sort_order == 1)
            {
                //echo "Mr. Huda is here. And he will shake his tummy";


                $values = $o->getValues();
                //$j=0;

                $img_array = array();

                $j=1;

                foreach ($values as $k => $v) 
                {
                    $ipt_title = $v->getData();

                    $sort_order = $ipt_title['sort_order'];


                    //$img_array = $ipt_title['sort_order'];
                    $img_array['view_1'][$j]['image1'] = $ipt_title['image1'];
                    $img_array['view_2'][$j]['image2'] = $ipt_title['image2'];
                    $img_array['view_3'][$j]['image3'] = $ipt_title['image3'];
                    $img_array['view_4'][$j]['image4'] = $ipt_title['image4'];
                    $img_array['view_5'][$j]['image5'] = $ipt_title['image5'];
                    /*$img_array[$j]['view_2'] = $ipt_title['image2'];
                    $img_array[$j]['view_3'] = $ipt_title['image3'];
                    $img_array[$j]['view_4'] = $ipt_title['image4'];
                    $img_array[$j]['view_5'] = $ipt_title['image5'];*/
                    

                    
                    $j++;

                } //end of foreach

                //print_r($img_array);
            }


        } //end of foreach


        $view1_counter = 1;
        foreach ($img_array['view_1'] as $key => $value) {
            
            $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image1'];
            copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$view1_counter.'.png');
            $view1_counter++;
        }

        $view2_counter = 1;
        foreach ($img_array['view_2'] as $key => $value) {
            
            $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image2'];
            copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$view2_counter.'.png');
            $view2_counter++;
        }

        $view3_counter = 1;
        foreach ($img_array['view_3'] as $key => $value) {
            
            $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image3'];
            copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$view3_counter.'.png');
            $view3_counter++;
        }

        $view4_counter = 1;
        foreach ($img_array['view_4'] as $key => $value) {
            
            $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image4'];
            copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$view4_counter.'.png');
            $view4_counter++;
        }

        $view5_counter = 1;
        foreach ($img_array['view_5'] as $key => $value) {
            
            $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image5'];
            copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$view5_counter.'.png');
            $view5_counter++;
        }

         exit();



        $this->_getSession()->addSuccess($this->__('Congratulations, you clicked on a button!'));

        // Redirect to product edit page
        $this->_redirect('*/catalog_product/edit', array(
            'id'    => $productId,
            '_current'=>true
        ));
    }
}