<?php
/*
* Author: Shourya Chowdhury
* Description: Get the image Content From the Url and show in magento
*/
?>



<?php

//echo "Mr. Hudo";

$url = 'http://localhost/public_sc/jewlr/file_path/index2.php?metal=1&view=1&style=2&stone=1&color=1,1,1';
 $content = file_get_contents($url);

 echo ($content);

?>