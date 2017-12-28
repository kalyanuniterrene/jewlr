<?php

session_start();

// Script By Kshitij Soni  
//Youtube channel : https://www.youtube.com/channel/UCOWT2JvRnSMVSboxvccZBFQ
//Youtube video (login with instagram) : https://www.youtube.com/watch?v=Hi-wVYiJ5fk

if( isset($_SESSION['user_info']) ){ // check if user is logged in
	header("location: index.php"); // redirect user to index page
	return false;
}

include 'config.php'; // include app info

$_SESSION['login'] = 1;

header("location: https://api.instagram.com/oauth/authorize/?client_id=$client_id&redirect_uri=$redirect_uri&response_type=code&scope=basic"); // redirect user to oauth page

?>