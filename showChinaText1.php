<?php  
/* 
利用php在图片上写字(中英文)
2014-11-29 00:40:40
param $image   图象资源 
param size     字体大小 
param angle    字体输出角度 
param showX    输出位置x坐标 
param showY    输出位置y坐标 
param font    字体文件位置 
param content 要在图片里显示的内容 
*/  

class showChinaText {  
    var $text = 'GYY北京市海淀区香格里拉酒店 香格里拉酒店.'; 
    var $font = 'D:/wamp/www/jCrop/fonts/msyhbd.ttc'; //如果没有要自己加载到相应的目录下 ,本地www,可替换
    var $angle = 0;  
    var $size = 15;  
    var $showX =650;  
    var $showY =510;   
      
    function showChinaText($showText = '') {  
        $this->text = ! isset( $showText ) ? $showText : $this->text;  
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
        //$image = imagecreate(400,300);  
        $image = imagecreatefromjpeg( "avatar_300.jpg" ); //这里是原始图片
        //定义颜色  
        $red = ImageColorAllocate($image, 255, 0, 0 );  
        $white = ImageColorAllocate( $image, 255, 255, 255 );  
        $black = ImageColorAllocate( $image, 0, 0, 0 );  
        //填充颜色  
        // ImageFilledRectangle($image,0,0,200,200,$red);  
        //显示文字  
        $txt = $this->createText( $this->text ); 
        //写入文字  
         imagettftext( $image, $this->size, $this->angle, $this->showX, $this->showX, $white, $this->font, $txt ); 
        //  imageString($image,5,50,10,$txt,$white);  //参数说明：5-指文字的大小。 

        //显示图形  
        imagejpeg( $image );  
        imagegif( $image, "1055.jpg" );   
    }  
}  
?>  

<?php  
  
//调用方式
//	$s = new showChinaText ();  
    ImageDestroy ( $image );  
	exit();
?>