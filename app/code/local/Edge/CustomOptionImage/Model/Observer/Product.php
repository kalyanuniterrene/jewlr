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

             if (isset($_FILES['product']['name']['options'])) {
                $images2 = array();
                foreach ($_FILES['product'] as $attr => $options) {
                    if (isset($options['options'])) {
                        foreach ($options['options'] as $optionId => $values) {
                            if (isset($values['values'])) {

                                //print_r($values['values']) ;

                                foreach ($values['values'] as $valueId => $data) {
                                    $key = 'option_' . $optionId . '_value_' . $valueId;
                                    if (!isset($images2[$key])) {
                                        $images2[$key] = array();
                                    }
                                    
                                    //print_r($images2);
                                    $images2[$key][$attr] = $data['image2'];
                                    
                                }
                            }
                        }
                    }
                }

                
                

                foreach ($images2 as $imageName2 => $imageData2) {
                   // print_r($imageData2);
                    $_FILES[$imageName2] = $imageData2;
                }
            }


           // print_r($_FILES[$imageName2]) ;
            


            
            $product->setProductOptions($productData['options']);

            foreach ($productData['options'] as $optionId => $option) {
                if (!empty($option['values'])) {
                    foreach ($option['values'] as $valueId => $value) {

                        $imageName2 = 'option_' . $optionId . '_value_' . $valueId;

                        if (!isset($_FILES[$imageName2]) || empty($_FILES[$imageName2]) || $_FILES[$imageName2]['name'] === "") {
                            continue;
                        }

                        

                        try {
                            $uploader = new Mage_Core_Model_File_Uploader($imageName2);
                            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','svg'));
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(false);

                            $dirPath = Mage::getBaseDir('media') . DS . 'custom_option_image' . DS;
                            $result = $uploader->save($dirPath, $_FILES[$imageName2]['name']);

                        } catch (Exception $e) {
                    
                            Mage::log($e->getMessage());
                        }

                       $productData['options'][$optionId]['values'][$valueId]['image2'] = 'custom_option_image/' . $result['file'];
                        $product->setCanSaveCustomOptions(true);

                       
                       // exit;
                    }
                }
            }

            $product->setProductOptions($productData['options']);

             if (isset($_FILES['product']['name']['options'])) {
                $images3 = array();
                foreach ($_FILES['product'] as $attr => $options) {
                    if (isset($options['options'])) {
                        foreach ($options['options'] as $optionId => $values) {
                            if (isset($values['values'])) {

                                //print_r($values['values']) ;

                                foreach ($values['values'] as $valueId => $data) {
                                    $key = 'option_' . $optionId . '_value_' . $valueId;
                                    if (!isset($images3[$key])) {
                                        $images3[$key] = array();
                                    }
                                    
                                    //print_r($images3);
                                    $images3[$key][$attr] = $data['image3'];
                                    
                                }
                            }
                        }
                    }
                }

                
                

                foreach ($images3 as $imageName3 => $imageData3) {
                   // print_r($imageData3);
                    $_FILES[$imageName3] = $imageData3;
                }
            }


           // print_r($_FILES[$imageName3]) ;
            


            
            $product->setProductOptions($productData['options']);

            foreach ($productData['options'] as $optionId => $option) {
                if (!empty($option['values'])) {
                    foreach ($option['values'] as $valueId => $value) {

                        $imageName3 = 'option_' . $optionId . '_value_' . $valueId;

                        if (!isset($_FILES[$imageName3]) || empty($_FILES[$imageName3]) || $_FILES[$imageName3]['name'] === "") {
                            continue;
                        }

                        

                        try {
                            $uploader = new Mage_Core_Model_File_Uploader($imageName3);
                            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','svg'));
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(false);

                            $dirPath = Mage::getBaseDir('media') . DS . 'custom_option_image' . DS;
                            $result = $uploader->save($dirPath, $_FILES[$imageName3]['name']);

                        } catch (Exception $e) {
                    
                            Mage::log($e->getMessage());
                        }

                       $productData['options'][$optionId]['values'][$valueId]['image3'] = 'custom_option_image/' . $result['file'];
                        $product->setCanSaveCustomOptions(true);

                       
                       // exit;
                    }
                }
            }

            $product->setProductOptions($productData['options']);

             if (isset($_FILES['product']['name']['options'])) {
                $images4 = array();
                foreach ($_FILES['product'] as $attr => $options) {
                    if (isset($options['options'])) {
                        foreach ($options['options'] as $optionId => $values) {
                            if (isset($values['values'])) {

                                //print_r($values['values']) ;

                                foreach ($values['values'] as $valueId => $data) {
                                    $key = 'option_' . $optionId . '_value_' . $valueId;
                                    if (!isset($images4[$key])) {
                                        $images4[$key] = array();
                                    }
                                    
                                    //print_r($images4);
                                    $images4[$key][$attr] = $data['image4'];
                                    
                                }
                            }
                        }
                    }
                }

                
                

                foreach ($images4 as $imageName4 => $imageData4) {
                   // print_r($imageData4);
                    $_FILES[$imageName4] = $imageData4;
                }
            }


           // print_r($_FILES[$imageName4]) ;
            


            
            $product->setProductOptions($productData['options']);

            foreach ($productData['options'] as $optionId => $option) {
                if (!empty($option['values'])) {
                    foreach ($option['values'] as $valueId => $value) {

                        $imageName4 = 'option_' . $optionId . '_value_' . $valueId;

                        if (!isset($_FILES[$imageName4]) || empty($_FILES[$imageName4]) || $_FILES[$imageName4]['name'] === "") {
                            continue;
                        }

                        

                        try {
                            $uploader = new Mage_Core_Model_File_Uploader($imageName4);
                            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','svg'));
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(false);

                            $dirPath = Mage::getBaseDir('media') . DS . 'custom_option_image' . DS;
                            $result = $uploader->save($dirPath, $_FILES[$imageName4]['name']);

                        } catch (Exception $e) {
                    
                            Mage::log($e->getMessage());
                        }

                       $productData['options'][$optionId]['values'][$valueId]['image4'] = 'custom_option_image/' . $result['file'];
                        $product->setCanSaveCustomOptions(true);

                       
                       // exit;
                    }
                }
            }

            $product->setProductOptions($productData['options']);

             if (isset($_FILES['product']['name']['options'])) {
                $images5 = array();
                foreach ($_FILES['product'] as $attr => $options) {
                    if (isset($options['options'])) {
                        foreach ($options['options'] as $optionId => $values) {
                            if (isset($values['values'])) {

                                //print_r($values['values']) ;

                                foreach ($values['values'] as $valueId => $data) {
                                    $key = 'option_' . $optionId . '_value_' . $valueId;
                                    if (!isset($images5[$key])) {
                                        $images5[$key] = array();
                                    }
                                    
                                    //print_r($images5);
                                    $images5[$key][$attr] = $data['image5'];
                                    
                                }
                            }
                        }
                    }
                }

                
                

                foreach ($images5 as $imageName5 => $imageData5) {
                   // print_r($imageData5);
                    $_FILES[$imageName5] = $imageData5;
                }
            }


           // print_r($_FILES[$imageName5]) ;
            


            
            $product->setProductOptions($productData['options']);

            foreach ($productData['options'] as $optionId => $option) {
                if (!empty($option['values'])) {
                    foreach ($option['values'] as $valueId => $value) {

                        $imageName5 = 'option_' . $optionId . '_value_' . $valueId;

                        if (!isset($_FILES[$imageName5]) || empty($_FILES[$imageName5]) || $_FILES[$imageName5]['name'] === "") {
                            continue;
                        }

                        

                        try {
                            $uploader = new Mage_Core_Model_File_Uploader($imageName5);
                            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','svg'));
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(false);

                            $dirPath = Mage::getBaseDir('media') . DS . 'custom_option_image' . DS;
                            $result = $uploader->save($dirPath, $_FILES[$imageName5]['name']);

                        } catch (Exception $e) {
                    
                            Mage::log($e->getMessage());
                        }

                       $productData['options'][$optionId]['values'][$valueId]['image5'] = 'custom_option_image/' . $result['file'];
                        $product->setCanSaveCustomOptions(true);

                       
                       // exit;
                    }
                }
            }

            $product->setProductOptions($productData['options']);
        }
    }
}