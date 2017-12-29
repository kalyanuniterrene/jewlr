<?php
$session = Mage::getSingleton("core/session");

$p_id = $session->getData("phone_order_product_id_sku");
$p_id = explode('||',$p_id);
$p_id = $p_id[1];
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$all_ranges_array = array('Chilmark','Wardour','Chisbury','Lyneham','Downton','Hamptworth','Elmley','Buttermere','Amesbury','Chirton','Somerton','Langridge','Atworth','Dunsmore','Barrington','Westowe','Foxham','Edington','Burstow','Wilton','Chilmark','Wardour','Chisbury','Lyneham','Downton','Hamptworth','ElmleyButtermere','Amesbury','Chirton','Somerton','Langridge','Atworth','Dunsmore','Barrington','Westowe','Foxham','Edington','Burstow','Wilton');
$all_ranges_string = 'Chilmark-Wardour-Chisbury-Lyneham-Downton-Hamptworth-Elmley-Buttermere-Amesbury-Chirton-Somerton-Langridge-Atworth-Dunsmore-Barrington-Westowe-Foxham-Edington-Burstow-Wilton-Chilmark-Wardour-Chisbury-Lyneham-Downton-Hamptworth-ElmleyButtermere-Amesbury-Chirton-Somerton-Langridge-Atworth-Dunsmore-Barrington-Westowe-Foxham-Edington-Burstow-Wilton';

$phone_product = explode("/",$_SERVER[REQUEST_URI]);foreach($phone_product as $k=>$v){$temp_arr = explode("-",$v);}
		   $u2_PHONEORDER = $temp_arr[1];	
		   $u3_PHONEORDER = $actual_link;
 $product_detail = $u4_PHONEORDER = $session->getData("phone_order_product_id");
		   $u5_PHONEORDER = $session->getData("phone_order_product_new_price");//print_r($u5_PHONEORDER);
		   $u6_PHONEORDER = 1; //default taken as 1 for phone order only.

if($product_detail != ""){
	if(substr_count(strtoupper($all_ranges_string), strtoupper($u2_PHONEORDER))){$u2_PHONEORDER = $u2_PHONEORDER;}else{$u2_PHONEORDER = "[Product Range]";}?>  
	<!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 17. Order by Phone
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/PHONE-ORDER
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=phone0;cat=17ord0;qty=1;cost=[Revenue];u2=<?php echo $u2_PHONEORDER ;?>;u3=<?php echo $u3_PHONEORDER ;?>;u4=<?php echo $p_id ;?>;u5=<?php echo $u5_PHONEORDER ;?>;u6=<?php echo $u6_PHONEORDER ;?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->

	<?php $product_detail = $session->setData("phone_order_product_id", "");} 
		echo '<div id = "floodLightTagopen"></div>'; ?>

<script>
function floodLightTagForBroucheropen(){document.getElementById('floodLightTagopen').innerHTML = '<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=catal0;cat=19cat0;qty=1;cost=[Revenue];u2=[Product Range];u3=<?php echo $actual_link;?>;u4=[Product ID];u5=[Item Price];u6=[No. of Items];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe><!-- End of DoubleClick Floodlight Tag: Please do not remove -->';
	}



function floodLightTagclose(){
	var u3_PHONEORDER = "<?php echo $actual_link ;?>";
	//var u4_PHONEORDER = "<?php echo $session->getData('phone_order_product_id'); ?>"; 
	var u4_PHONEORDER =jQuery('input:hidden[name=product]').val()
	//var u5_PHONEORDER = "<?php echo $session->getData('phone_order_product_old_price'); ?>";
	var u5_PHONEORDER = document.getElementById('product-price-'+u4_PHONEORDER+'_clone').innerHTML.trim();
	var u6_PHONEORDER = 1; //default taken as 1 for phone order only.
	document.getElementById('floodLightTagopen').innerHTML = '<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=callb0;cat=18cal0;qty=1;cost=[Revenue];u2=<?php echo $u2_PHONEORDER ?>;u3='+u3_PHONEORDER+';u4='+u4_PHONEORDER+';u5='+u5_PHONEORDER+';u6='+u6_PHONEORDER+';dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe>';
	}
</script>
