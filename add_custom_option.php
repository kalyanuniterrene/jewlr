	<?php	
		require_once('app/Mage.php'); //Path to Magento
		umask(0);
		Mage::app();

		$webId = $this->getRequest()->getParam('id');
    	$web = Mage::getSingleton('web/web')->load($webId);
    	//print_r($web->getFilename());

    	 $path = Mage::getBaseDir('media') .'/'. $web->getFilename() ;
		$fp = fopen($path, 'r'); 
 
    	$j=0;

    	$params = array();

    	while(($website=fgetcsv($fp))) 
		{

			if($j == 0)
			{
				$j++;
				continue;
			}
			if($website[2] != '') {
			 $canvas_type_name = $website[2];
			
			 $canvas_label = $website[0];
		
			 $canvas_title = $website[3];
			
			 $initial_price = $website[4];
			
			 $discount_price = $website[6];
			 
			 $id = $website[8];
			 

			 $sku = $website[7];

			    $params['name'][$j]['title'] =  $canvas_title;
				$params['name'][$j]['price'] =  $discount_price;
				$params['name'][$j]['class'] =  $canvas_label;
				$params['name'][$j]['class2'] =  $initial_price;
				
			
			}
					
			$j++;
					
			
		}
		echo "$canvas_type_name <br />";
		$arrayOptionOne[] = $this->getOptions($params,$canvas_type_name);
	
		
		$obj1 = Mage::getModel('catalog/product');

			
			$product1 = $obj1->load($id);
			$optionInstance = $product1->getOptionInstance()->unsetOptions();
			$product1->setHasOptions(1);

			foreach ($product1->getOptions() as $o) {
           				$p = $o->getValues();
           				//print_r($o->getStoreTitle());
           				if($o->getStoreTitle() == $canvas_type_name)
           				{
           					//echo "here";
           				}
        	}


			foreach($arrayOptionOne as $arrayOption){
			
				//$optionInstance->addOption($arrayOption);
			
			}
			//$optionInstance->setProduct($product1);
			$product1->save();
			
			unset($product1);