<?php
$url = 'http://localhost/public_sc/jewlr/file_path/index.php?metal=1&view=1&style=2&stone=1&color=1,2,1';
  

         // create a new cURL resource
          $ch = curl_init();

          // set URL and other appropriate options
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_HEADER, 0);

          // grab URL and pass it to the browser
          curl_exec($ch);

          // close cURL resource, and free up system resources
          curl_close($ch);
?>
