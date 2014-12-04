<?php 

/*文件对比 是否重复用的*/
header("Content-Type:text/html;charset=UTF-8"); 
$s = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.jpg';
 $s2 = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.jpeg';
$s3 = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.png';

	if (  file_exists(mb_convert_encoding($s , 'gbk' , 'utf-8'))
		||file_exists(mb_convert_encoding($s2 , 'gbk' , 'utf-8')) 
		||file_exists(mb_convert_encoding($s3 , 'gbk' , 'utf-8'))

		) { 
 		$ret['result_code']= 3;
        $ret['result_des'] = array(
            "photo"   => str_replace(ROOT_PATH, "", 'uploads/01/'.$_POST['uid'].'.jpg')
        );
	} else {
		$ret['result_code'] =1;  //没有他的记录
	} 


	echo json_encode($ret);

?>