<?php

$im = imagecreatefrompng("img_06264.png");

header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);
