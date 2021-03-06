<?php
session_start();

//include 'config.php'; 
 $url = Mage::getBaseDir().'/app/design/frontend/revivalpixel/canvas/template/canvassignages_liveeditor/custom-canvas-print/instagram-uploder.phtml';

$client_id = "38332309453e478ca49c61b589b1e85d"; // enter your client id

$client_secret = "bb985ff88d3648188425e2ae24d21096"; // enter your client secret

$redirect_uri = $url;


function getdarausingcurl($method, $url, $header, $data, $json){
    if( $method == 1 ){
        $method_type = 1; // 1 = POST
    }else{
        $method_type = 0; // 0 = GET
    }
 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    if( $header !== 0 ){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    curl_setopt($curl, CURLOPT_POST, $method_type);
 
    if( $data !== 0 ){
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
 
    $response = curl_exec($curl);

    if( $json == 0 ){
    	$json = $response;
    }else{
    	$json = json_decode($response, true);
    }

    curl_close($curl);
 
    return $json;
}


 if(isset($_GET['code'])){
		$code = $_GET['code'];

		/* Get User Access Token */

		$method = 1; // method = 1, because we want POST method

		$url = "https://api.instagram.com/oauth/access_token";

		$header = 0; // header = 0, because we do not have header

		$data = array(
					"client_id" => $client_id,
					"client_secret" => $client_secret,
					"redirect_uri" => $redirect_uri,
					"grant_type" => "authorization_code",
					"code" => $code
				);

		$json = 1; // json = 1, because we want JSON response

		$get_access_token = getdarausingcurl($method, $url, $header, $data, $json);

		print_r($get_access_token);
		$access_token = $get_access_token['access_token'];

		$get = file_get_contents("https://api.instagram.com/v1/users/self/?access_token=$access_token");

		$json = json_decode($get, true);
		echo "<br>llll";
		echo '<br>'.$_SESSION['user_info'] = $json; // save user info in session
		echo $_SESSION['access_token'] = $access_token;

 }


if( isset($_SESSION['user_info']) ){ // check is user is logged in
	$title = "Logged in as ".$_SESSION['user_info']['data']['full_name']; // page title
	//$title = 0;
 // if user is logged in
		$user_info = $_SESSION['user_info']; // get user info array
		$full_name = $_SESSION['user_info']['data']['full_name']; // get full name
		$username = $_SESSION['user_info']['data']['username']; // get username
		$bio = $_SESSION['user_info']['data']['bio']; // get bio
		$ID = $_SESSION['user_info']['data']['id']; // get bio
		$website = $_SESSION['user_info']['data']['website']; // get bio
		$media_count = $_SESSION['user_info']['data']['counts']['media']; // get media count
		$followers_count = $_SESSION['user_info']['data']['counts']['followed_by']; // get followers
		$following_count = $_SESSION['user_info']['data']['counts']['follows']; // get following
		$profile_picture = $_SESSION['user_info']['data']['profile_picture']; // get profile picture
		?>
		<h2>Welcome <?php echo $full_name; ?>!</h2>
		<p>Your username: <?php echo $username; ?></p>
		<p>Your bio: <?php echo $bio; ?></p>
		<p>Your website: <a href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
		<p>Media count: <?php echo $media_count; ?></p>
		<p>Followers count: <?php echo $followers_count; ?></p>
		<p>Following count: <?php echo $following_count; ?></p>
		<p>Your ID: <?php echo $ID; ?></p>
		<p><img src="<?php echo $profile_picture; ?>"></p>
		<p><a href="logout.php">Logout?</a></p>
		<p><a href="recent.php">Recent post</a></p>
		
		<?php
	}

	else{ // if user is not logged in
		//echo '<a href="login.php">Login With Instagram</a>';
		 $title = "Login With Instagram"; // page title
		 $_SESSION['login'] = 1;

        echo '<a target="_blank" href="https://api.instagram.com/oauth/authorize/?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=basic">Login With Instagram</a>';

	}


	$session_data =  $_SESSION;

	$user_id =  $session_data['user_info']['data']['id'];
	$access_token =  $session_data['access_token'];
	/* Get User popular media  */

	$method = 0; // method = 1, because we want GET method

	$url = "https://api.instagram.com/v1/users/$user_id/media/recent/?access_token=$access_token";

	$header = 0; // header = 0, because we do not have header

	$data = 0; // because we want GET method


	$json = 0; // json = 1, because we want JSON response

	//$json_data  = getdarausingcurl($method, $url, $header, $data, $json);

	//$get_recent_media = json_decode($json_data);

?>

 <div class="container">
    <header class="clearfix">
        <img src="assets/instagram.png" alt="Instagram logo">

        <h1>Instagram <span>recent photos</span></h1>
    </header>
    <div class="main">
       <!--  <ul class="grid">
            <?php
            foreach ($get_recent_media->data as $media) {
                $content = '<li>';
                // output media
                if ($media->type === 'video') {
                    // video
                    $poster = $media->images->low_resolution->url;
                    $source = $media->videos->standard_resolution->url;
                    $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                } else {
                    // image
                    $image = $media->images->low_resolution->url;
                    $content .= "<img class=\"media\" src=\"{$image}\"/>";
                }
                // create meta section
                $avatar = $media->user->profile_picture;
                $username = $media->user->username;
                $comment = (!empty($media->caption->text)) ? $media->caption->text : '';
                $content .= "<div class=\"content\">
                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                           <p>{$username}</p>
                           <div class=\"comment\">{$comment}</div>
                         </div>";
                // output media
                echo $content . '</li>';
            }
            ?>
        </ul> -->
    </div>
</div> 


?>