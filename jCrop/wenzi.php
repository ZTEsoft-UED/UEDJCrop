<?php
header("Content-Type:text/html;charset=utf-8");

//1、创建画布
$im = imagecreatetruecolor(300,200);
//新建一个真彩色图像，默认背景是黑色，返回图像标识符。另外还有一个函数 imagecreate 已经不推荐使用。

$red = imagecolorallocate($im,255,0,0);
//2、写字
$str1 = "hello,world";
imagestring($im,25,30,60,$str1,$red);//参数说明：5-指文字的大小。函数 imagestring 不能写中文


//$str2 = iconv("gb2312","utf-8","北京，你早！hello,world");//文件格式为gbk，而这里转为uft-8格式，才能正常输出，否则也为乱码。表示不明
//imagettftext($im,12,rand(0,20),20,100,$red,"simhei.ttf",$str2);
 
//3、输出图像
header("content-type: image/png");
imagepng($im);//输出到页面。如果有第二个参数[,$filename],则表示保存图像
//4、销毁图像，释放内存
imagedestroy($im);
?>
