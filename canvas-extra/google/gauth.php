<?php
session_start();

require_once('settings.php');
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		//$user_info = $gapi->GetUserProfileInfo($data['access_token']);
		$userDetails = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $data['access_token']);
		$userData = json_decode($userDetails);
		//print_r($userData);						
		if(!empty($userData)) {
		  $googleUserId = '';
		  $googleEmail = '';
		  $googleVerified = '';
		  $googleName = '';
		  $googleUserName = '';
		  if (isset($userData->id)) {
			$googleUserId = $userData->id;
			echo $userData->id;
			echo $path = "https://picasaweb.google.com/data/entry/api/user/107110992844217337532/albumid/5995057042295453697";			$xmlfile = file_get_contents($path);
			$ob= simplexml_load_string($xmlfile);
			echo "<pre>"; print_r($ob);
		  }
		  if (isset($userData->email)) {
			$googleEmail = $userData->email;
			$googleEmailParts = explode("@", $googleEmail);
			$googleUserName = $googleEmailParts[0];
		  }
		  if (isset($userData->verified_email)) {
			echo $googleVerified = $userData->verified_email;
		  }
		  if (isset($userData->name)) {
			echo $googleName = $userData->name;
		  }
		} else {
		  echo "Not logged In";
		}
		/*echo '<pre>';print_r($user_info); echo '</pre>';
		// Now that the user is logged in you may want to start some session variables
		$_SESSION['logged_in'] = 1;
		// You may now want to redirect the user to the home page of your website
		// header('Location: home.php');*/
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>
