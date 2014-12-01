<?php  
/* 
利用php在图片上写字(中英文)

传入 图片和 文字就好。

2014-11-29 00:40:40
param $image   图象资源 
param size     字体大小 
param angle    字体输出角度 
param showX    输出位置x坐标 
param showY    输出位置y坐标 
param font     字体文件位置 
param content  要在图片里显示的内容 
*/  
class showName {  
    var $imgUrl = '1.jpg'; 
    var $text = '名字 - ZTEsoft'; 
    var $font = 'fonts/msyhbd.ttc'; //如果没有要自己加载到相应的目录下 ,本地www,可替换
    var $angle = 0;  
    var $size = 28;  
    var $showX =25;  
    var $showY =1010;   

    var $text2 = '签名 - ZTEsoft'; 
    var $font2 = 'fonts/msyhbd.ttc'; //如果没有要自己加载到相应的目录下 ,本地www,可替换 
      var $size2 = 28;  
    var $angle2 = 0;  
    var $showX2 =180;  
    var $showY2 =1010;   

    function showName($imgUrl='',$showText='',$usign=''){
        $this->imgUrl = isset( $imgUrl ) ? $imgUrl : $this->imgUrl; 
        $this->text   = isset( $showText ) ? $showText.": " : $this->text; 
        $this->text2  = isset( $usign ) ? $usign : $this->text2; 
        $this->show(); 
    }

    function createText($instring) {  
        $outstring = "";  
        $max = strlen( $instring );  
        for($i = 0; $i < $max; $i ++) {  
            $h = ord( $instring [$i] );  
            if ($h >= 160 && $i < $max - 1) {  
                $outstring .= substr( $instring, $i, 2 );  
                $i ++;  
            } else {  
                $outstring .= $instring [$i];  
            }  
        }  
        return $outstring;  
    }  
    function show() {  
        //输出头内容  
       header("Content-type: image/jpg");
        //建立图象  
      //  $image = imagecreate(1500,1050);   
        $image = imagecreatefromjpeg( $this->imgUrl ); //这里是原始图片
        //定义颜色  
        $red   = ImageColorAllocate($image, 255, 0, 0 );  
        $white = ImageColorAllocate( $image, 255, 255, 255 );  
        $black = ImageColorAllocate( $image, 0, 0, 0 );  
        //填充颜色  
         ImageFilledRectangle($image,0,1390, 1500,950,$white);   
        //显示文字  
        $txt = $this->createText( $this->text ); 
        $txt2 = $this->createText ( $this->text2 );  
        //写入文字  
         imagettftext( $image, $this->size, $this->angle, $this->showX, $this->showY, $black, $this->font, $txt ); 
         imagettftext ( $image, $this->size2, $this->angle2, $this->showX2, $this->showY2, $black, $this->font2, $txt2 );    
        //显示图形  //imagejpeg( $image );   
        imagegif( $image, $this->imgUrl);  
        ImageDestroy ( $image ); 
    }  
}  

?>