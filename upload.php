<?php

include 'config.inc.php';

if (!empty($_FILES)) {
     
     $uid = intval( $_REQUEST['uid'] );
     $uname = ( $_REQUEST['uname'] );
     $motto = ( $_REQUEST['motto'] );


    $ext = pathinfo($_FILES['Filedata']['name']);
    $ext = strtolower($ext['extension']);
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath   = ROOT_PATH . 'uploads/01/';
    if( !is_dir($targetPath) ){
        mkdir($targetPath,0777,true);
    }
    $new_file_name = $uid.$uname.'ori.'.$ext;
    $targetFile = $targetPath . $new_file_name;
    move_uploaded_file($tempFile,$targetFile);
    if( !file_exists( $targetFile ) ){
        $ret['result_code'] = 0;
        $ret['result_des'] = '上传失败';
    } elseif( !$imginfo=getImageInfo($targetFile) ) {
        $ret['result_code'] = 101;
        $ret['result_des'] = '文件不存在';
    } else {
        $img = 'uploads/01/'.$new_file_name;
       resize($img);   //图片裁剪
        $ret['result_code'] = 1;
        $ret['result_des'] = $img;
    }
} else {
    $ret['result_code'] = 100;
    $ret['result_des'] = '没有文件';
}
exit( json_encode( $ret ) );