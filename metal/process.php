<?php
/*
* Description: Main File For Saving the data in the server
* Author: Shourya Chowdhurys
*/
?>

<?php
$data = substr($_POST['imageData'], strpos($_POST['imageData'], ",") + 1);
$decodedData = base64_decode($data);
$fp = fopen("img_06264.png", 'wb');
fwrite($fp, $decodedData);
fclose($fp);

echo "img_06264.png";


?>