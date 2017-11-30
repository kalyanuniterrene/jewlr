<?php
/*
* Author: Shourya Chowdhury
* Description: Get the image Content From the Url and show in magento
*/
?>

<?php

//echo "Mr. Hudo";

$url = 'http://localhost/public_sc/jewlr/file_path/index.php?metal=2&view=1&style=undefined&stone=10&color=2,2,2';
 $content = file_get_contents($url);

 echo ($content);

?>