<div id = "all_hidden_prices"></div>
<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5201714"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script><noscript><img src="//bat.bing.com/action/0?ti=5201714&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>

<?php
$all_ranges_array = array('Chilmark','Wardour','Chisbury','Lyneham','Downton','Hamptworth','Elmley','Buttermere','Amesbury','Chirton','Somerton','Langridge','Atworth','Dunsmore','Barrington','Westowe','Foxham','Edington','Burstow','Wilton','Chilmark','Wardour','Chisbury','Lyneham','Downton','Hamptworth','ElmleyButtermere','Amesbury','Chirton','Somerton','Langridge','Atworth','Dunsmore','Barrington','Westowe','Foxham','Edington','Burstow','Wilton');
$all_ranges_string = 'Chilmark-Wardour-Chisbury-Lyneham-Downton-Hamptworth-Elmley-Buttermere-Amesbury-Chirton-Somerton-Langridge-Atworth-Dunsmore-Barrington-Westowe-Foxham-Edington-Burstow-Wilton-Chilmark-Wardour-Chisbury-Lyneham-Downton-Hamptworth-ElmleyButtermere-Amesbury-Chirton-Somerton-Langridge-Atworth-Dunsmore-Barrington-Westowe-Foxham-Edington-Burstow-Wilton';

$session = Mage::getSingleton("core/session");
$session->setData("phone_order_product_new_price", "");
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

/*
	u1=[Search Term] -  Search term used to serach product
	u2=[Product Range] -   Range of the product for example Wilsford
	u3=[Product Page];  URL of page
	u4=[Product ID];  - ID of the product
	u5=[Item Price];  - Price of the product
	u6=[No. of Items] - Number of products in cart/checkout page.

		
*/


if($actual_link == "http://newdev.willowandhall.co.uk/"){
$u3 = "http://newdev.willowandhall.co.uk/";}
else if($actual_link == "http://newdev.willowandhall.co.uk/sofa-beds.html")
{$u3 = "http://newdev.willowandhall.co.uk/sofa-beds.html";}
else if($actual_link == "http://newdev.willowandhall.co.uk/sofas.html")
{$u3 = "http://newdev.willowandhall.co.uk/sofas.html";}
else if($actual_link == "http://newdev.willowandhall.co.uk/armchairs.html")
{$u3 = "http://newdev.willowandhall.co.uk/armchairs.html";}
else if($actual_link == "http://newdev.willowandhall.co.uk/beds-mattresses.html")
{$u3 = "http://newdev.willowandhall.co.uk/beds-mattresses.html";}
else if($actual_link == "http://newdev.willowandhall.co.uk/accessories.html")
{$u3 = "http://newdev.willowandhall.co.uk/accessories.html";}
else if($actual_link == "http://newdev.willowandhall.co.uk/clearance.html")
{$u3 = "http://newdev.willowandhall.co.uk/clearance.html";}
else if($actual_link == "http://newdev.willowandhall.co.uk/shop-by-range.html")
{$u3 = "http://newdev.willowandhall.co.uk/shop-by-range.html";}
else if($actual_link == "http://newdev.willowandhall.co.uk/free-samples")
{$u3 = "http://newdev.willowandhall.co.uk/free-samples";}

else if($actual_link == "http://newdev.willowandhall.co.uk/checkout/cart/")
{

	$u2_checkoutCart = $session->getData("checkout_cart_product_name");
	$u3_checkoutCart = "http://newdev.willowandhall.co.uk/checkout/cart/";
	$u4_checkoutCart = $session->getData("checkout_cart_product_id");
	$u5_checkoutCart = $session->getData("checkout_cart_product_price");
	$u6_checkoutCart = $session->getData("checkout_cart_product_numbers");
}
else if($actual_link == "http://newdev.willowandhall.co.uk/onestepcheckout/")
{
	$u2_checkoutCart = $session->getData("checkout_cart_product_name");
	$u3 = "http://newdev.willowandhall.co.uk/onestepcheckout/";
	$u4_checkoutCart = $session->getData("checkout_cart_product_id");
	$u5_checkoutCart = $session->getData("checkout_cart_product_price");
	$u6_checkoutCart = $session->getData("checkout_cart_product_numbers");
}
else if($actual_link == "http://newdev.willowandhall.co.uk/checkout/onepage/success/")
{$u3 = "http://newdev.willowandhall.co.uk/checkout/onepage/success/";}
//else if($actual_link == "http://newdev.willowandhall.co.uk/customer/account/create/")
//{$u3 = "http://newdev.willowandhall.co.uk/customer/account/create/";}
//else if($actual_link == "http://newdev.willowandhall.co.uk/customer/account/login/")
//{$u3 = "http://newdev.willowandhall.co.uk/customer/account/login/";}
//else if($actual_link == "http://newdev.willowandhall.co.uk/customer/account/")
//{$u3 = "http://newdev.willowandhall.co.uk/customer/account/";}
else if($actual_link == "http://newdev.willowandhall.co.uk/wishlist/")
{
	$u6_wishlist = $session->getData("wishlist_item_qty");
	echo $u5_wishlist = $session->getData("wishlist_item_price");
	$u4_wishlist = $session->getData("wishlist_item_id");
	$u3_wishlist = "http://newdev.willowandhall.co.uk/wishlist/";
	$u2_wishlist = $session->getData("wishlist_item_name");
}
//else if($actual_link == "http://newdev.willowandhall.co.uk/PHONE-ORDER")
//{

