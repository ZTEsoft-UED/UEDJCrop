<?php
header("Content-Type:text/html;charset=utf-8");
//路径可以修改为自动获取
define( 'ROOT_PATH', realpath(dirname(__FILE__)).'/' );

function resize( $ori ){
	if( preg_match('/^http:\/\/[a-zA-Z0-9]+/', $ori ) ){
		return $ori;
	}
	$info = getImageInfo( ROOT_PATH . $ori );
	if( $info ){
        //上传图片后切割的最大宽度和高度
		$width = 1500;
		$height =1050;
		$scrimg = ROOT_PATH . $ori;
        if( $info['type']=='jpg' || $info['type']=='jpeg' ){
            $im = imagecreatefromjpeg( $scrimg );
        }
		if( $info['type']=='gif' ){
			$im = imagecreatefromgif( $scrimg );
		}
		if( $info['type']=='png' ){
			$im = imagecreatefrompng( $scrimg );
		}
		if( $info['width']<=$width && $info['height']<=$height ){
			return;
		} else {
			if( $info['width'] > $info['height'] ){
				$height = intval( $info['height']/($info['width']/$width) );
			} else {
				$width = intval( $info['width']/($info['height']/$height) );
			}
		}
		$newimg = imagecreatetruecolor( $width, $height );
		imagecopyresampled( $newimg, $im, 0, 0, 0, 0, $width, $height, $info['width'], $info['height'] );
		imagejpeg( $newimg, ROOT_PATH . $ori );
		imagedestroy( $im );
	}
	return ;
} 

function resize2( $ori2 ){
	if( preg_match('/^http:\/\/[a-zA-Z0-9]+/', $ori2 ) ){
		return $ori2;
	}
	$info2 = getImageinfo( ROOT_PATH . $ori2 );
	if( $info2 ){
        //上传图片后切割的最大宽度和高度
		$width = 900;
		$height =630;
		$scrimg = ROOT_PATH . $ori2;
        if( $info2['type']=='jpg' || $info2['type']=='jpeg' ){
            $im = imagecreatefromjpeg( $scrimg );
        }
		if( $info2['type']=='gif' ){
			$im = imagecreatefromgif( $scrimg );
		}
		if( $info2['type']=='png' ){
			$im = imagecreatefrompng( $scrimg );
		}
		if( $info2['width']<=$width && $info2['height']<=$height ){
			return;
		} else {
			if( $info2['width'] > $info2['height'] ){
				$height = intval( $info2['height']/($info2['width']/$width) );
			} else {
				$width = intval( $info2['width']/($info2['height']/$height) );
			}
		}
		$newimg = imagecreatetruecolor( $width, $height );
		imagecopyresampled( $newimg, $im, 0, 0, 0, 0, $width, $height, $info2['width'], $info2['height'] );
		imagejpeg( $newimg, ROOT_PATH . $ori2 );
		imagedestroy( $im );
	}
	return ;
}

function getImageInfo( $img ){
	$imageinfo = getimagesize($img);
	if( $imageinfo!== false) {
		$imageType = strtolower(substr(image_type_to_extension($imageinfo[2]),1));
		$info = array(
				"width"		=>$imageinfo[0],
				"height"	=>$imageinfo[1],
				"type"		=>$imageType,
				"mime"		=>$imageinfo['mime'],
		);
		return $info;
	}else {
		return false;
	}
}