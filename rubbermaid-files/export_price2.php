<?php
	set_time_limit(0);
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set("display_errors",'On');
	require_once 'app/Mage.php';
	Mage::app('admin');
	$fp = fopen("product_sheet.csv", 'r'); 
	
	$export_file = "miss-price.csv"; // assumes that you're running from the web root. var/ is typically writable
$export = fopen($export_file, 'w') or die("Permissions error."); // open the file for writing.  if you see the error then check the
$output = "sku,price_discounted,price_main\r\n"; // column names. end with a newline.
 fwrite($export, $output); // write the file header with the column names

$output = "";
	
	
	
	$j = 0;
	while(($website=fgetcsv($fp))) 
	{
		if($j==0)
				{
					$j++;
					continue;
						
				}

	$sku=$website[0];
	$spl_price_org=$website[2];
	$price=$website[1];

	//Load the product by sku

	$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
	$product_id = Mage::getModel("catalog/product")->getIdBySku( $sku );
	if($product_id !='')
	{

$output = ""; // re-initialize $output on each iteration
//this code is running under a controllers action method.

		if($spl_price_org<=100)
		{
			$spc_price = $spl_price_org*1.08;//special price is incremented 8%
			
		}

		else
		{
			$spc_price = $spl_price_org*1.06;//special price is incremented 6%
			
		}


		if($_product->getPrice() == $_product->getSpecialPrice())
		{
			//echo $spl_price_org;
			
			$output .= $sku.',';
			$output .= $spc_price.',';
			$output .= $price.',';
			
			$output .= "\r\n"; // add end of line
     //die;
     fwrite($export, $output); // write to the file handle "$export" with the string "$output".
			
		}
		
	}

	$j++;
	if($j==200)
	{
	//exit();
	}
}
	fclose($fp);
?>