//}
else if($actual_link == "http://newdev.willowandhall.co.uk/CALLBACK-CONFIRMATION")
{$u3 = "http://newdev.willowandhall.co.uk/CALLBACK-CONFIRMATION";}
else if($actual_link == "http://newdev.willowandhall.co.uk/CATALOGUE-CONFIRMATION")
{$u3 = "http://newdev.willowandhall.co.uk/CATALOGUE-CONFIRMATION";}
//else if($actual_link == "http://newdev.willowandhall.co.uk/contact-us")
//{$u3 = "http://newdev.willowandhall.co.uk/contact-us";}
//else if($actual_link == "http://newdev.willowandhall.co.uk/showroom")
//{$u3 = "http://newdev.willowandhall.co.uk/showroom";}
else if($actual_link == "http://newdev.willowandhall.co.uk/catalogsearch/result/?q=cart")
{$u1 = "term";}

		   $phone_product = explode("/",$_SERVER[REQUEST_URI]);foreach($phone_product as $k=>$v){$temp_arr = explode("-",$v);}
		   $u2_PHONEORDER = $temp_arr[1];	
		   $u3_PHONEORDER = $actual_link;
 $product_detail = $u4_PHONEORDER = $session->getData("phone_order_product_id");
		   $u5_PHONEORDER = $session->getData("phone_order_product_new_price");
		   $u6_PHONEORDER = 1; //default taken as 1 for phone order only.
 





