<?php 
header("Content-Type:text/html;charset=UTF-8"); 

$s = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.jpg';
$s2 = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.jpeg';
$s3 = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.png';
$result1 = @unlink ($s); 
$result2 = @unlink ($s2); 
$result3 = @unlink ($s3); 
if ($result == false) { 
echo '删除图片成功'; 
} else { 
echo '无法删除图片'; 
} 
?> 