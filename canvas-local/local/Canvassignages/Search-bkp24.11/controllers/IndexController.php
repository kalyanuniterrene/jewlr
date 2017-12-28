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
				$opt_title = "Our Sign Gallery";
				$product_data_archive = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
				foreach ($product_data_archive as $product_data_archive) 
				{ 
				 $media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
														
					 $img_url = $product_data_archive['img_url'];
				 if(substr_count(strtolower($canvas_data),strtolower($serach_term))>0 || substr_count(strtolower($product_data_archive['img_url']),strtolower($serach_term))>0 )
				 {
				  $data_source.= ' <li>
									<a href="#">
										<img src="'.$media_url.$img_url.'" alt="Style Image">
										<img class="select-check" src="'.$skin_url.'frontend/rwd/default/images/canvas_live_editor/images/select-check.png" alt="Select Check">
									</a>
								</li>';
				 } 
				}

			}
 
			$data_source.="</ul>";
			echo $data_source;
    } // end action
    
	// Steel Plate Custom option Filter
    public function customsignAction(){
		$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		  
		$serach_term = $this->getRequest()->getParam('sort_by');	
		$sku = "steel-plates";
		$opt_title = "Our Sign Gallery";
		$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
		$custom_content = '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="extensive-collection-product fixed-box">
									<img src="'.$skin_url.'frontend/rwd/default/images/custom_canvas_print/edit-icon.png" alt="Edit Icon">
									<h3>Design Yourself </h3>
									<a href="'.Mage::getBaseUrl().'steel-plates.html" class="button small border">Start Your Design</a> 
								</div>
							</div>';
		foreach($product_data as $canvas_data)
		{
			if(!empty($serach_term) && $canvas_data['category'] != $serach_term){
				continue;
			}
			$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
			$sign_img = $canvas_data['img_url'];
			$custom_content .= '<div class="col-lg-3 extensive-collection-product"> 
									<form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'canvas-product/index/steelplate" enctype="form-data" >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="">
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
											
										</div>
									</div>
								</form>
								<form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'order/index/stelladd" enctype="form-data" >
									<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
									<div class="">
										<input type="hidden" name="custom_option_id" value=\''.serialize($canvas_data).'\' />								
										<div class="bottom">
											<button type="submit" class="button small blue">Add To Cart</button>
										</div>
								</div>
								</div>        
								</form>
								</div>
								';			
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
	public function custompaginateAction(){
		$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		$parpage = 11;
		$pagecount = $this->getRequest()->getParam('show_count')-1;
		$serach_term = $this->getRequest()->getParam('sort_by');
		$sku = "steel-plates";
		$opt_title = "Our Sign Gallery";
		$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
		$custom_content = '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="extensive-collection-product fixed-box">
									<img src="'.$skin_url.'frontend/rwd/default/images/custom_canvas_print/edit-icon.png" alt="Edit Icon">
									<h3>Design Yourself </h3>
									<a href="'.Mage::getBaseUrl().'steel-plates.html" class="button small border">Start Your Design</a> 
								</div>
							</div>';
		foreach(array_slice($product_data, $parpage*$pagecount) as $key => $canvas_data)
		{
			if(!empty($serach_term) && $canvas_data['category'] != $serach_term){
				continue;
			}
			$media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
			$sign_img = $canvas_data['img_url'];
			$custom_content .= '<div class="col-lg-3 extensive-collection-product"> 
									<form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'canvas-product/index/steelplate" enctype="form-data" >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="">
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
										</div>
									</div>
								</form>
								<form method="post" action="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'order/index/stelladd" enctype="form-data" >
									<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
									<div class="">
										<input type="hidden" name="custom_option_id" value=\''.serialize($canvas_data).'\' />								
										<div class="bottom">
											<button type="submit" class="button small blue">Add To Cart</button>
										</div>
								</div>
								</div>        
								</form>
							</div>	
								';		
			if($key >= $parpage-1){break;}
		}
		echo $custom_content;
	}
	
	public function photopaginateAction(){
		$skin_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		$parpage = 12;
		$pagecount = $this->getRequest()->getParam('show_count')-1;
		$serach_term = $this->getRequest()->getParam('sort_by');
		$sku = "photo-collage";
		$opt_title = "Photo Gallery";
		$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
		$custom_content = '';
		foreach(array_slice($product_data, $parpage*$pagecount) as $key => $canvas_data)
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
												<div class="price">Start at <span>$'.number_format($canvas_data['panel_type'],2).'</span></div>
											</div>
										</div>
										<div class="bottom">
											<a href="#" class="button medium blue upload_modal_button" data-toggle="modal" data-title="'.$canvas_data['default_title'].'" data-image-upload="'.$canvas_data['panel_type'].'" data-target="#photo-uplopad">Upload &amp; Order</a> 
										</div>
									</div>
								</div>';		
			if($key >= $parpage-1){break;}
		}
		echo $custom_content;
	}
    
    
    

}//end controller