<?php
class Canvassignages_Product_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		
		$datas = Mage::app()->getRequest()->getParams();
		$sku = Mage::app()->getRequest()->getParam('product-sku');
		$color_scale = Mage::app()->getRequest()->getParam('color_scale');
		$param = array();
		foreach($datas as $key => $value){
			if (strpos($key, 'selector') !== FALSE){
				if($value == 'custom'){
					$param['iscustom'] = true;
					$param['ratio'] = $datas['width'].'*'.$datas['height']."<br>";
				} else {
					$param['iscustom'] = false;
					$param['ratio'] = $value;
				}
			} else {
				$param[$key] = $value;
			}
		}
		
		Mage::getSingleton('core/session')->setSku($sku);
		Mage::getSingleton('core/session')->setScale($color_scale);
		
		Mage::getSingleton('core/session')->setRatio($param['ratio']);
		Mage::getSingleton('core/session')->setIscustom($param['iscustom']);
		Mage::getSingleton('core/session')->setCanvastype($param['type']);
		$this->_redirect('liveeditor/index/canvasprint');

    } 
    
    public function addcouponAction()
    {
		if(Mage::helper('checkout/cart')->getItemsQty() <= 0){
			echo "There is no product in the cart";
			return false;
		}
		$applied_coupon = Mage::getSingleton('checkout/session')
             ->getQuote()
             ->getCouponCode();
		$coupon_code = Mage::app()->getRequest()->getParam('coupon');
		if($applied_coupon != $coupon_code){
			Mage::getSingleton("checkout/session")->setData("coupon_code",$coupon_code);
			Mage::getSingleton('checkout/cart')->getQuote()->setCouponCode($coupon_code)->save();
			echo "true";
			return false;
		}else {
			echo "Coupon code already applied";
			return false;
		}		
    }
	
	public function custompriceAction()
    {	
	
		$sku = 'custom-canvas-print'; 
		$opt_title_custom = Mage::app()->getRequest()->getParam('title')." Custom Size";
		$product_data_cus = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title_custom);
		$ratio = Mage::app()->getRequest()->getParam('ratio');
		foreach($product_data_cus as $canvas_data)
		{	
			$canvas_type_option_title = $canvas_data['default_title'];	
			$data_wh = explode('*',$ratio);
			$data_wh_new = explode('*',$canvas_type_option_title);
			
			//echo $canvas_type_option_title."<br/>";
			if( intval($data_wh[0]) == intval($data_wh_new[0]) && intval($data_wh[1]) == intval($data_wh_new[1]) )
			{
				$price = array();
				$price['price'] = number_format((float) $canvas_data['price'], 2, '.', '');
				$price['initial_price'] = number_format((float) $canvas_data['initial_price'], 2, '.', '');
				echo json_encode($price);
			}
		}
    } 
	
	public function steelplateAction(){
		$datas = Mage::app()->getRequest()->getParam('custom_option');
		$params =unserialize($datas);
		Mage::getSingleton('core/session')->setArchiveTitle($params['default_title']);
		//echo Mage::getSingleton('core/session')->getArchiveTitle();
		$this->_redirect('liveeditor/index/steelplate'); 
		
	}
    
    public function walldisplayAction(){
		$datas = Mage::app()->getRequest()->getParam('custom_option');
		$params = unserialize($datas);		
		Mage::getSingleton('core/session')->setWallTitle($params['default_title']);
		Mage::getSingleton('core/session')->setWallTemplate($params['template']);
		Mage::getSingleton('core/session')->setWallPanelType($params['panel_type']);
		Mage::getSingleton('core/session')->setWallPanelSize($params['panelsize']);
		Mage::getSingleton('core/session')->setWallPrice($params['price']);
		$panelsize = explode(',',$params['panelsize']);
		Mage::getSingleton('core/session')->setPanelsize($panelsize);
		$this->_redirect('liveeditor/index/walldisplay');
		//print_r($params);
	}
    
    
    

}
