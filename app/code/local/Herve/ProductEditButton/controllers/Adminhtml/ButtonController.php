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
        $_product = Mage::getModel('catalog/product')->load($productId);
        $opt_title = "Metal";
        print_r($_product->getSku());
        $product_data_custom = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($_product->getSku(),$opt_title);
     //  echo "<pre>"; print_r($product_data_custom); echo "</pre>";

       foreach ($product_data_custom as $key=> $custom_value) {

        $data = substr($_POST['imageData'], strpos($_POST['imageData'], ",") + 1);
        $decodedData = base64_decode($data);
        $fp = fopen("img_06264.png", 'wb');
        fwrite($fp, $decodedData);
        fclose($fp);
        //echo $custom_value['option_label'];

       // $img=$uploader->getUploadedFileName($custom_value['img_url']);
       // print_r($img);      

        //$io = new Varien_Io_File();

       // echo "<pre>"; print_r($io) ;
       //$io->mkdir(Mage::getBaseUrl('media').'/import/images', 0775);
        // $imageName = $custom_value["img_url"];

        // get the image from the import dir
       // $import = Mage::getBaseDir('media') . DS . 'import/' . $imageName;
        //$io->checkAndCreateFolder(Mage::getBaseUrl('media').'xyzzzzzz');
            // if ( !file_exists(Mage::getBaseUrl('media').'custom_option_image/'.$custom_value['option_label']) && !empty($custom_value['option_label'])) {
            //  mkdir(Mage::getBaseUrl('media').'xyzzzzzz', 0777, true);
            //  echo $custom_value['option_label'];
            // }
       }
      

        die;

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