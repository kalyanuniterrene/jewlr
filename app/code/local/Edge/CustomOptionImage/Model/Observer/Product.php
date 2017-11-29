<?php

class Edge_CustomOptionImage_Model_Observer_Product
{
    public function saveCustomOptionImages(Varien_Event_Observer $observer)
    {
        if (!isset($_FILES) || empty($_FILES) || !isset($_FILES['product'])){
            return;
        }

        $product = $observer->getEvent()->getProduct();

        $productData = $observer->getEvent()->getRequest()->getPost('product');

        //echo '<pre>';

        //print_r($_FILES);



        if (isset($productData['options']) && !$product->getOptionsReadonly()) {
            if (isset($_FILES['product']['name']['options'])) {
                $images = array();
                foreach ($_FILES['product'] as $attr => $options) {
                    if (isset($options['options'])) {
                        foreach ($options['options'] as $optionId => $values) {
                            if (isset($values['values'])) {
                                      foreach ($values['values'] as $valueId => $data) {
                                    $key = 'option_' . $optionId . '_value_' . $valueId;
                                    if (!isset($images[$key])) {
                                        $images[$key] = array();
                                    }
                                    
                                   // print_r($images);
                                    $images[$key][$attr] = $data['image'];
                                    
                                }
                            }
                        }
                    }
                }

                //print_r($images);
                //die;

                foreach ($images as $imageName => $imageData) {
                    //print_r($imageData);
                    $_FILES[$imageName] = $imageData;
                }
            }
           // print_r($_FILES[$imageName]) ;

            foreach ($productData['options'] as $optionId => $option) {

                //print_r($option['values']) ;
                if (!empty($option['values'])) {
                    foreach ($option['values'] as $valueId => $value) {



                        $imageName = 'option_' . $optionId . '_value_' . $valueId;

                        if (!isset($_FILES[$imageName]) || empty($_FILES[$imageName]) || $_FILES[$imageName]['name'] === "") {
                            continue;
                        }

                        //echo "takla munda";
                        //exit;

                        try {
                            $uploader = new Mage_Core_Model_File_Uploader($imageName);
                            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','svg'));
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(false);

                            $dirPath = Mage::getBaseDir('media') . DS . 'custom_option_image' . DS;
                            $result = $uploader->save($dirPath, $_FILES[$imageName]['name']);

                        } catch (Exception $e) {
                    
                            Mage::log($e->getMessage());
                        }

                        //print_r($result);

                        $productData['options'][$optionId]['values'][$valueId]['image'] = 'custom_option_image/' . $result['file'];
                        $product->setCanSaveCustomOptions(true);
                    }
                }
            }

            if (isset($_FILES['product']['name']['options'])) {
                $images1 = array();
                foreach ($_FILES['product'] as $attr => $options) {
                    if (isset($options['options'])) {
                        foreach ($options['options'] as $optionId => $values) {
                            if (isset($values['values'])) {

                                //print_r($values['values']) ;

                                foreach ($values['values'] as $valueId => $data) {
                                    $key = 'option_' . $optionId . '_value_' . $valueId;
                                    if (!isset($images1[$key])) {
                                        $images1[$key] = array();
                                    }
                                    
                                    //print_r($images1);
                                    $images1[$key][$attr] = $data['image1'];
                                    
                                }
                            }
                        }
                    }
                }

                
                

                foreach ($images1 as $imageName1 => $imageData1) {
                   // print_r($imageData1);
                    $_FILES[$imageName1] = $imageData1;
                }
            }


           // print_r($_FILES[$imageName1]) ;
            


            
            $product->setProductOptions($productData['options']);

            foreach ($productData['options'] as $optionId => $option) {
                if (!empty($option['values'])) {
                    foreach ($option['values'] as $valueId => $value) {

                        $imageName1 = 'option_' . $optionId . '_value_' . $valueId;

                        if (!isset($_FILES[$imageName1]) || empty($_FILES[$imageName1]) || $_FILES[$imageName1]['name'] === "") {
                            continue;
                        }

                        

                        try {
                            $uploader = new Mage_Core_Model_File_Uploader($imageName1);
                            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','svg'));
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(false);

                            $dirPath = Mage::getBaseDir('media') . DS . 'custom_option_image' . DS;
                            $result = $uploader->save($dirPath, $_FILES[$imageName1]['name']);

                        } catch (Exception $e) {
                    
                            Mage::log($e->getMessage());
                        }

                       $productData['options'][$optionId]['values'][$valueId]['image1'] = 'custom_option_image/' . $result['file'];
                        $product->setCanSaveCustomOptions(true);

                       
                       // exit;
                    }
                }
            }

            $product->setProductOptions($productData['options']);

            //exit;
        }
    }
}