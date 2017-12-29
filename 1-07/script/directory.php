<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
echo $_SERVER['REMOTE_ADDR'];
     if($_SERVER['REMOTE_ADDR']=="123.237.8.112" || $_SERVER['REMOTE_ADDR']=="117.222.74.159" || $_SERVER['REMOTE_ADDR']=="117.217.37.84"  || $_SERVER['REMOTE_ADDR']=="117.208.36.100")
	{ 
		
		mkdir("media/export/Buttermere", 0777);
		//mkdir("media/export/But", 0777);
		//define('DIRECTORY', '/home/dev.willowandhall.co.uk/public_html/media/export/cut');
		
       // $content = file_get_contents('http://www.dev.willowandhall.co.uk/skin/frontend/default/default/images/Craftsmen-nov.png');
		//file_put_contents(DIRECTORY.'/image.png', $content);
  }//remote address
 
?>
