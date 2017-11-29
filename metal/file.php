<?php
/*
* Author: Shourya Chowdhury
* Description: Get the image Content From the Url and show in magento
*/
?>

<?php

//echo "Mr. Hudo";

$url = 'http://localhost/public_sc/jwl-build/index.php?&width=400&height=400&metal=1&style=1&stone=1&color=.1,.1,.5&glow=.05';
 $content = file_get_contents($url);

 echo ($content);

?>