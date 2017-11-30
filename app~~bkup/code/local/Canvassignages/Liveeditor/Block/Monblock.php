<?php
class Canvassignages_Liveeditor_Block_Monblock extends Mage_Core_Block_Template
{
     public function methodblock($name)
     {
		 $name = $name;
         return 'informations de mon block !!'.$name ;
     } 
     
     
     
     public function customCanvasPrint($sku,$opt_title)
     {

		$product_data_arr = array();
		 
		$product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
		$product_id = $product->getId();
		$obj = Mage::getModel('catalog/product');
		$product = $obj->load($product_id);
		$product_data="";
		
		foreach($product->getOptions() as $o)

		{
			
			$options = $o->getData();
			$optionType = $o->getType();
			$option_title = $options['default_title'];
			
			if($option_title == $opt_title)
			{
				$values = $o->getValues();
				$j=0;

				foreach ($values as $k => $v) 
				{
					$ipt_title = $v->getData();

					//echo "<pre>"; print_r($v->getData());

					$canvas_type_option_title = $ipt_title['default_title'];
					$canvas_type_option_label = $ipt_title['class1'];
					$initial_price = $ipt_title['class2'];
					$price = $ipt_title['price'];
					$width = $ipt_title['width'];
					$category = $ipt_title['category'];
					$panel = $ipt_title['paneltype'];
					$canvas_data_type = str_replace(" ","_",strtolower($canvas_type_option_title));
					$canvas_type_redirect = str_replace(" ","-",($canvas_type_option_title));

					$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
					$canvas_data_type = str_replace(" ","_",strtolower($canvas_type_option_title));
					$canvas_type_redirect = str_replace(" ","-",($canvas_type_option_title));

					$default = $ipt_title['class'];

					$img_url = $ipt_title['image'];
					
					$description = $ipt_title['description'];
					$template = $ipt_title['template'];
					$panelsize = $ipt_title['panelsize'];
					$sku = $ipt_title['sku'];
					$sort_order=$ipt_title['sort_order'];
					
					$product_data.=$canvas_type_option_title;
					
					$product_data_arr[$j]['option_label'] = $canvas_type_option_label;
					$product_data_arr[$j]['default_title'] = $canvas_type_option_title;
					$product_data_arr[$j]['img_url'] = $img_url;
					$product_data_arr[$j]['data_canvas_type'] = $canvas_data_type;
					$product_data_arr[$j]['canvas_type_redirect'] = $canvas_type_redirect;
					$product_data_arr[$j]['initial_price'] = $initial_price;
					$product_data_arr[$j]['price'] = $price;
					$product_data_arr[$j]['default'] = $default;
					$product_data_arr[$j]['width'] = $width;
					$product_data_arr[$j]['description'] = $description;
					$product_data_arr[$j]['category'] = $category;
					$product_data_arr[$j]['panel_type'] = $panel;
					$product_data_arr[$j]['template'] = $template;
					$product_data_arr[$j]['panelsize'] = $panelsize;
					$product_data_arr[$j]['sku'] = $sku;
					$product_data_arr[$j]['sort_order'] =$sort_order;
						
					$j++;
				}
			}
			
		}  // end foreach


		return $product_data_arr;
	 } //end function customCanvasPrint


}// end class
