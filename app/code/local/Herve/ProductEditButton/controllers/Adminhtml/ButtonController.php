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


            //print_r($media_image_path);
            
            $mage_dir_url =  Mage::getBaseDir();

            $j=1;

            if (!file_exists($mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label)) {
                mkdir($mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label, 0777, true);

                copy($media_image_path , $mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label.'/'.$j.'.png');
                $j++;
            }

            copy($media_image_path , $mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label.'/'.'shadow'.'.png');
            
            //copy($media_image_path , $mage_dir_url.'/jewelzhq'.'/metal'.'/'.$productId.'/'.$media_image_label.'/1_1.png');


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