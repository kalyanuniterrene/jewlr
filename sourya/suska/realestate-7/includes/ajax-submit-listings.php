<?php
/**
 * Ajax Submit - Listing Contact Widget
 *
 * @package WP Pro Real Estate 7
 * @subpackage Include
 */

$email=$_POST['email'];
$name=$_POST['name'];
$message=$_POST['message'];
$youremail=$_POST['ctyouremail'];
$subject=$_POST['ctsubject'];
$ctproperty=$_POST['ctproperty'];
$ctpermalink=$_POST['ctpermalink'];
$ctphone=$_POST['ctphone'];

$isValidate = true;

if($isValidate == true){
	$to = "$youremail";
	$subject = "$subject";
	$msg = "$message" . "\n\n" .
	"Phone: $ctphone" . "\n" .
	"Email: $email" . "\n" .
	"Property Address: $ctproperty" . "\n" .
	"Permalink: $ctpermalink" . "\n";
	$headers = "From: $name <$email>" . "\r\n" .
		"Reply-To: $email" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
	mail ($to, $subject, $msg, "From: $name <$email>");
	echo "true";
} else {
	echo '{"jsonValidateReturn":'.json_encode($arrayError).'}';
}
?>