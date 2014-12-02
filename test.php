
<?php
 
$s = 'C:\Users\Administrator\Pictures\狗.jpg';
var_dump(file_exists(mb_convert_encoding($s , 'gbk' , 'utf-8')));


 $ret['result_code'] = 1;
        $ret['result_des'] = array(
            "photo"   => str_replace(ROOT_PATH, "", $thumbname01)
        );
?>