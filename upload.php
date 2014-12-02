<?php
/*
ZSmart UED 上传照片 Uploadify 后台处理 
Author:markyun
Date:2014-11-28  
*/
 
header("Content-Type:text/html;charset=utf-8"); 
include 'config.inc.php';
 
if (!empty($_FILES)) {
     
     $uid = ( $_REQUEST['uid'] ); 
     $uname  = iconv("UTF-8", "gb2312//IGNORE", $_REQUEST['uname'] );
     $motto = ( $_REQUEST['motto'] ); 

    $ext = pathinfo($_FILES['Filedata']['name']); //上传的临时文件流
    $ext = strtolower($ext['extension']); 

    $tempFile = $_FILES['Filedata']['tmp_name'];
 
    $targetPath   = ROOT_PATH . 'uploads/01/';
    $targetPath2  = ROOT_PATH . 'uploads/yt/';
    $targetPath3  = ROOT_PATH . 'uploads/02/'; //这个用来前台展示用的。

    if( !is_dir($targetPath) ){
        mkdir($targetPath,0777,true); 
    }
    if( !is_dir($targetPath2) ){
        mkdir($targetPath2,0777,true);
    } 
    /*用来截取的*/
    $new_file_name = $uid.'.'.$ext;
    $targetFile = $targetPath . $new_file_name;
    move_uploaded_file($tempFile,$targetFile); //用move_uploaded_file()函数实现文件上传，服务器端限制了上传文件的大小，
    /* PHP的文件上传受到php.ini以下这些设置的影响:    去php.ini 设置; 

    Maximum size of POST data that PHP will accept. 
    post_max_size = 10M   //通过post方法给php时，php所能接受的最大数据容量 

    ; Maximum allowed size for uploaded files. 
    upload_max_filesize = 12M /允许文件上传最大体积 


    memory_limit = 256M  //每个script所能消耗的最大memory 
  
    */

    /*原图*/
    $new_file_name2 = $uid.$uname.'.'.$ext;
    $targetFile2 =  $targetPath2 . $new_file_name2;
    copy($targetFile,$targetFile2);

    /*用来前台显示的*/
    $new_file_name3 = $uid.'.'.$ext;
    $targetFile3 =  $targetPath3 . $new_file_name3;
    copy($targetFile,$targetFile3);


    if( !file_exists( $targetFile ) ){
        $ret['result_code'] = 0;
        $ret['result_des'] = '上传失败';
    } elseif( !$imginfo=getImageInfo($targetFile) ) {
        $ret['result_code'] = 101;
        $ret['result_des'] = '文件不存在';
    } else {
        $img = 'uploads/01/'.$new_file_name; 
        $img2 = 'uploads/02/'.$new_file_name; 
       // $img2=  iconv("gb2312","UTF-8",$img) ;
         resize($img);   //图片裁剪
         resize2($img2);   //图片裁剪2 用于在前台展示用
        $ret['result_code'] = 1;
        $ret['result_des'] =  $img; //大图
        $ret['result_des2'] =  $img2;//小图
    }
} else {
    $ret['result_code'] = 100;
    $ret['result_des'] = '没有文件';
}
exit( json_encode( $ret ) ); 