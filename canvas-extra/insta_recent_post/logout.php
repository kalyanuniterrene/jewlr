<?php

session_start();

// Script By Kshitij Soni  
//Youtube channel : https://www.youtube.com/channel/UCOWT2JvRnSMVSboxvccZBFQ
//Youtube video (login with instagram) : https://www.youtube.com/watch?v=Hi-wVYiJ5fk
	
// if user is logged in, destroy all  sessions
if( isset($_SESSION['user_info']) or isset($_SESSION['login']) ){
	echo $_SESSION['login'].'</br>'. $_SESSION['user_info'];
	unset( $_SESSION['user_info'] ); // destroy
	unset( $_SESSION['login'] ); // destroy
	echo "login";

	include 'config.php'; // include app info

	$_SESSION['login'] = 1;

	header("location: https://api.instagram.com/oauth/authorize/?client_id=$client_id&redirect_uri=$redirect_uri&response_type=code&scope=basic"); // redirect user to oauth page

	
	//header("location: login.php"); // redirect user to index page
}

else{ // if user is not logged in
	echo "string";
	//header("location: login.php"); // redirect user to index page
}

?>