ZSmart-UED
==========

��װ�ڲ�ͬ�����ϣ���Ҫ�޸�2���ط���

img_exists.php  :  �ļ��Ա��õ�
$s = 'D:/DedeAMPZ/WebRoot/Default/photo/uploads/01/'.$_POST['uid'].'.jpg'; 

var $font = 'fonts/msyhbd.ttc'; //���û������Ļ���Ҫ�Լ����ص���Ӧ��Ŀ¼�� ,����www,���滻
 

move_uploaded_file($tempFile,$targetFile); //��move_uploaded_file()����ʵ���ļ��ϴ������������������ϴ��ļ��Ĵ�С��

PHP���ļ��ϴ��ܵ�php.ini������Щ���õ�Ӱ��:    ȥphp.ini ����; 

Maximum size of POST data that PHP will accept. 

post_max_size = 10M   //ͨ��post������phpʱ��php���ܽ��ܵ������������ 

; Maximum allowed size for uploaded files. 

upload_max_filesize = 12M /�����ļ��ϴ������� 


memory_limit = 256M  //ÿ��script�������ĵ����memory 
