<?php
/*
* Description: Main File For Saving the data in the server
* Author: Shourya Chowdhurys
*/
?>

<?php

$view_org = $_POST['view'];

$view = $_POST['view'].".png";


$extra_folder = $_POST['extra_folder'];

$folder_name = $_POST['session_id'];

if (!file_exists("/home/web/public_sc/jewlr/file_path/".$folder_name)) {
    mkdir("/home/web/public_sc/jewlr/file_path/".$folder_name, 0777, true);
}

if (!file_exists("/home/web/public_sc/jewlr/file_path/".$folder_name.'/'.$extra_folder)) {
    mkdir("/home/web/public_sc/jewlr/file_path/".$folder_name.'/'.$extra_folder, 0777, true);
}

$data = substr($_POST['imageData'], strpos($_POST['imageData'], ",") + 1);
$decodedData = base64_decode($data);
/*$fp = fopen($folder_name.'/'.$view , 'w');
fwrite($fp, $decodedData);
fclose($fp);*/

file_put_contents($folder_name.'/'.$extra_folder.'/'.$view, $decodedData);

echo $view_org;


?>