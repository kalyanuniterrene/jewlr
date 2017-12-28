<?php
 
class Fishpig_Customtabs_Model_Observer
{
	/**
	 * Flag to stop observer executing more than once
	 *
	 * @var static bool
	 */
	static protected $_singletonFlag = false;

	/**
	 * This method will run when the product is saved from the Magento Admin
	 * Use this function to update the product model, process the 
	 * data or anything you like
	 *
	 * @param Varien_Event_Observer $observer
	 */
	public function saveProductTabData(Varien_Event_Observer $observer)
	{
		if (!self::$_singletonFlag) {
			self::$_singletonFlag = true;
			
			$product = $observer->getEvent()->getProduct();
			
			$pro_sku = $product->getSku();
			//die;
		
			try {
				/**
				 * Perform any actions you want here
				 *
				 */
				 $customFieldValue =  $this->_getRequest()->getPost('custom_field');
				 $customFieldValue1 =  $this->_getRequest()->getPost('custom_field1');
				
				//die;
				/**
				 * Uncomment the line below to save the product
				 *
				 */
				    $import_product_sku = str_replace(' ','-',$customFieldValue);
					$import_product_sku = strtolower($import_product_sku);
					//die;
					
					
					if($customFieldValue1=="Steel Plates")
					{
						$productSku = "steel-plates";
					}
					
					if($customFieldValue1=="Custom Canvas Print")
					{
						$productSku = "custom-canvas-print";
					}
					
					 
					$product = Mage::getModel('catalog/product');
					$productId = $product->getIdBySku( $productSku );
					$product = $product->load($productId);
					$obj = Mage::getModel('catalog/product');
					$product = $obj->load($productId);
					$opt1 = "Type 1";
					$arrayOptionOne=array();
					foreach($product->getOptions() as $o)

					{
						echo "<pre>";
						//print_r($o->getData());
						$optionType = $o->getType();
						
						
						   $values = $o->getValues();
						   
						   //print_r($o->getData());
						   
						   //~ if($o->getType() =="drop_down"|| $o->getType() == 'radio')
						   //~ {
							  
							   //~ echo $o->getDefaultTitle();
							   
						   //~ }

								$i = 0;
								$params = array();
								$params['option_title'] = $o->getDefaultTitle();
								$params['option_type'] = $o->getType();
								$params['sort_order'] = $o->getSortOrder();
								foreach ($values as $k => $v) 
								{
									
									//print_r($v->getData());
									
									//die;
									//echo $ipt_title = $v->getTitle();
									
									$params['name'][$i]['title'] =  $v->getTitle();
									$params['name'][$i]['price'] =  $v->getPrice();
									$params['name'][$i]['image'] =  $v->getImage();
									$params['name'][$i]['class'] =  $v->getClass();
									//$params['name'][$i]['class1'] =  $v->getClass1();
									$params['name'][$i]['price_type'] =  $v->getStorePriceType();
									$params['name'][$i]['sort_order'] =  $v->getSortOrder();
									//$arrayOptionOne[$o->getDefaultTitle()][]=array("name"=>$v->getTitle(),"price"=>100,"price_type"=>'fixed',"sort_order"=>1);
									//echo "<br/>";
									//echo $v->getTitle();
									//echo "<br/>";
									$i++;
								}
								$arrayOptionOne[] = $this->getMyOptions($params);

						 
						 
						
					}
/*echo '<pre>'; 
print_r($arrayOptionOne);
echo '</pre>';
echo '==============================================='; */
//die;
 
 
 
 
		if ($customFieldValue1 !="custom_field1") {

			$obj = Mage::getModel('catalog/product');

			$product_id = $obj->getIdBySku($pro_sku);
			$product = $obj->load($product_id);
			$optionInstance = $product->getOptionInstance()->unsetOptions();
			$product->setHasOptions(1);
			foreach($arrayOptionOne as $arrayOption){
			
				$optionInstance->addOption($arrayOption);
			
			}
			$optionInstance->setProduct($product);
			$product->save();
			unset($product);
			echo "Done";
		}
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
	}
	
	function getMyOptions($params = array()){
		$i = 0;
		$optionval = array();
		foreach($params['name'] as $value){
			print_r($value);
			$optionval[] = array(
                'title' => $value['title'],
                'price' => $value['price'],
                'image' => $value['image'],
                'price_type' => $value['price_type'],
                'sort_order' => $value['sort_order']
            );
		}
		/*$optionval = array(
			array(
                'title' => 'Option Value 1',
                'price' =>100,
                'price_type' => 'fixed',
                'sort_order' => '1'
            ),
		); */
		
		return $option = array(
			'title' => $params['option_title'],
			'type' => $params['option_type'], // could be drop_down ,checkbox , multiple
			'is_require' => 1,
			'sort_order' => $params['sort_order'],
			'values' => $optionval
		);
	 
    }
     
	/**
	 * Retrieve the product model
	 *
	 * @return Mage_Catalog_Model_Product $product
	 */
	public function getProduct()
	{
		return Mage::registry('product');
	}
	
    /**
     * Shortcut to getRequest
     *
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }
}
