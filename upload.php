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
    if( !is_dir($targetPath) ){
        mkdir($targetPath,0777,true); 
    }
     if( !is_dir($targetPath2) ){
        mkdir($targetPath2,0777,true);
    }


    $new_file_name = $uid.'.'.$ext;
    $targetFile = $targetPath . $new_file_name;
    move_uploaded_file($tempFile,$targetFile);


    $new_file_name2 = $uid.$uname.'.'.$ext;
    $targetFile2 =  $targetPath2 . $new_file_name2;
    copy($targetFile,$targetFile2);


    if( !file_exists( $targetFile ) ){
        $ret['result_code'] = 0;
        $ret['result_des'] = '上传失败';
    } elseif( !$imginfo=getImageInfo($targetFile) ) {
        $ret['result_code'] = 101;
        $ret['result_des'] = '文件不存在';
    } else {
        $img = 'uploads/01/'.$new_file_name; 
        $img2=  iconv("gb2312","UTF-8",$img) ;
        resize($img);   //图片裁剪
        $ret['result_code'] = 1;
        $ret['result_des'] =  $img;
    }
} else {
    $ret['result_code'] = 100;
    $ret['result_des'] = '没有文件';
}
exit( json_encode( $ret ) ); 