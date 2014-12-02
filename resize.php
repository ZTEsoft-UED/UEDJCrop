<?php
header("Content-Type:text/html;charset=UTF-8");

include 'config.inc.php';
include 'showName.php'; 

if( !$image = $_POST["img"] ){
    $ret['result_code'] = 101;
    $ret['result_des'] = "图片不存在";
} else {
    $image = ROOT_PATH .$image;
    $info = getImageInfo( $image); 
    if( !$info ){
        $ret['result_code'] = 102;
        $ret['result_des'] = "图片不存在";
    } else {
        $x = $_POST["x"];
        $y = $_POST["y"];
        $w = $_POST["w"];
        $h = $_POST["h"];
        $width = $srcWidth = $info['width'];
        $height = $srcHeight = $info['height'];
        $type = empty($type)?$info['type']:$type;
        $type = strtolower($type);
        unset($info);
        // 载入原图
        $createFun = 'imagecreatefrom'.($type=='jpg'?'jpeg':$type);
        $srcImg     = $createFun($image);
        //创建缩略图
        if($type!='gif' && function_exists('imagecreatetruecolor'))
            $thumbImg = imagecreatetruecolor($width, $height);
        else
            $thumbImg = imagecreate($width, $height);
        // 复制图片
        if(function_exists("imagecopyresampled"))
            imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height, $srcWidth,$srcHeight);
        else
            imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height,  $srcWidth,$srcHeight);
        if('gif'==$type || 'png'==$type) {

            $background_color  =  imagecolorallocate($thumbImg,  0,255,0);
            imagecolortransparent($thumbImg,$background_color);
        }
        // 对jpeg图形设置隔行扫描
        if('jpg'==$type || 'jpeg'==$type) 
            imageinterlace($thumbImg,1);
    
        $imageFun = 'image'.($type=='jpg'?'jpeg':$type);
        $thumbname01 = str_replace("ori", "200", $image);
        $imageFun($thumbImg,$thumbname01,100); 
        $thumbImg01 = imagecreatetruecolor(1500,1050);
        imagecopyresampled($thumbImg01,$thumbImg,0,0,$x,$y,1500,1050,$w,$h);
        // 生成图片
        $imageFun($thumbImg01,$thumbname01,100);
        
        $destImg=str_replace(ROOT_PATH, "", $thumbname01);

        new showName ($destImg, $_POST['uname'] ,$_POST['usign'] );   
        imagedestroy($thumbImg01);
        imagedestroy($thumbImg);
        imagedestroy($srcImg);
        $ret['result_code'] = 1;
        $ret['result_des'] = array(
            "photo"   => str_replace(ROOT_PATH, "", $thumbname01)
        );
    }
}
echo json_encode($ret);
exit();