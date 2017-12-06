<?php

/* Author: Shourya Chowdhury
*  Description: Get the All the images from the session id folder 
*/

?>


<?php

$SID = $_POST['session_id'];


$path = realpath('/home/web/public_sc/jewlr/file_path/'.$SID.'/');

$di = new RecursiveIteratorIterator(
new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
RecursiveIteratorIterator::LEAVES_ONLY
);


$image_name = array();

$filename="";

foreach($di as $name => $fio) 
{
	$filename.= $fio->getPath() . DIRECTORY_SEPARATOR .( $fio->getFilename() );


}

echo $filename;