<?php
	/***It saves feefo data(score and feedback) into willowandhall database********/
	set_time_limit(0);
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set("display_errors",'On');
	if(substr_count($actual_link,"idaq")>0)
	{

		echo $mage_variable = '/home/new/public_html/app/Mage.php';
		
	}
	else if(substr_count($actual_link,"itaservices")>0)
	{

		$mage_variable = '/home/svaapta/public_html/whnew/app/Mage.php';
	}

	//require_once ($mage_variable);
require_once '../app/Mage.php'; 
	umask(0);
	Mage::app('default');

	Mage::log('start ',null,'feeforeview.log',true);
	//set today's date

	$time = time();
	//set yesterday's date
	$lastTime = $time - 86400*2; // 60*60*24
	echo $from = date('Y-m-d', $lastTime);

	$username='download@willowandhall.co.uk';
	$password='download99';

/*** * Curl url for fetching array data by yesterday date***************************/
	$URL='https://www.feefo.com/feefo/downloadfeedback.jsp?submit=full&logon=download@willowandhall.co.uk&password=download99&updatedsince='.$from.'&showtime=24';
	//$URL='https://www.feefo.com/feefo/downloadfeedback.jsp?submit=full&logon=download@willowandhall.co.uk&password=download99&updatedsince=2016-04-23&showtime=24';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$URL);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
	$result=curl_exec ($ch);
	curl_close ($ch);
	$tmpArr =  explode("\n", $result);
	$headArr =  explode("\t", $tmpArr[0]);
	$i=0;
foreach($tmpArr as $empdata)
{
	if($i==0)
	{
	$i++;
	continue;
	}
	$dataArr =  explode("\t", $empdata);

echo "<pre>";

print_r($dataArr);
die;
	echo " <br/><br/>feedback_date-".	$feedback_date=$dataArr[3];
	echo " <br/>Product Name-".	$pname=str_replace("'", "",$dataArr[5]);
	echo " <br/>service_score-".	$service_score=str_replace("'", "",$dataArr[8]);
	echo " <br/>service_feedback-".	$service_feedback=str_replace("'", "",$dataArr[9]);
	echo " <br/>product_score-".	$product_score=str_replace("'", "",$dataArr[10]);
	echo " <br/>product_feedback-".	$product_feedback=str_replace("'", "",$dataArr[11]);
	$vendor_reply=str_replace("'", "",$dataArr[12]);
	$vendor_reply=str_replace("Service rating :", "",$vendor_reply);
	if($vendor_reply =='""')
	{
		$vendor_reply='';
	}
	echo " <br/>vendor_reply-".$vendor_reply;
	echo " <br/>id-".	$feefo_id=$dataArr[19];
	echo " <br/>sku-".	$sku=$dataArr[13];
	echo " <br/>Mapped sku".$mapped_sku=Mage::app()->getLayout()->getBlockSingleton('feefo/feefo')->sku_mapping($sku);
	echo " <br/>order_ref-".	$order_ref=$dataArr[14];

	Mage::log('per sku foreach---- '.$sku,null,'feeforeview.log',true);
	/**Change product name if they consist corner word in their name***/
	if(substr_count($pname,'Fyfield')!=1 || substr_count($pname,'Cleverton')!=1 || substr_count($pname,'Restrop')!=1 || substr_count($pname,'Milbourne')!=1 || substr_count($pname,'Bisford')!=1 || substr_count($pname,'Semley')!=1)
	echo "<br/> newpname".$pname = str_replace("Corner","Chaise",$pname);
	if(empty($order_ref))
	continue;

	/*Adding The Order Reference*/
	Mage::log('Updating Order #' . $order_ref . ' for product SKU:  ' . $sku, null,'feeforeview.log',true);
	/**Get order details by  order no.(increament_id) from sales_flat_order table**/
	$orderId = Mage::getModel('sales/order')->loadByIncrementId($order_ref)->getEntityId();
	print_r($orderId);
	$order = Mage::getModel('sales/order')->load($orderId);

	// Update all products in the order
	$orderItems = $order->getItemsCollection();
	
	//$ordercollection=Mage::getModel('sales/order')->loadByIncrementId($order_ref);
	// Update all products in the order
	//$orderItems = $ordercollection->getItemsCollection();
	Mage::log('Order Items For Order No '.$order_ref.'----'.$orderItems,null,'feeforeview.log',true);
	//database read adapter
	$read = Mage::getSingleton('core/resource')->getConnection('core_read');
	//database write adapter
	$write = Mage::getSingleton('core/resource')->getConnection('core_write');
	//$orderedItems = $ordercollection->getAllItems();
	//$oid = $ordercollection->getId();//Get oder id
	/*Feefo Data Created At*/
	$created=$order->getFeefoCreatedAt();//0000-00-00 00:00:00
	if($created=="0000-00-00 00:00:00")
	$created=$today;

	foreach($orderItems as $k=>$v)
	{
		echo "<br/>".$v['name'];
		if($v['name'] == $pname || $v['sku'] == $mapped_sku)
		{
			$v->setFeefoId($feefo_id)
			->setFeefoFeedbackdate($feedback_date)
			->setFeefoProductScore($product_score)
			->setFeefoProductFeedback($product_feedback)
			->setFeefoCreatedAt($created)
			->setFeefoUpdatedAt($today);
			$v->save();
		}
	}
	// Update the order itself
	echo " today:".$today=date('Y-m-d H:i:s',time());
	//Update feefo review data in order table
	$data = array('feefo_service_score'=>$service_score,'feefo_service_feedback'=>$service_feedback,'feefo_created_at'=>$created,'feefo_updated_at'=>$today ,'feefo_wh_response'=>$vendor_reply );
	$order->addData($data);
	try 
	{
		Mage::getSingleton('core/session')->setFromSalesForce(true);
		
		// $ordercollection
		//->setId($oid)  // You shoudl have the order object loaded already and ID should be the same
		//->save();
		//$ordercollection->setId($oid)->save();
		$order->save();
		Mage::getSingleton('core/session')->setFromSalesForce(false);
		echo "Data updated successfully.";
		Mage::log('Data updated successfully saved in sales_flat_order for order #'. $order_ref.'-----',null,'feeforeview.log',true);
	}
	 catch (Exception $e)
	{
		echo $e->getMessage();
	}

Mage::log('TNW Dispatch Event Start: IncrementId ('.$order->getId().') and Order ID ('.$order->getRealOrderId().') ',null,'feeforeview.log',true);
	
	Mage::dispatchEvent('tnw_salesforce_order_save', array('order' => $order));

	Mage::log('TNW Dispatch Event End ',null,'feeforeview.log',true);
	//~ Mage::log('TNW Dispatch Event End ',null,'feeforeview.log',true);
	echo "order ".$order->getRealOrderId()." updated";
	$i++;
	
	// if($i==4)
	//	break;
}
	Mage::log('end :  ',null,'feeforeview.log',true);