if($actual_link == "http://newdev.willowandhall.co.uk/"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 01. Homepage
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=01hom0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=01hom0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove --> 
<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/sofa-beds.html"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 02. Product - Sofa Beds
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/sofa-beds.html
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=02pro0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/sofa-beds.html;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=02pro0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/sofas.html"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 03. Product - Sofas
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/sofas.html
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=03pro0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/sofas.html;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=03pro0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/armchairs.html"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 04. Product - Armchair
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/armchairs.html
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=04pro0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/armchairs.html;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=04pro0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/beds-mattresses.html"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 05. Product - Mattress
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/beds-mattresses.html
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=05pro0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/beds-mattresses.html;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=05pro0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/accessories.html"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 06. Product - Accessories
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/accessories.html
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=06pro0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/accessories.html;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=06pro0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/clearance.html"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 07. Product - Clearance
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/clearance.html
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=07pro0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/clearance.html;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=07pro0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/shop-by-range.html"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 08. Shop by Range
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/shop-by-range.html
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=08sho0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/shop-by-range.html;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=08sho0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/free-samples"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 09. Free Samples
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/free-samples
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=09fre0;u2=[Product Range];u3=http://newdev.willowandhall.co.uk/free-samples;u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=09fre0;u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/checkout/cart/"){ 
	$u2 = explode(",",$u2_checkoutCart);//echo "testings";print_r($u2);
	$u3 = $u3_checkoutCart;
	$u4 = explode(",",$u4_checkoutCart);
	$u5 = explode(",",$u5_checkoutCart);
	$u6 = explode(",",$u6_checkoutCart);
	foreach($u4 as $key=>$val){
	$temp = explode(" ",$u2[$key]);if(substr_count($all_ranges_string,$temp[1])){$u2[$key] = $temp[1];}else{$u2[$key] = "[Product Range]";}?> <!--
		Start of DoubleClick Floodlight Tag: Please do not remove
		Activity name of this tag: 10. Basket Page
		URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/checkout/cart/
		This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
		Creation Date: 06/02/2016
		-->
		<script type="text/javascript">
		var u2 = "<?php echo $u2[$key];?>";
		var u3 = "<?php echo $u3;?>";
		var u4 = "<?php echo $u4[$key]?>";
		var u5 = "<?php echo $u5[$key]?>";
		var u6 = "<?php echo $u6[$key]?>";
		var axel = Math.random() + "";
		var a = axel * 10000000000000;
		document.write('<iframe src="https://5688510321.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=10bas0;u2=<?php echo $u2[$key];?>;u3=<?php echo $u3;?>;u4=<?php echo $u4[$key]?>;u5=<?php echo $u5[$key]?>;u6=<?php echo $u6[$key]?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
		
		</script>
		<noscript>
		<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=10bas0;u2=<?php echo $u2[$key];?>;u3=<?php echo $u3;?>;u4=<?php echo $u4[$key]?>;u5=<?php echo $u5[$key]?>;u6=<?php echo $u6[$key]?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
		</noscript>
		<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }}
else if($actual_link == "http://newdev.willowandhall.co.uk/onestepcheckout/"){
	$u2 = explode(",",$u2_checkoutCart);
	$u3 = "http://newdev.willowandhall.co.uk/onestepcheckout/";
	$u4 = explode(",",$u4_checkoutCart);
	$u5 = explode(",",$u5_checkoutCart);
	$u6 = explode(",",$u6_checkoutCart);
	foreach($u4 as $key=>$val){$u5[$key] = (int)$u5[$key] * (int)$u6[$key]; 
	$temp = explode(" ",$u2[$key]);if(substr_count($all_ranges_string,$temp[1])){$u2[$key] = $temp[1];}else{$u2[$key] = "[Product Range]";}?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 11. Checkout Page
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/onestepcheckout/
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var u2 = "<?php echo $u2[$key];?>";
	var u3 = "<?php echo $u3;?>";
	var u4 = "<?php echo $u4[$key]?>";
	var u5 = "<?php echo $u5[$key]?>";
	var u6 = "<?php echo $u6[$key]?>";
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=11che0;u2=<?php echo $u2[$key];?>;u3=<?php echo $u3;?>;u4=<?php echo $u4[$key]?>;u5=<?php echo $u5[$key]?>;u6=<?php echo $u6[$key]?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=11che0;u2=<?php echo  $u2[$key];?>;u3=<?php echo $u3;?>;u4=<?php echo $u4[$key]?>;u5=<?php echo $u5[$key]?>;u6=<?php echo $u6[$key]?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }}
else if($actual_link == "http://newdev.willowandhall.co.uk/checkout/onepage/success/"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 12. Order Confirmation
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/ORDER-CONFIRMATION
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=order0;cat=12ord0;qty=1;cost=[Revenue];u2=[Product Range];u3=http://newdev.willowandhall.co.uk/checkout/onepage/success/;u4=[Product ID];u5=[Item Price];u6=[No. of Items];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/customer/account/create/"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 13. Create Account
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/customer/account/create/
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=13cre0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=13cre0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/customer/account/login/"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 14. Login Page
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/customer/account/login/
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=14log0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=14log0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/customer/account/"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 15. My Account Page
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/MY-ACCOUNT-PAGE
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=15mya0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=15mya0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/wishlist/"){ 
	$u2 = explode(",",$u2_wishlist);
	$u3 = $u3_wishlist;
	$u4 = explode(",",$u4_wishlist);
	$u5 = explode("||",$u5_wishlist);
	$u6 = explode(",",$u6_wishlist);
	foreach($u4 as $key=>$val){ 
	$temp = explode(" ",$u2[$key]);if(substr_count($all_ranges_string,$temp[1])){$u2[$key] = $temp[1];}else{$u2[$key] = "[Product Range]";}?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 16. Wishlist
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/MY-WISHLIST
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var u3 = "<?php echo $u3;?>";
	var u4 = "<?php echo $u4[$key]?>";
	var u5 = "<?php echo $u5[$key]?>";
	var u6 = "<?php echo $u6[$key]?>";
	var axel = Math.random() + "";
	var a = axel * 10000000000000;

	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=16wis0;u2=<?php echo $u2[$key];?>;u3=<?php echo $u3;?>;u4=<?php echo $u4[$key]?>;u5=<?php echo '£'.$u5[$key]?>;u6=<?php echo $u6[$key]?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=16wis0;u2=<?php echo $u2[$key];?>;u3=<?php echo $u3;?>;u4=<?php echo $u4[$key]?>;u5=<?php echo '£'.$u5[$key]?>;u6=<?php echo $u6[$key]?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }}
/*else if($actual_link == "https://www.willowandhall.co.uk/PHONE-ORDER"){ ?>  */
/*else if($product_detail != ""){// echo strtoupper($all_ranges_string);echo strtoupper($u2_PHONEORDER);
if(substr_count(strtoupper($all_ranges_string), strtoupper($u2_PHONEORDER))){$u2_PHONEORDER = $u2_PHONEORDER;}else{$u2_PHONEORDER = "[Product Range]";}?>  
	<!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 17. Order by Phone
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/PHONE-ORDER
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=phone0;cat=17ord0;qty=1;cost=[Revenue];u2=<?php echo $u2_PHONEORDER ;?>;u3=<?php echo $u3_PHONEORDER ;?>;u4=<?php echo $u4_PHONEORDER ;?>;u5=<?php echo $u5_PHONEORDER ;?>;u6=<?php echo $u6_PHONEORDER ;?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->

	<?php $product_detail = $session->setData("phone_order_product_id", "");}
/*else if($actual_link == "http://newdev.willowandhall.co.uk/CALLBACK-CONFIRMATION"){ ?> <?php }*/
/*else if($actual_link == "http://newdev.willowandhall.co.uk/CATALOGUE-CONFIRMATION"){ ?> <?php }*/
else if($actual_link == "http://newdev.willowandhall.co.uk/contact-us"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 20. Contact Us Page
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/contact-us
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=20con0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=20con0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if($actual_link == "http://newdev.willowandhall.co.uk/showroom"){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 21. Showroom Page
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/showroom
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=21sho0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=21sho0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
	<?php }
else if(substr_count($actual_link, "http://newdev.willowandhall.co.uk/catalogsearch/result/")){ ?> <!--
	Start of DoubleClick Floodlight Tag: Please do not remove
	Activity name of this tag: 22. Search Page
	URL of the web page where the tag is expected to be placed: https://www.willowandhall.co.uk/SEARCH-RESULTS
	This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
	Creation Date: 06/02/2016
	-->
	<script type="text/javascript">
	var axel = Math.random() + "";
	var a = axel * 10000000000000;
	var term_data = "<?php echo $_GET['q']; ?>";
	
	document.write("<iframe src='https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=22sea0;u1=<?php echo $_GET["q"]; ?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=" + a + "?' width='1' height='1' frameborder='0' style='display:none'></iframe>");
	</script>
	<noscript>
	<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=willo0;cat=22sea0;u1=<?php echo $_GET["q"]; ?>;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
	</noscript>
	<!-- End of DoubleClick Floodlight Tag: Please do not remove -->
<?php }
/*else{echo '<div id = "floodLightTagopen"></div>';}*/



?>
<script>

var u3_PHONEORDER = "<?php echo $u3_PHONEORDER ;?>";
var u4_PHONEORDER = "<?php echo $u4_PHONEORDER ;?>";
var u5_PHONEORDER = "<?php echo $u5_PHONEORDER ;?>";
var u6_PHONEORDER = "<?php echo $u6_PHONEORDER ;?>";
	/*function floodLightTagopen(){//alert(jQuery('input:hidden[name=product]').val());

	var u3_PHONEORDER = "<?php echo $actual_link ;?>";
	//var u4_PHONEORDER = "<?php echo $session->getData('phone_order_product_id'); ?>"; 
	var u4_PHONEORDER =jQuery('input:hidden[name=product]').val()
	//var u5_PHONEORDER = "<?php echo $session->getData('phone_order_product_old_price'); ?>";
	var u5_PHONEORDER = document.getElementById('product-price-'+u4_PHONEORDER+'_clone').innerHTML.trim();
	var u6_PHONEORDER = 1; //default taken as 1 for phone order only.
	document.getElementById('floodLightTagopen').innerHTML = 'document.write('<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=phone0;cat=17ord0;qty=1;cost=[Revenue];u2=[Product Range];u3='+u3_PHONEORDER+';u4='+u4_PHONEORDER+';u5='+u5_PHONEORDER+';u6='+u6_PHONEORDER+';dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe>')';
	}
	function floodLightTagclose(){
	var u3_PHONEORDER = "<?php echo $actual_link ;?>";
	//var u4_PHONEORDER = "<?php echo $session->getData('phone_order_product_id'); ?>"; 
	var u4_PHONEORDER =jQuery('input:hidden[name=product]').val()
	//var u5_PHONEORDER = "<?php echo $session->getData('phone_order_product_old_price'); ?>";
	var u5_PHONEORDER = document.getElementById('product-price-'+u4_PHONEORDER+'_clone').innerHTML.trim();
	var u6_PHONEORDER = 1; //default taken as 1 for phone order only.
	document.getElementById('floodLightTagopen').innerHTML = '<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=callb0;cat=18cal0;qty=1;cost=[Revenue];u2=[Product Range];u3='+u3_PHONEORDER+';u4='+u4_PHONEORDER+';u5='+u5_PHONEORDER+';u6='+u6_PHONEORDER+';dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe>';
	}
	function floodLightTagForBroucheropen(){alert();document.getElementById('floodLightTagopen').innerHTML = '<iframe src="https://5688510.fls.doubleclick.net/activityi;src=5688510;type=catal0;cat=19cat0;qty=1;cost=[Revenue];u2=[Product Range];u3=[Product Page];u4=[Product ID];u5=[Item Price];u6=[No. of Items];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=[OrderID]?" width="1" height="1" frameborder="0" style="display:none"></iframe>';
	}*/

</script>
