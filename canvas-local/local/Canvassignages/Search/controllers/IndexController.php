<?php
class Canvassignages_Search_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	 $skin_url =  Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		 $data_source='<ul><a href="javascript:void(0)" class="closeCOmputerModal"><i class="fa fa-times"></i> </a>
		';
		 $serach_term = $this->getRequest()->getParam('search_val');

		  $sku = "steel-plates";
		  $opt_title = "Archive Gallery";
		  $product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);

			foreach($product_data as $canvas_data)
			{
				$sku = "steel-plates";
				$opt_title = "Our Icons";
				$product_data_archive = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
				foreach ($product_data_archive as $product_data_archive) 
				{ 
					$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
					
					$img_url = $product_data_archive['img_url'];
					
					//echo strtolower($product_data_archive['default_title'])."<br/>";
					
					//echo $product_data_archive['default_title'];img_url
					
					if(substr_count(strtolower($product_data_archive['img_url']),strtolower($serach_term))>0 
					|| substr_count(strtolower($product_data_archive['default_title']),strtolower($serach_term))>0 || substr_count(strtolower($product_data_archive['category']),strtolower($serach_term))>0 )
					{
						//echo "here ".strtolower($serach_term);
						
						$data_source_image[]=$media_url.$img_url;
					} 
				}
				
				
			}
			
			
			
			$data_source_filter = array_unique($data_source_image);
			
			foreach ($data_source_filter as $data_source_filter)
			{
				//print_r($data_source_filter);
				$data_source.= ' <li>
				<a href="#">
				<img src="'.$data_source_filter.'" alt="Style Image">
				<img class="select-check" src="'.$skin_url.'frontend/rwd/default/images/canvas_live_editor/images/select-check.png" alt="Select Check">
				</a>
				</li>';
				
			}
			
			$data_source.="</ul>";
			
			
			echo $data_source;
		} // end action
		
		// Steel Plate Custom option Filter
		public function customsignAction(){
			$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
			
			$serach_term = $this->getRequest()->getParam('sort_by');	
			$sku = "steel-plates";
			$opt_title = "Our Icon Gallery";
			$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
			$custom_content = '<form><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="extensive-collection-product fixed-box">
			<img src="'.$skin_url.'frontend/rwd/default/images/custom_canvas_print/edit-icon.png" alt="Edit Icon">
			<h3>Design Yourself </h3>
			<a href="'.Mage::getBaseUrl().'liveeditor/index/stellplate" class="button small border">Start Your Design</a> 
			</div>
			</div></form>';
			foreach($product_data as $canvas_data)
			{
				if(!empty($serach_term) && $canvas_data['category'] != $serach_term){
					continue;
				}
				$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
				$sign_img = $canvas_data['img_url'];
				$custom_content .= '<form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'canvas-product/index/steelplate" enctype="form-data" >
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="extensive-collection-product">
				<div class="top">
				<div class="image">
				<img height="200" width="220" src="'.$media_url.$sign_img.'" alt="extensive collection Product">
				</div>
				<div class="detail">
				<div class="name">'.$canvas_data['option_label'].'</div>
				<div class="price"><strike>'.number_format($canvas_data['initial_price'],2).'</strike> <span>'.number_format($canvas_data['price'],2).'</span></div>
				<input type="hidden" name="custom_option" value=\''.serialize($canvas_data).'\' />
				</div>
				</div>
				<div class="bottom">
				<button type="submit" class="button small blue">Start Sign</button>
				</div>
				</div>
				</div>
				</form>';			
			}
			echo $custom_content;
			
			
		}
		
	
	// Photo Collage Custom option Filter
    public function photofilterAction(){
		$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		  
		$serach_term = $this->getRequest()->getParam('sort_by');	
		$sku = "photo-collage";
		$opt_title = "Photo Gallery";
		$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
		$custom_content = '';
		foreach($product_data as $canvas_data)
		{
			if(!empty($serach_term) && $canvas_data['category'] != $serach_term){
				continue;
			}
			$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
			$sign_img = $canvas_data['img_url'];
			$custom_content .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="extensive-collection-product">
										<div class="top">
											<div class="image">
												<img src="'.$media_url.$sign_img.'" alt="extensive collection Product">
											</div>
											<div class="detail">
												<div class="name">'.$canvas_data['option_label'].'</div>
												<div class="image-count">('.$canvas_data['panel_type'].' image) </div>
												<div class="price">Start at <span>$'.number_format($canvas_data['price'],2).'</span></div>
											</div>
										</div>
										<div class="bottom">
											<a href="#" class="button medium blue" data-toggle="modal" data-target="#photo-uplopad">Upload &amp; Order</a> 
										</div>
									</div>
								</div>';			
		}
		echo $custom_content;
		
	}
		
		// Photo Collage Custom Option Peginetion
		/*public function custompaginateAction(){
			$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
			$parpage = 5;
			
			$page_num = $this->getRequest()->getParam('page_num');
			if($page_num==''){ $page_num =1;}
			$item_num = $this->getRequest()->getParam('item_num');
			
			if($page_num==1){ $offset=0; } else{ $offset= (($page_num-1)*$item_num); }
			//echo $offset ;	
			
			$pagecount = $this->getRequest()->getParam('show_count')-1;
			$serach_term = $this->getRequest()->getParam('sort_by');
			$sku = "steel-plates";
			$opt_title = "Our Sign Gallery";
			$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
			
			$new_arr=array_slice($product_data, $offset ,$item_num);
			
			//echo "<pre>"; print_r($new_arr); echo "</pre>";
			$custom_content = '<form><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="extensive-collection-product fixed-box">
			<img src="'.$skin_url.'frontend/rwd/default/images/custom_canvas_print/edit-icon.png" alt="Edit Icon">
			<h3>Design Yourself </h3>
			<a href="'.Mage::getBaseUrl().'/liveeditor/index/stellplate" class="button small border">Start Your Design</a> 
			</div>
			</div></form>';
			foreach($new_arr as $key => $canvas_data)
			{
			if(!empty($serach_term) && $canvas_data['category'] != $serach_term){
			continue;
			}
			$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
			$sign_img = $canvas_data['img_url'];
			$custom_content .= '<div class="col-lg-3 extensive-collection-product"><form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'canvas-product/index/steelplate" enctype="form-data" >
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="">
			<div class="top">
			<div class="image">
			<img height="200" width="220" src="'.$media_url.$sign_img.'" alt="extensive collection Product">
			</div>
			<div class="detail">
			<div class="name">'.$canvas_data['option_label'].'</div>
			<span>'.$canvas_data['pro_count'].'</span>
			<div class="price"><strike>'.number_format($canvas_data['initial_price'],2).'</strike> <span>'.number_format($canvas_data['price'],2).'</span></div>
			<input type="hidden" name="custom_option" value=\''.serialize($canvas_data).'\' />
			</div>
			</div>
			<div class="bottom">
			<button type="submit" class="button small blue">Start Sign</button>
			</div>
			</div>
			</div>
			</form>
			<form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'order/index/stelladd" enctype="form-data" >
			<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
			<div class="">
			<input type="hidden" name="custom_option_id" value='.serialize($custom_data).' />                            
			<div class="bottom">
			<button type="submit" class="button small blue">Add To Cart</button>
			</div>
			</div>
			</div>        
			</form>
			</div>';		
			//if($key >= $parpage-1){break;}
			}
			echo $custom_content;
		}*/
		
		/********************************23-11-2017*********************************/
		public function custompaginateAction(){
			$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
			$parpage = 5;
			
			$page_num = $this->getRequest()->getParam('page_num');
			if($page_num==''){ $page_num =1;}
			$item_num = $this->getRequest()->getParam('item_num');
			
			if($page_num==1){ $offset=0; } else{ $offset= (($page_num-1)*$item_num); }
			//echo $offset ;	
			
			$pagecount = $this->getRequest()->getParam('show_count')-1;
			$serach_term = $this->getRequest()->getParam('sort_by');
			$sku = "steel-plates";
			$opt_title = "Our Sign Gallery";
			$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
			
			/*when sort by not empty*/
			
			if($serach_term!=''){
				
				function search($array, $key, $value)
				{
					$results = array();
					
					if (is_array($array)) {
						if (isset($array[$key]) && $array[$key] == $value) {
							$results[] = $array;
						}
						
						foreach ($array as $subarray) {
							$results = array_merge($results, search($subarray, $key, $value));
						}
					}
					
					return $results;
				}
				$key = 'category';
				$sort_value = $serach_term;
				
				$product_data = search($product_data, $key, $sort_value);	
				
				
			}
			/***********************************/
			$total_data = count($product_data);
			
			$new_arr=array_slice($product_data, $offset ,$item_num);
			
			//echo "<pre>"; print_r($new_arr); echo "</pre>";
			$custom_content = '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="extensive-collection-product fixed-box">
			<img src="'.$skin_url.'frontend/rwd/default/images/custom_canvas_print/edit-icon.png" alt="Edit Icon">
			<h3>Design Yourself </h3>
			<a href="'.Mage::getBaseUrl().'/liveeditor/index/stellplate" class="button small border">Start Your Design</a> 
			</div>
			</div>';
			
			foreach($new_arr as $key => $canvas_data)
			{
				/*if(!empty($serach_term) && $canvas_data['category'] != $serach_term){
					continue;
				}*/
				$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
				$sign_img = $canvas_data['img_url'];
				$custom_content .= '<div class="col-lg-3 extensive-collection-product"><form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'canvas-product/index/steelplate" enctype="form-data" >
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="">
				<div class="top">
				<div class="image">
				<img height="200" width="220" src="'.$media_url.$sign_img.'" alt="extensive collection Product">
				</div>
				<div class="detail">
				<div class="name">'.$canvas_data['option_label'].'</div>
				<span>'.$canvas_data['pro_count'].'</span>
				<div class="price"><strike>'.number_format($canvas_data['initial_price'],2).'</strike> <span>'.number_format($canvas_data['price'],2).'</span></div>
				<input type="hidden" name="custom_option" value=\''.serialize($canvas_data).'\' />
				</div>
				</div>';
				if(!empty($canvas_data['template']) )
				{
					$custom_content .='<div class="bottom">
					<button type="submit" class="button small blue">Start Sign</button>
					</div>';
				}	
				$custom_content .='</div></div></form>
				<form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'order/index/stelladd" enctype="form-data" >
				<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
				<div class="">
				<input type="hidden" name="custom_option_id" value='.serialize($custom_data).' />                            
				<div class="bottom">
				<button type="submit" class="button small blue">Add To Cart</button>
				</div>
				</div>
				</div>        
				</form>
				</div>';		
				//if($key >= $parpage-1){break;}
				
			}
			
			
			$pagi = $total_data;
			
			
			
			$rarr = array('pagination'=>$pagi,'res'=>$custom_content);
			echo json_encode($rarr);
			
			
			
			//echo $custom_content;
		}
		
	
	public function photopaginateAction(){
		$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		//$parpage = 12;
		$page_num = $this->getRequest()->getParam('page_num');
			if($page_num==''){ $page_num =1;}
		$item_num = $this->getRequest()->getParam('item_num');
		if($page_num==1){ $offset=0; } else{ $offset= (($page_num-1)*$item_num); }

		$pagecount = $this->getRequest()->getParam('show_count')-1;
		$serach_term = $this->getRequest()->getParam('sort_by');
		$sku = "photo-collage";
		$opt_title = "Photo Gallery";
		$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);

		$custom_content = '';

		/*when sort by not empty*/			
			if($serach_term!=''){				
				function search($array, $key, $value)
				{
					$results = array();					
					if (is_array($array)) {
						if (isset($array[$key]) && $array[$key] == $value) {
							$results[] = $array;
						}						
						foreach ($array as $subarray) {
							$results = array_merge($results, search($subarray, $key, $value));
						}
					}					
					return $results;
				}
				$key = 'category';
				$sort_value = $serach_term;				
				$product_data = search($product_data, $key, $sort_value);
			}
			/***********************************/
			$total_data = count($product_data);
			$new_arr=array_slice($product_data, $offset ,$item_num);

			foreach($new_arr as $key => $canvas_data)
			{
				
			$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
			$sign_img = $canvas_data['img_url'];
			$custom_content .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="extensive-collection-product">
										<div class="top">
											<div class="image">
												<img src="'.$media_url.$sign_img.'" alt="extensive collection Product">
											</div>
											<div class="detail">
												<div class="name">'.$canvas_data['option_label'].'</div>
												<div class="image-count">('.$canvas_data['panel_type'].' image) </div>
												<div class="price">Start at <span>$'.number_format($canvas_data['panel_type'],2).'</span></div>
											</div>
										</div>
										<div class="bottom">
											<a href="#" class="button medium blue upload_modal_button" data-toggle="modal" data-title="'.$canvas_data['default_title'].'" data-image-upload="'.$canvas_data['panel_type'].'" data-target="#photo-uplopad">Upload &amp; Order</a> 
										</div>
									</div>
								</div>';		
			//if($key >= $parpage-1){break;}
		}

		$pagi = $total_data;
		$rarr = array('pagination'=>$pagi,'res'=>$custom_content);
		//$rarr = array('pagination'=>"conete",'res'=>"ghgeh");
		echo json_encode($rarr);
			
		//echo $custom_content;
	}
    
    
    

}//end controller
