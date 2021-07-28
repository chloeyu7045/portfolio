<?php
/**
 * This is just an example of how a file could be processed from the
 * upload script. It should be tailored to your own requirements.
 */

// Only accept files with these extensions
$whitelist = array('jpg', 'jpeg', 'png', 'gif');
$name      = null;
$error     = 'No file uploaded.';

//define('DS', DIRECTORY_SEPARATOR);
//define('UPLOAD', dirname(__FILE__).DS."upload".DS);
/*
//$max_size = 1; //限制可檔案大小為1位元組
$max_size = 2*1024; //限制可檔案大小為2KB
//$max_size = 3*1024*1024; //限制可檔案大小為3MB
//$max_size = 4*1024*1024*1024; //限制可檔案大小為4GB
//解說：1GB=1024MB，1MB=1024KB，1KB=1024位元組-------------------------------

$max_photowidth=500; //設定圖片最大寬度(像素)
$max_photoheight=800; //設定圖片最大高度(像素)
*/
$max_size = 1*1024*1024; //限制可檔案大小為1MB

//新檔名
$possible = "_0123456789"."abcdefghijklmnopqrstuvwxyz"."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$str = ""; 
while(strlen($str) < 3) {$str .= substr($possible, (rand() % strlen($possible)), 1);}

//上傳的檔案欄位名稱 ticket, album1, album2, photo
$files = array("ticket", "album1", "album2", "photo");

if (isset($_FILES)) {
	foreach($files as $file){
		if (isset($_FILES[$file])) {
			
			$tmp_name = $_FILES[$file]['tmp_name'];
			$name     = basename($_FILES[$file]['name']);			
			//$error    = $_FILES[$file]['error'];
			$error = "";
			$size    = $_FILES[$file]['size'];
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			$n=time().$str.".".$extension;
			
			/*
			if ($error === UPLOAD_ERR_OK) {
				if(!in_array($extension, $whitelist)) {
					$error = '檔案格式錯誤.';
				}else{					
					move_uploaded_file($tmp_name, "upload/".$n);
				}
			}else{
				if($error === 1){
					$error = '檔案大小限制 2MB';
				}
			|
			*/
			if(!in_array($extension, $whitelist)) {
				$error = '檔案格式錯誤.';
			}elseif($size > $max_size || $size==0){
				$error = '檔案大小超過 1MB';
			}else{					
				move_uploaded_file($tmp_name, "upload/src/".$n);
				
				$thumbWidth = 300;
				$im = GetImageSize("upload/src/".$n);
				
				switch($im[2]){
					case 1: $img=@imageCreateFromGIF("upload/src/".$n); break;
					case 2: $img=@imageCreateFromJPEG("upload/src/".$n); break;
					case 3: $img=@imageCreateFromPNG("upload/src/".$n); break;
				}
				
				//$img = imagecreatefromjpeg( "upload/src/".$n );
				$width = imagesx( $img );
				$height = imagesy( $img );

				// calculate thumbnail size
				$new_width = $thumbWidth;
				$new_height = floor( $height * ( $thumbWidth / $width ) );

				// create a new temporary image
				$tmp_img = imagecreatetruecolor( $new_width, $new_height );

				// copy and resize old image into new image
				imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

				// save thumbnail into a file
				imagejpeg( $tmp_img, "upload/".$n );
			}
			
			echo json_encode(array(
				'basename' => $name,
				'name'  => $n,
				'error' => $error,
				'file' => $file
			));
			die();
		}
	}
}else{
	echo json_encode(array(
		'basename' => '',
		'name'  => "",
		'error' => "檔案上傳失敗",
		'file' => ""
	));
}
die();
