<?php
<<<<<<< HEAD
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
					$values = $o->getValues();
					//$j=0;
					$img_array = array();
					$j=1;
					foreach ($values as $k => $v) 
					{
						$ipt_title = $v->getData();
						$sort_order = $ipt_title['sort_order'];
						$img_array['view_1'][$j]['image1'] = $ipt_title['image1'];
						$img_array['view_2'][$j]['image2'] = $ipt_title['image2'];
						$img_array['view_3'][$j]['image3'] = $ipt_title['image3'];
						$img_array['view_4'][$j]['image4'] = $ipt_title['image4'];
						$img_array['view_5'][$j]['image5'] = $ipt_title['image5'];
						$j++;
					} //end of foreach
				} // end of if
				/* Now we need to check which metal then metal-style and then metal-style-side 1 stone 1 */
				if($option_title == "Metal"){
					$values = $o->getValues();
					foreach ($values as $k => $v) {
						$ipt_title = $v->getData();
						//print_r($ipt_title);
						if($v->getClass() == "default"){
							$metal_name = $v->getTitle();
						}
					}
				} // metal contidation 
				// load the default Style with the name of the default metal
				if($option_title == $metal_name." Style"){
					$values = $o->getValues();
					foreach ($values as $k => $v) {
						$ipt_title = $v->getData();
						//print_r($ipt_title);
						if($v->getClass() == "default"){
							$style_name = $v->getTitle();
							$default_style_srt_order = $ipt_title['sort_order'];
						}
						/*other style title with sort order*/
						else{
							/*echo $v->getTitle();
							echo $ipt_title['sort_order'];*/
							$other_style_arr[]=array('title'=>$v->getTitle(),'srt_order'=>$ipt_title['sort_order']); 
						}
					}
				}
				// load the default stone images now
				$main_stone_loader_title = $metal_name." Style ".$style_name." Side 1 Stone 1";
				if($option_title == $main_stone_loader_title){
					$values = $o->getValues();
					$stone_array = array();
					$s=1;
					foreach ($values as $k => $v) 
					{
						$ipt_title = $v->getData();
						$sort_order = $ipt_title['sort_order'];
						$stone_array['stone']['view_1'][$s]['image1'] = $ipt_title['image1'];
						$stone_array['stone']['view_2'][$s]['image2'] = $ipt_title['image2'];
						$stone_array['stone']['view_3'][$s]['image3'] = $ipt_title['image3'];
						$stone_array['stone']['view_4'][$s]['image4'] = $ipt_title['image4'];
						$stone_array['stone']['view_5'][$s]['image5'] = $ipt_title['image5'];
						$s++;
					} //end of foreach
				}
				/****************************************
					load other stone 
				*****************************************/
				for($i=0;$i<count($other_style_arr);$i++)
				{
					$style_name1 =  $other_style_arr[$i]['title'];
					/***********************Load side 1 stone 1*************************/
					$other_main_stone_loader_title = $metal_name." Style ".$style_name1." Side 1 Stone 1";
					if($option_title == $other_main_stone_loader_title){
						//echo $option_title ."</br>";
						$folder_name_array[] = array('foldername'=>$other_style_arr[$i]['srt_order']);
						$fldr_name = $other_style_arr[$i]['srt_order'];
						$values = $o->getValues();
						//$other_stone_array = array();
						$s=1;
						foreach ($values as $k => $v) 
						{
							$ipt_title = $v->getData();
							$sort_order = $ipt_title['sort_order'];
							$other_stone_array[$fldr_name]['view_1'][$s]['image1'] = $ipt_title['image1'];
							$other_stone_array[$fldr_name]['view_2'][$s]['image2'] = $ipt_title['image2'];
							$other_stone_array[$fldr_name]['view_3'][$s]['image3'] = $ipt_title['image3'];
							$other_stone_array[$fldr_name]['view_4'][$s]['image4'] = $ipt_title['image4'];
							$other_stone_array[$fldr_name]['view_5'][$s]['image5'] = $ipt_title['image5'];
							$s++;
						} //end of foreach
					}
					/************************Load side 1 stone 2************************/
					$style_name2 =  $other_style_arr[$i]['title'];
					$other_main_stone_loader_title2 = $metal_name." Style ".$style_name2." Side 1 Stone 2";
					if($option_title == $other_main_stone_loader_title2){
						//echo $option_title ."</br>";
						$folder_name_array1[] = array('foldername'=>$other_style_arr[$i]['srt_order']);
						$fldr_name1 = $other_style_arr[$i]['srt_order'];
						$values = $o->getValues();
						//$other_stone_array = array();
						$s=1;
						foreach ($values as $k => $v) 
						{
							$ipt_title = $v->getData();
							$sort_order = $ipt_title['sort_order'];
							$other_stone_array2[$fldr_name1]['view_1'][$s]['image1'] = $ipt_title['image1'];
							$other_stone_array2[$fldr_name1]['view_2'][$s]['image2'] = $ipt_title['image2'];
							$other_stone_array2[$fldr_name1]['view_3'][$s]['image3'] = $ipt_title['image3'];
							$other_stone_array2[$fldr_name1]['view_4'][$s]['image4'] = $ipt_title['image4'];
							$other_stone_array2[$fldr_name1]['view_5'][$s]['image5'] = $ipt_title['image5'];
							$s++;
						} //end of foreach
					}
					/***********************************/
				}
			} //end of foreach
			//print_r($other_style_arr);
			//print_r($stone_array);
			/*	echo "</br>";
				print_r($other_stone_array2);
				//	print_r($folder_name_array);
			die();*/
			/*Added Code For Each View*/
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
			/*View Folder Style stone Images are here*/
			/* Time to call the stone array now which is based on hudo's energy*/
			/*default create*/
			$stone_type_counter = 1;
			foreach ($stone_array as $stone_array_slice) {
				/*Don't think this slice means cold-drinks slice*/
				//print_r($stone_array_slice);
				$stone_view1 = 1;
				foreach ($stone_array_slice['view_1'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$default_style_srt_order)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$default_style_srt_order, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image1'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$default_style_srt_order.'/'.$stone_view1.'.png');
					$stone_view1++;
				}
				$stone_view2 = 1;
				foreach ($stone_array_slice['view_2'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$default_style_srt_order)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$default_style_srt_order, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image2'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$default_style_srt_order.'/'.$stone_view2.'.png');
					$stone_view2++;
				}
				$stone_view3 = 1;
				foreach ($stone_array_slice['view_3'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$default_style_srt_order)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$default_style_srt_order, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image3'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$default_style_srt_order.'/'.$stone_view3.'.png');
					$stone_view3++;
				}
				$stone_view4 = 1;
				foreach ($stone_array_slice['view_4'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$default_style_srt_order)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$default_style_srt_order, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image4'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$default_style_srt_order.'/'.$stone_view4.'.png');
					$stone_view4++;
				}
				$stone_view5 = 1;
				foreach ($stone_array_slice['view_5'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$default_style_srt_order)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$default_style_srt_order, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image5'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$default_style_srt_order.'/'.$stone_view5.'.png');
					$stone_view5++;
				}
				$stone_type_counter++;
			}
			/**other stone folder create for side 1 stone 1**/
			// echo "length=".count($other_stone_array);
			for($p=0;$p<count($folder_name_array);$p++){
				$indx = $folder_name_array[$p]['foldername'];
				//print_r($other_stone_array[$indx]);
				$stone_view1 = 1;
				foreach ($other_stone_array[$indx]['view_1'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$indx)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$indx, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image1'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$indx.'/'.$stone_view1.'.png');
					$stone_view1++;
				}
				$stone_view2 = 1;
				foreach ($other_stone_array[$indx]['view_2'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$indx)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$indx, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image2'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$indx.'/'.$stone_view2.'.png');
					$stone_view2++;
				}
				$stone_view3 = 1;
				foreach ($other_stone_array[$indx]['view_3'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$indx)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$indx, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image3'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$indx.'/'.$stone_view3.'.png');
					$stone_view3++;
				}
				$stone_view4 = 1;
				foreach ($other_stone_array[$indx]['view_4'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$indx)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$indx, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image4'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$indx.'/'.$stone_view4.'.png');
					$stone_view4++;
				}
				$stone_view5 = 1;
				foreach ($other_stone_array[$indx]['view_5'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$indx)) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$indx, 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image5'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$indx.'/'.$stone_view5.'.png');
					$stone_view5++;
				}
			}
			/**other stone folder create for side 1 stone 2**/
			for($p=0;$p<count($folder_name_array1);$p++){
				$indx = $folder_name_array1[$p]['foldername'];
				$stone_view1 = 1;
				foreach ($other_stone_array2[$indx]['view_1'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$indx.'/2')) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$indx.'/2', 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image1'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_1/'.$indx.'/2/'.$stone_view1.'.png');
					$stone_view1++;
				}
				$stone_view2 = 1;
				foreach ($other_stone_array2[$indx]['view_2'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$indx.'/2')) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$indx.'/2', 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image2'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_2/'.$indx.'/2/'.$stone_view2.'.png');
					$stone_view2++;
				}
				$stone_view3 = 1;
				foreach ($other_stone_array2[$indx]['view_3'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$indx.'/2')) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$indx.'/2', 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image3'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_3/'.$indx.'/2/'.$stone_view3.'.png');
					$stone_view3++;
				}
				$stone_view4 = 1;
				foreach ($other_stone_array[$indx]['view_4'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$indx.'/2')) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$indx.'/2', 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image4'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_4/'.$indx.'/2/'.$stone_view4.'.png');
					$stone_view4++;
				}
				$stone_view5 = 1;
				foreach ($other_stone_array[$indx]['view_5'] as $key => $value) {
					/*check directory is exist or not if not create directory*/
					if (!file_exists(Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$indx.'/2')) {
						mkdir(Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$indx.'/2', 0777, true);
					}
					$custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image5'];
					copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_5/'.$indx.'/2/'.$stone_view5.'.png');
					$stone_view5++;
				}
			}
			//exit();
			$this->_getSession()->addSuccess($this->__('Congratulations, you clicked on a button!'));
			// Redirect to product edit page
			$this->_redirect('*/catalog_product/edit', array(
=======
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
                


                $values = $o->getValues();
                //$j=0;

                $img_array = array();

                $j=1;

                foreach ($values as $k => $v) 
                {
                    $ipt_title = $v->getData();

                    $sort_order = $ipt_title['sort_order'];


                   
                    $img_array['view_1'][$j]['image1'] = $ipt_title['image1'];
                    $img_array['view_2'][$j]['image2'] = $ipt_title['image2'];
                    $img_array['view_3'][$j]['image3'] = $ipt_title['image3'];
                    $img_array['view_4'][$j]['image4'] = $ipt_title['image4'];
                    $img_array['view_5'][$j]['image5'] = $ipt_title['image5'];
                   
                    

                    
                    $j++;

                } //end of foreach

                
            } // end of if

            /* Now we need to check which metal then metal-style and then metal-style-side 1 stone 1 */

            if($option_title == "Metal"){
                

                 $values = $o->getValues();

                 foreach ($values as $k => $v) {
                    $ipt_title = $v->getData();
                    //print_r($ipt_title);

                    if($v->getClass() == "default"){
                         
                        $metal_name = $v->getTitle();
                    }

                }
            } // metal contidation 


            // load the default Style with the name of the default metal

            if($option_title == $metal_name." Style"){

                 $values = $o->getValues();

                 foreach ($values as $k => $v) {
                    $ipt_title = $v->getData();
                    //print_r($ipt_title);

                    if($v->getClass() == "default"){
                         
                        $style_name = $v->getTitle();


                    }

                }

            }

            // load the default stone images now

            $main_stone_loader_title = $metal_name." Style ".$style_name." Side 1 Stone 1";

           

            if($option_title == $main_stone_loader_title){

                

                $values = $o->getValues();

                $stone_array = array();

                $s=1;

                foreach ($values as $k => $v) 
                {
                    $ipt_title = $v->getData();

                    $sort_order = $ipt_title['sort_order'];


                   
                    $stone_array['stone']['view_1'][$s]['image1'] = $ipt_title['image1'];
                    $stone_array['stone']['view_2'][$s]['image2'] = $ipt_title['image2'];
                    $stone_array['stone']['view_3'][$s]['image3'] = $ipt_title['image3'];
                    $stone_array['stone']['view_4'][$s]['image4'] = $ipt_title['image4'];
                    $stone_array['stone']['view_5'][$s]['image5'] = $ipt_title['image5'];
                    
                    

                    
                    $s++;

                } //end of foreach
            }



        } //end of foreach


        /*Added Code For Each View*/


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

        /*View Folder Style Images are here*/

        /* Time to call the stone array now which is based on hudo's energy*/

        

        $stone_type_counter = 1;

        foreach ($stone_array as $stone_array_slice) {

            /*Don't think this slice means cold-drinks slice*/
            
            //print_r($stone_array_slice);

            $stone_view1 = 1;

            foreach ($stone_array_slice['view_1'] as $key => $value) {

                
                $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image1'];
                copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_1/1/'.$stone_view1.'.png');
                $stone_view1++;
            }

            $stone_view2 = 1;

            foreach ($stone_array_slice['view_2'] as $key => $value) {

                
                $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image2'];
                copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_2/1/'.$stone_view2.'.png');
                $stone_view2++;
            }

            $stone_view3 = 1;

            foreach ($stone_array_slice['view_3'] as $key => $value) {

                
                $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image3'];
                copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_3/1/'.$stone_view3.'.png');
                $stone_view3++;
            }

            $stone_view4 = 1;

            foreach ($stone_array_slice['view_4'] as $key => $value) {

                
                $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image4'];
                copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_4/1/'.$stone_view4.'.png');
                $stone_view4++;
            }

            $stone_view5 = 1;

            foreach ($stone_array_slice['view_5'] as $key => $value) {

                
                $custom_image_path = Mage::getBaseDir().'/'.'media/'.$value['image5'];
                copy($custom_image_path ,Mage::getBaseDir().'/'.'jewelzhq/style/view_5/1/'.$stone_view5.'.png');
                $stone_view5++;
            }



            $stone_type_counter++;

        }
        


         //exit();



        $this->_getSession()->addSuccess($this->__('Congratulations, you clicked on a button!'));

        // Redirect to product edit page
        $this->_redirect('*/catalog_product/edit', array(
            'id'    => $productId,
            '_current'=>true
			));
		}
	}														