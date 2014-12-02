ZSmart-UED
==========

安装在不同机器上，需要修改2个地方：

img_exists.php  :  文件对比用的
$s = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.jpg'; 

var $font = 'fonts/msyhbd.ttc'; //如果没有字体的话，要自己加载到相应的目录下 ,本地www,可替换
 

move_uploaded_file($tempFile,$targetFile); //用move_uploaded_file()函数实现文件上传，服务器端限制了上传文件的大小，

PHP的文件上传受到php.ini以下这些设置的影响:    去php.ini 设置; 

Maximum size of POST data that PHP will accept. 

post_max_size = 10M   //通过post方法给php时，php所能接受的最大数据容量 

; Maximum allowed size for uploaded files. 

upload_max_filesize = 12M /允许文件上传最大体积 


memory_limit = 256M  //每个script所能消耗的最大memory 
