<?php
class Canvassignages_Order_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		$order_img_src = $this->getRequest()->getParam('order_img_src');
		$selectedValue = $this->getRequest()->getParam('selectedValue');
		//$main_high_image = $this->getRequest()->getParam('main_high_image');

		//saved the canvas image in the server
		$data = $order_img_src;
		$data = substr($data,strpos($data,",")+1);
		$data = base64_decode($data);
		$file = rand().'.png';
		file_put_contents(Mage::getBaseDir().'/canvas_uploader/order_image/'.$file, $data);
		$saved_file_full_url = Mage::getBaseUrl().'/canvas_uploader/order_image/'.$file;
		//echo $er = '<script>console.log("teko hudo hud")</script>';
		?>
		
		
		


		<?php
		
		//getting the data values
		$canvas_type = $selectedValue['canvasName'];
		$canvas_selected_size = $selectedValue['canvas_w']."*".$selectedValue['canvas_h'];
		$canvas_selected_size2 = $selectedValue['canvas_h']."*".$selectedValue['canvas_w'];
		echo $is_custom = $selectedValue['is_custom'];
		$canvas_style = $selectedValue['canvas_style'];
		$hardware = $selectedValue['hardware'];
		$filter = $selectedValue['filter'];
		$lamination_option = $selectedValue['lamination_option'];
		$photo_retouching = $selectedValue['photo_retouching'];
		
		$canvas_text = $selectedValue['canvas_text_options']['canvas_text'];
		$fontfamily = $selectedValue['canvas_text_options']['fontFamily'];
		$fontcolor= $selectedValue['canvas_text_options']['font_color'];
		$fontsize = $selectedValue['canvas_text_options']['font_size'];
		$isbold = $selectedValue['canvas_text_options']['is_bold'];
		$isitalic = $selectedValue['canvas_text_options']['is_italic'];
		$isunderline = $selectedValue['canvas_text_options']['is_underlined'];
		$major_retouching_text = $selectedValue['major_retouching_text'];

		$color_wrap_color = $selectedValue['canvas_style_details'];
		$canvas_style_options = $selectedValue['canvas_style_options'];

		//echo $is_custom;

		Mage::getSingleton('core/session', array('name' => 'frontend'));
		$qty = '1'; // Replace qty with your qty
	    $product = Mage::getModel('catalog/product')->load(1);
		
		foreach($product->getOptions() as $o)

		{
		
			$option = $o->getData();
			$option_title = $option['default_title'];

			// getting the canvas type
			if($option_title == "Canvas Type")
			{
				$option_canvas_type_id =  $option['option_id'];
				
			}

			if($is_custom == "true")
			{
				//getting the canvas custom size

			echo $canvas_type." Custom Size";
			
									if(substr_count($canvas_type, "thin")>0)
									
									{
										$canvas_type = "Thin Gallery Wrap (0.75)";
									}
									if(substr_count($canvas_type, "thick")>0)
									
									{
										$canvas_type = "Thick Gallery Wrap (1.5)";
									}
									if(substr_count($canvas_type, "rolled")>0)
									
									{
										$canvas_type = "Rolled Canvas";
									}

			
		     	if($option_title == $canvas_type." Custom Size")
				 {
					echo "here i am";
					 $option_size_id =  $option['option_id'];
					
				 }
			}
			else
			{
				// getting the canvas size

				if($option_title == $canvas_type." Size")
				{
					 $option_size_id =  $option['option_id'];
					
				}
			}	

			


			
		    		

			

			// getting the frame option

			if($option_title == "Frame Options")
			{
			 $option_frame_option_id =  $option['option_id'];
				
			}


			//getting the wrap border

			if($option_title == "Wrap Border")
			{
				$option_wrp_border_id =  $option['option_id'];
				
			}

			//get the hardware options
			
			if($option_title == "Hardware Options")
			{
			$option_hardware_title_id =  $option['option_id'];
				
			}

			//get the photo filters

			if($option_title == "Photo Filters")
			{
			$option_photo_filter_title_id =  $option['option_id'];
				
			}

			//get the photo retouching
			
			if($option_title == "Photo Retouching")
			{
			$option_retouching_title_id =  $option['option_id'];
				
			}


			//get the major textarea

			if($option_title == "Major Retouching Textarea")
			{
			$option_major_textarea_title_id =  $option['option_id'];
				
			}

			//get the lamonation

			if($option_title == "Lamination")
			{
			$option_lamination_title_id =  $option['option_id'];
				
			}

			// get the canvas text option
			
			if($option_title == "Canvas Text Option")
			{
				$option_cart_title_id =  $option['option_id'];
				
			}

			//get the canvas image option

			if($option_title == "Canvas Image Area")
			{
				$option_canvas_image_id = $option['option_id'];
			}	

			// get the canvas extra options

			if($option_title == "Canvas Extra Options")
			{
				$option_canvas_extra_option_id = $option['option_id'];
			}

			// get the Major Retouching Textarea

			if($option_title == "Major Retouching Textarea")
			{
				$option_retouching_textarea_id = $option['option_id'];
			}	
			
			
			
			$optionType = $o->getType();
			
			
		       $values = $o->getValues();

		            foreach ($values as $k => $v) 
					{
						$ipt_title = $v->getData();
						

						// get the selected canvas type
						if($ipt_title['default_title'] == $canvas_type)
						{
							
							$canvas_type_id = $ipt_title['option_type_id'];
						
						}

						//check if the label match for type

						if($ipt_title['class1'] == $canvas_type)
						{
							
							$canvas_type_id = $ipt_title['option_type_id'];
						
						}

						

					   // get the custom selected size

					   if($is_custom == "true")
					   {
					   		//echo $canvas_type." Custom Size";

					   	
					   		if(substr_count($option_title, "Custom Size")>0)
					    		{
									
									if(substr_count($canvas_type, "thin")>0)
									
									{
										$canvas_type = "Thin Gallery Wrap (0.75)";
									}
									if(substr_count($canvas_type, "thick")>0)
									
									{
										$canvas_type = "Thick Gallery Wrap (1.5)";
									}
									if(substr_count($canvas_type, "rolled")>0)
									
									{
										$canvas_type = "Rolled Canvas";
									}
									
					   			echo $canvas_type." Custom Size";
					   			if($option_title == ($canvas_type." Custom Size"))
								 {	
							    		echo $canvas_selected_size;
							 	if($ipt_title['default_title'] == $canvas_selected_size)
							 	{
										echo "here i am hudo";
									 
							 		 $opt_seleted_size = $ipt_title['option_type_id'];
									 
							 	}
							 	else
							 	{
									if($ipt_title['default_title'] == $canvas_selected_size2)
									{
											echo "here i am hudo";
										 
										 $opt_seleted_size = $ipt_title['option_type_id'];
										 
									}
									
								}
							   }
					   		}
					   	
					   		
					   }

					   else  {
					   		//get the selected size

							   if($option_title == $canvas_type." Size")
							   {	
							   		
									if($ipt_title['default_title'] ==$canvas_selected_size)
									{
									 
										$opt_seleted_size = $ipt_title['option_type_id'];
									 
									}
							   }
					   	}	

					   //get the frames

					  	$canvas_type_redirect = strtolower(str_replace(" ","-",($ipt_title['default_title'])));

					  	$canvas_type_redirect_wrap = strtolower(str_replace(" ","_",($ipt_title['default_title'])));
						
						if(strtolower($canvas_type_redirect) == strtolower($canvas_style))
						{
							//echo "takla";
							
				        	$opt_canvas_style = $ipt_title['option_type_id'];

				        	$opt_canvas_style_id = $option_frame_option_id;
						 
						
						}

						if($canvas_style_options == "wrap border")
						{
							//get the wrap border

							if(strtolower($canvas_type_redirect_wrap) == strtolower($canvas_style))
							{

								echo "takla2";
								
					        	$opt_canvas_style = $ipt_title['option_type_id'];

					        	$opt_canvas_style_id = $option_wrp_border_id;
							 
							
							}
							
						}	
						
						// get the hardware

						if( strtolower($ipt_title['default_title']) == strtolower($hardware) )
						{
							$opt_hardware = $ipt_title['option_type_id'];
						 
						
						}

						// get the filter

						if( strtolower($ipt_title['default_title']) == strtolower($filter) )
						{
						 	$opt_filter = $ipt_title['option_type_id'];
						
						
						}

						// get the photo retouching

						if(strtolower($canvas_type_redirect) == strtolower($photo_retouching))
						{
						 	$opt_retouching = $ipt_title['option_type_id'];
						 
						
						}

						// get the lamination option

						if(strtolower($ipt_title['default_title']) == strtolower($lamination_option))
						{
						 	$opt_lamination = $ipt_title['option_type_id'];
						 
						
						}

						//get the extra datas of canvas

						
						
		            }
		     
		
	    }	
	  // echo $option_size_id;

	    $canvas_extra_content="";
		$canvas_extra_content.="Font Family is ".$fontfamily.", "; 
		$canvas_extra_content.="Font Color is ".$fontcolor.", "; 
		$canvas_extra_content.="Font Size is ".$fontsize.", "; 
		$canvas_extra_content.="Is bold ".$isbold.", "; 
		$canvas_extra_content.="Is italic ".$isitalic.", ";
		$canvas_extra_content.="Is underline ".$isunderline.", ";

		if($is_custom == "true")
		{
			$canvas_extra_content.="Width is ".$selectedValue['canvas_w'].", ";
			$canvas_extra_content.="Height is ".$selectedValue['canvas_h'].", ";
		}	

		if($color_wrap_color !="")
		{
			$canvas_extra_content.="Color Wrap Color is ".$color_wrap_color.", ";
		}

	    $request = new Varien_Object();
			$request->setData($params);
	
			$cart = Mage::getModel('checkout/cart');
		    $cart->init();
	    	$cart->addProduct($product, array('qty' => $qty,'options' => array(
	        $option_canvas_type_id => $canvas_type_id,
	        $option_size_id => $opt_seleted_size,
	        $option_hardware_title_id => $opt_hardware,
	        $option_photo_filter_title_id => $opt_filter,
	        $option_lamination_title_id => $opt_lamination,
	        $option_retouching_title_id => $opt_retouching,
	        $opt_canvas_style_id => $opt_canvas_style,
	        $option_cart_title_id => $canvas_text,
	        $option_canvas_extra_option_id=>$canvas_extra_content,
	        $option_retouching_textarea_id =>$major_retouching_text,
	        $option_canvas_image_id => $saved_file_full_url
			        
   					 ),
	    	
		    ),$request);
			 $cart->save();

			


	       
		    echo "Product added successfully";
	
   

    } // end action


	//stellPlate    
     public function stellAction()
     {
     	//echo "teko";
     	$order_img_src = $this->getRequest()->getParam('order_img_src');
		$selectedValue = $this->getRequest()->getParam('selectedValue');

		//print_r($selectedValue);

		//saved the canvas image in the server
		$data = $order_img_src;
		$data = substr($data,strpos($data,",")+1);
		$data = base64_decode($data);
		$file = rand().'.png';
		file_put_contents(Mage::getBaseDir().'/canvas_uploader/order_image/'.$file, $data);
		$saved_file_full_url = Mage::getBaseUrl().'/canvas_uploader/order_image/'.$file;

		$canvas_type = $selectedValue['canvasName'];
		$canvas_selected_size = $selectedValue['canvas_w']."*".$selectedValue['canvas_h'];
		$is_custom = $selectedValue['is_custom'];
		$canvas_style = $selectedValue['canvas_style'];
		$canvas_fixing_method = $selectedValue['fixing_method']['met_name'];

		 $canvas_text = $selectedValue['canvas_text_options']['canvas_text'];
		$fontfamily = $selectedValue['canvas_text_options']['fontFamily'];
		$fontcolor= $selectedValue['canvas_text_options']['font_color'];
		$fontsize = $selectedValue['canvas_text_options']['font_size'];
		$isbold = $selectedValue['canvas_text_options']['is_bold'];
		$isitalic = $selectedValue['canvas_text_options']['is_italic'];
		$isunderline = $selectedValue['canvas_text_options']['is_underlined'];

		Mage::getSingleton('core/session', array('name' => 'frontend'));
		$qty = '1'; // Replace qty with your qty
	    $product = Mage::getModel('catalog/product')->load(3);
		
		
	    foreach($product->getOptions() as $o)

		{
			$option = $o->getData();
			$option_title = $option['default_title'];

			//print_r($option_title);

				if($option_title == "Plate Size")
			   {
			   		 $canvas_size_id = $option['option_id'];
			   }
			   if($option_title == "Fixing Method")
			   {
			   		 $canvas_fixing_id = $option['option_id'];
			   }
			   //get the canvas image option

				if($option_title == "Canvas Image Area")
				{
					$option_canvas_image_id = $option['option_id'];
				}	

				// get the canvas extra options

				if($option_title == "Canvas Extra Options")
				{
					$option_canvas_extra_option_id = $option['option_id'];
				}

			// get the canvas text option
			
			if($option_title == "Canvas Text Option")
			{
				$option_cart_title_id =  $option['option_id'];
				
			}

		   $values = $o->getValues();

	        foreach ($values as $k => $v) 
			{
				$ipt_title = $v->getData();

				if($ipt_title['default_title'] ==$canvas_selected_size)
				{
				 
					$opt_seleted_size = $ipt_title['option_type_id'];
				 
				}

				if($ipt_title['default_title'] ==$canvas_fixing_method)
				{
				 
					 $opt_seleted_fixing = $ipt_title['option_type_id'];
				 
				}

			}




			

		}

		$canvas_extra_content="";
			$canvas_extra_content.="Font Family is ".$fontfamily.", "; 
			$canvas_extra_content.="Font Color is ".$fontcolor.", "; 
			$canvas_extra_content.="Font Size is ".$fontsize.", "; 
			$canvas_extra_content.="Is bold ".$isbold.", "; 
			$canvas_extra_content.="Is italic ".$isitalic.", ";
			$canvas_extra_content.="Is underline ".$isunderline.", ";

			 $request = new Varien_Object();
			$request->setData($params);
			$qty =1;
	
			$cart = Mage::getModel('checkout/cart');
		    $cart->init();
	    	$cart->addProduct($product, array('qty' => $qty,'options' => array(
	    		 $canvas_size_id => $opt_seleted_size,
	        $option_cart_title_id => $canvas_text,
	        $option_canvas_extra_option_id=>$canvas_extra_content,
	        $canvas_fixing_id =>$opt_seleted_fixing,
	        $option_canvas_image_id => $saved_file_full_url
	        
			        
   					 ),
	    	
		    ),$request);
			 $cart->save();
 

     }
    
    public function photoAction()
   {
   		$original_url = $this->getRequest()->getParam('original_url');
		$order_option_name = $this->getRequest()->getParam('order_option_name');

		Mage::getSingleton('core/session', array('name' => 'frontend'));
		$qty = '1'; // Replace qty with your qty
	    $product = Mage::getModel('catalog/product')->load(7);
		
		foreach($product->getOptions() as $o)

		{
		
			$option = $o->getData();
			$option_title = $option['default_title'];

			// getting the Photo Gallery
			if($option_title == "Photo Gallery")
			{
				$option_canvas_type_id =  $option['option_id'];
				
			}

			// getting the Photo Gallery
			if($option_title == "Canvas Image Area")
			{
				$option_canvas_image_id =  $option['option_id'];
				
			}


			$optionType = $o->getType();
			
			
		       $values = $o->getValues();

		            foreach ($values as $k => $v) 
					{
						$ipt_title = $v->getData();
						

						// get the selected canvas type
						if($ipt_title['default_title'] == $order_option_name)
						{
							
							echo $canvas_gallery_id = $ipt_title['option_type_id'];
						
						}
					}
		}

		$request = new Varien_Object();
			$request->setData($params);
	
			$cart = Mage::getModel('checkout/cart');
		    $cart->init();
	    	$cart->addProduct($product, array('qty' => $qty,'options' => array(
	        $option_canvas_type_id => $canvas_gallery_id,
	        $option_canvas_image_id => $original_url
	      
			        
   					 ),
	    	
		    ),$request);
			 $cart->save();

			


	       
		    echo "Product added successfully";
   }

   //walldisplay    
     public function wallAction()
     {
     	$svg = $this->getRequest()->getParam('svg');
		$selectedValue = $this->getRequest()->getParam('selectedValue');
		$canvas_image = $this->getRequest()->getParam('canvas_image');
		//echo "teko";
		//print_r($svg);

		$image=1;
		$session = Mage::getSingleton('core/session');
		$sid = $session->getEncryptedSessionId(); //current session id

		$saved_file_full_url="";

		foreach ($svg as $data) {
				//saved the canvas image in the server
			
			$data = substr($data,strpos($data,",")+1);
			$data = base64_decode($data);
			$file = rand().'.png';

			 if (!file_exists(Mage::getBaseDir().'/canvas_uploader/order_image/'.$sid)) 
			{
						mkdir(Mage::getBaseDir().'/canvas_uploader/order_image/'.$sid, 0777, true);
						//$upload_id = $customer_id;
			}

			if (!file_exists(Mage::getBaseDir().'/canvas_uploader/order_image/'.$sid.'/'.$image)) 
			{
						mkdir(Mage::getBaseDir().'/canvas_uploader/order_image/'.$sid.'/'.$image, 0777, true);
						//$upload_id = $customer_id;
			}




			file_put_contents(Mage::getBaseDir().'/canvas_uploader/order_image/'.$sid.'/'.$image.'/'.$file, $data);
			$saved_file_full_url.= Mage::getBaseUrl().'/canvas_uploader/order_image/'.$sid.'/'.$image.'/'.$file." ,";

			$image++;
		}
		$data = $canvas_image;
		$data = substr($data,strpos($data,",")+1);
			$data = base64_decode($data);
			$file = rand().'.png';

			mkdir(Mage::getBaseDir().'/canvas_uploader/order_image/'.$sid.'/'.'wall/', 0777, true);

			file_put_contents(Mage::getBaseDir().'/canvas_uploader/order_image/'.$sid.'/wall'.'/'.$file, $data);

			$order_image_url = Mage::getBaseUrl().'/canvas_uploader/order_image/'.$sid.'/wall'.'/'.$file;

		Mage::getSingleton('core/session', array('name' => 'frontend'));
		$qty = '1'; // Replace qty with your qty
	    $product = Mage::getModel('catalog/product')->load(5);

	    //print_r($selectedValue);
	    $panel_name = $selectedValue['panel_name'];
	    $panel_items = $selectedValue['panel_items'];
	    $panel_price = $selectedValue['panel_price'];
	    $panel_items_sizes = $selectedValue['panel_items_sizes'];
	    $panel_template = $selectedValue['panel_template'];

	    foreach($product->getOptions() as $o)

		{
		
			$option = $o->getData();
			$option_title = $option['default_title'];

			// getting the Photo Gallery
			if($option_title == "Size")
			{
				$option_canvas_type_id =  $option['option_id'];
				
			}

			// getting the Photo Gallery
			if($option_title == "Canvas Image Area")
			{
				$option_canvas_image_id =  $option['option_id'];
				
			}

			if($option_title == "Canvas Extra Options Wall")
			{
				$option_extra_image_id =  $option['option_id'];
				
			}


			$optionType = $o->getType();
			
			
		       $values = $o->getValues();

		            foreach ($values as $k => $v) 
					{
						$ipt_title = $v->getData();
						

						// get the selected canvas type
						if($ipt_title['class1'] == $panel_name)
						{
							
							$canvas_gallery_size_id = $ipt_title['option_type_id'];
						
						}
					}
		}

		$request = new Varien_Object();
			$request->setData($params);
	
			$cart = Mage::getModel('checkout/cart');
		    $cart->init();
	    	$cart->addProduct($product, array('qty' => $qty,'options' => array(
	        $option_canvas_type_id => $canvas_gallery_size_id,
	        $option_canvas_image_id => $saved_file_full_url,
	        $option_extra_image_id => $order_image_url
	      
			        
   					 ),
	    	
		    ),$request);
			 $cart->save();

		
     }
    
    
     public function stelladdAction()
     {
		 //echo "here";
		 
		 $data = unserialize($_POST['custom_option_id']);
		 
		 $data_label = $data['option_label'];
		 
		  $data_size = $data['width'].'*'.$data['height'];
		 
		 
		 Mage::getSingleton('core/session', array('name' => 'frontend'));
		$qty = '1'; // Replace qty with your qty
	    $product = Mage::getModel('catalog/product')->load(3);
		
		
	    foreach($product->getOptions() as $o)

		{
			$option = $o->getData();
			$option_title = $option['default_title'];

			//print_r($option_title);

				if($option_title == "Our Sign Gallery")
			   {
				  
			   		 $canvas_sign_id = $option['option_id'];
			   }
			   
			   if($option_title == $data_label." Size")
			   {
				  
			   		 $canvas_size_id = $option['option_id'];
			   }
			   

		   $values = $o->getValues();

	        foreach ($values as $k => $v) 
			{
				$ipt_title = $v->getData();

				if($ipt_title['default_title'] ==$data_label)
				{
				 
					 $opt_seleted_sign = $ipt_title['option_type_id'];
				 
				}
				if($ipt_title['default_title'] ==$data_size)
				{
					if($option_title == $data_label." Size")
				   {
					   echo $opt_seleted_size = $ipt_title['option_type_id'];
				   }
				 
					
				 
				}

				
			}



		} //end foreach
		
		//die;
		 
		   $request = new Varien_Object();
			$request->setData($params);
			$qty =1;
	
			$cart = Mage::getModel('checkout/cart');
		    $cart->init();
	    	$cart->addProduct($product, array('qty' => $qty,'options' => array(
	    		 $canvas_sign_id => $opt_seleted_sign,
	    		 $canvas_size_id => $opt_seleted_size
			        ),
	    	
		    ),$request);
			 $cart->save();
		  
		  
		 $this->_redirect('checkout/cart');
	 }

}//end controller
