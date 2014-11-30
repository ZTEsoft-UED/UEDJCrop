<?php

$im = imagecreatefromjpeg('1.jpg');
$w = imagesx($im);
$h = imagesy($im);

$green = imagecolorallocate($im,50,100,200);
$str = iconv('gb2312','utf-8','幸福');//解决乱码问题
imagettftext($im,16,0,200,100,$green,'fonts/Gothic720LightBT',$str);

header("content-type: image/png");
imagejpeg($im);
imagedestroy($im);
?> 