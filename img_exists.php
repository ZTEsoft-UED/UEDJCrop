<?php 

header("Content-Type:text/html;charset=UTF-8"); 
$s = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.jpg';
 
	if (file_exists(mb_convert_encoding($s , 'gbk' , 'utf-8'))) { 
 		$ret['result_code']= 3;
        $ret['result_des'] = array(
            "photo"   => str_replace(ROOT_PATH, "", 'uploads/01/'.$_POST['uid'].'.jpg')
        );
	} else {
		$ret['result_code'] =1;  //没有他的记录
	} 
	echo json_encode($ret);

?>