<?php 

// Script By Kshitij Soni  
//Youtube channel : https://www.youtube.com/channel/UCOWT2JvRnSMVSboxvccZBFQ
//Youtube video (login with instagram) : https://www.youtube.com/watch?v=Hi-wVYiJ5fk

session_start();

if( isset($_SESSION['user_info']) ){ // check is user is logged in
	$title = "Logged in as ".$_SESSION['user_info']['data']['full_name']; // page title
	//$title = 0;
}

else{
	$title = "Login With Instagram"; // page title
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://beta.canvassignages.com/skin/frontend/revivalpixel/canvas/css/canvas_live_editor/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://beta.canvassignages.com/skin/frontend/revivalpixel/canvas/css/canvas_live_editor/custom.css">

	<style>
		 body, html{
       	height: 100%;
       	background: #f4f4f4;
       }
	</style>
</head>
<body>

<?php

	if( isset($_SESSION['user_info']) ){ // if user is logged in
		header("location: http://beta.canvassignages.com/insta_recent_post/recent.php");

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
		<!-- <h2>Welcome <?php echo $full_name; ?>!</h2>
		<p>Your username: <?php echo $username; ?></p>
		<p>Your bio: <?php echo $bio; ?></p>
		<p>Your website: <a href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
		<p>Media count: <?php echo $media_count; ?></p>
		<p>Followers count: <?php echo $followers_count; ?></p>
		<p>Following count: <?php echo $following_count; ?></p>
		<p>Your ID: <?php echo $ID; ?></p>
		<p><img src="<?php echo $profile_picture; ?>"></p>
		<p><a href="logout.php">Logout?</a></p>
		<p><a href="recent.php">Recent post</a></p> -->

		
		<?php
	}

	else{ // if user is not logged in

		echo '<div class="insta_login_area">
		<div class="tab_cell">
			<div class="inner">
				<div class="logo">
					<a href="http://beta.canvassignages.com/">
						<img src="http://beta.canvassignages.com/skin/frontend/rwd/default/images/cs-logo.png" alt="CS">
					</a>
				</div>
                <a href="login.php" class="login_btn"><i class="fa fa-instagram"></i> Login With Instagram</a>

			</div>
		</div>
	</div>';

	}

?>



</body>
</html>