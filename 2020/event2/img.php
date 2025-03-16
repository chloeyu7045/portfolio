<?php
//ini_set('memory_limit', '200M');
if(!isset($_POST["name"]) || $_POST["name"]==""){die();}

function draw_txt_to($card, $pos, $fullstr){ 	  
    $_str_h = $pos["top"];//top距離畫板頂端的距離
    $fontsize = $pos["fontsize"];//fontsize文字的大小
    $width = $pos["width"];//width寬度
    $margin_lift = $pos["left"];//left距離左邊的距離
    $hang_size = $pos["hang_size"];//hang_size行高
	
    $temp_string = "";
    $font_file = "font/wt003.ttf";
    $tp = 0;
	
    $font_color = imagecolorallocate($card, $pos["color"][0], $pos["color"][1], $pos["color"][2]);
	
	$ct=explode("\n", $fullstr);//分段
	
	for($j=0;$j<count($ct);$j++){	
		$str=$ct[$j];
		 
		for ($i = 0; $i < mb_strlen($str); $i++) {
						
			$box = imagettfbbox($fontsize, 0, $font_file, $temp_string);
			$_string_length = $box[2] - $box[0];
			$temptext = mb_substr($str, $i, 1);

			$temp = imagettfbbox($fontsize, 0, $font_file, $temptext);

			if ($_string_length + $temp[2] - $temp[0] < $width) {//長度不夠，字數不夠，需要繼續拼接字符串。
				
				$temp_string .= mb_substr($str, $i, 1, 'utf-8');

				if ($i == mb_strlen($str) - 1) {//是不是最後半行。不滿一行的情況
					$_str_h += $hang_size;//計算整個文字換行後的高度。
					$tp++;//行數
					imagettftext($card, $fontsize, 0, $margin_lift, $_str_h, $font_color, $font_file, $temp_string);
					$temp_string = "";
				}
				
			} else {//一行的字數夠了，長度夠了。

				//打印輸出，對字符串臨時字符串置null
				$texts = mb_substr($str, $i, 1, 'utf-8');//臨時行的開頭第一個字。

				//判斷默認第一個字符是不是符號；
				$isfuhao = preg_match("/[\\\\pP]/u", $texts) ? true : false;//一行的開頭這個字符，是不是標點符號
				if ($isfuhao) {//如果是標點符號，則添加在第一行的結尾
					$temp_string .= $texts;

					//判斷如果是連續兩個字符出現，並且兩個丟失必須放在句末尾的，單獨處理
					$f = mb_substr($str, $i + 1, 1, 'utf-8');
					$fh = preg_match("/[\\\\pP]/u", $f) ? true : false;
					if ($fh) {
						$temp_string .= $f;
						$i++;
					}

				} else {
					$i--;
				}

				$tmp_str_len = mb_strlen($temp_string);
				$s = mb_substr($temp_string, $tmp_str_len-1, 1, 'utf-8');//取零時字符串最後一位字符

					if (is_firstfuhao($s)) {//判斷臨時字符串的最後一個字符是不是可以放在見面
						//講最後一個字符用「_」代替。指針前移動一位。重新取被替換的字符。
						$temp_string=rtrim($temp_string,$s);
						$i--;
					}

				//計算行高，和行數。
				$_str_h += $hang_size;
				$tp++;
				imagettftext($card, $fontsize, 0, $margin_lift, $_str_h, $font_color, $font_file, $temp_string);
				//寫完了改行，置null該行的臨時字符串。
				$temp_string = "";
			}
		}		
	}	
}

function is_firstfuhao($str){
    $fuhaos = array("\"", "“", "'", "<", "《",);
    return in_array($str, $fuhaos);
}

$canvas = imagecreatetruecolor(1280,820);
//設置顏色
$bg = imagecolorallocate($canvas, 255,255,255);//背景色
$te = imagecolorallocate($canvas, 31,24,18);//文字顏色, 36,40,43

$cover="images/cover.png";

//$_POST
/*
echo mb_strlen($name);
exit;
*/
/*
$name = "呂俊儀";
$msg="每天晚上雪梨準時華麗變身，指標建築如雪梨歌劇院、當代藝術館，利用超大型投影技術，創造氣勢磅礴視覺藝術。\n雪梨歌劇院由英國藝術家打造「Lighting of the Sails」，白日如風帆的歌劇院，到了夜晚成為藝術家畫布，自在轉換幾何、菱格、三角圖樣，七彩漸層、斑斕潑墨色彩，真是目不暇給。";
$photo="demo/photo.jpg";
$album1="demo/album1.jpg";
$album2="demo/album2.jpg";
$ticket="demo/ticket2.jpg";
*/
$name = $_POST["name"];
$msg = $_POST["msg"];
$photo = "upload/" . $_POST["photo"];
$album1 = "upload/" . $_POST["album1"];
$album2 = "upload/" . $_POST["album2"];
$ticket = "upload/" . $_POST["ticket"];

$cim = GetImageSize($cover);
$pim = GetImageSize($photo);
$a1im = GetImageSize($album1);
$a2im = GetImageSize($album2);
$tim = GetImageSize($ticket);

switch($cim[2]){
	case 1: $cin=@imageCreateFromGIF($cover); break;
	case 2: $cin=@imageCreateFromJPEG($cover); break;
	case 3: $cin=@imageCreateFromPNG($cover); break;
}
switch($pim[2]){
	case 1: $pin=@imageCreateFromGIF($photo); break;
	case 2: $pin=@imageCreateFromJPEG($photo); break;
	case 3: $pin=@imageCreateFromPNG($photo); break;
}
switch($a1im[2]){
	case 1: $a1in=@imageCreateFromGIF($album1); break;
	case 2: $a1in=@imageCreateFromJPEG($album1); break;
	case 3: $a1in=@imageCreateFromPNG($album1); break;
}
switch($a2im[2]){
	case 1: $a2in=@imageCreateFromGIF($album2); break;
	case 2: $a2in=@imageCreateFromJPEG($album2); break;
	case 3: $a2in=@imageCreateFromPNG($album2); break;
}
switch($tim[2]){
	case 1: $tin=@imageCreateFromGIF($ticket); break;
	case 2: $tin=@imageCreateFromJPEG($ticket); break;
	case 3: $tin=@imageCreateFromPNG($ticket); break;
}

imagecopyresized($canvas, $pin, 76,50,0,0,275,282,$pim[0],$pim[1]);//大頭照
imagecopyresized($canvas, $a1in, 518,200,0,0,272,272,$a1im[0],$a1im[1]);//相片1
imagecopyresized($canvas, $a2in, 356,445,0,0,272,272,$a2im[0],$a2im[1]);//相片2
imagecopy($canvas, $cin, 0,0,0,0,$cim[0],$cim[1]);//封面

/*
//橫式 300 300
if($pim[0] > $pim[1]){
	
	if($tim[0]>300){//假如寬>300
		imagecopyresized($canvas, $tin, 44,377,0,0,300,(300/$tim[0])*$tim[1],$tim[0],$tim[1]);//票根
	}else{//假如寬<=300
		imagecopyresized($canvas, $tin, 44,377,0,0,$tim[0],$tim[1],$tim[0],$tim[1]);
	}
	
	//imagecopyresized($canvas, $tin, 44,377,0,0,300,(300/$tim[0])*$tim[1],$tim[0],$tim[1]);//票根
}
//直式 300 300
if($pim[0] < $pim[1]){
	
	if($tim[1]>300){//假如高>300
		imagecopyresized($canvas, $tin, 44,377,0,0,(300/$tim[1])*$tim[0],300,$tim[0],$tim[1]);//票根
	}else{//假如高<=300
		imagecopyresized($canvas, $tin, 44,377,0,0,$tim[0],$tim[1],$tim[0],$tim[1]);
	}
	
	//imagecopyresized($canvas, $tin, 44,377,0,0,(300/$tim[1])*$tim[0],300,$tim[0],$tim[1]);//票根
}
//1:1 300 300
if($pim[0] == $pim[1]){
	
	if($tim[0]>300){//假如寬>300
		imagecopyresized($canvas, $tin, 44,377,0,0,300,300,$tim[0],$tim[1]);//票根
	}else{//假如寬<=300
		imagecopyresized($canvas, $tin, 44,377,0,0,$tim[0],$tim[1],$tim[0],$tim[1]);
	}
	
	//imagecopyresized($canvas, $tin, 44,377,0,0,300,300,$tim[0],$tim[1]);//票根
}
*/
imagecopyresized($canvas, $tin, 44,377,0,0,$tim[0],$tim[1],$tim[0],$tim[1]);//票根

$namebox = imagettfbbox(13, 0, 'font/DFFN_4.TTC', $name);
$nameBoxW = $namebox[2] - $namebox[0]; //姓名寬
$nameX = 50;
$nameW = 185;
$nameMarginLeft = $nameX + (($nameW-$nameBoxW)/2);
imagettftext($canvas,13,0,$nameMarginLeft,112,$te,'font/DFFN_4.TTC',$name);

$pos['color']=array(31,24,18);
$pos['fontsize']=11;//fontsize文字的大小
$pos['width']=270;//width寬度
$pos['left']=880;//left距離左邊的距離
$pos['top']=58;//距離畫板頂端的距離
$pos['hang_size']=41;//hang_size行高
$string=$msg;
draw_txt_to($canvas, $pos, $string);

//檔名
$possible = "_0123456789"."abcdefghijklmnopqrstuvwxyz"."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$str = ""; 
while(strlen($str) < 3) {$str .= substr($possible, (rand() % strlen($possible)), 1);}
//$filename=time().$str.".jpg";
$filename=time().$str;

//輸出圖像
/*
header('Content-Type: image/jpeg');
imagejpeg($canvas);//輸出圖像到螢幕
*/
imagejpeg($canvas, "share/".$filename.".jpg");//輸出圖像檔案
//echo $filename.".jpg";
//echo $filename;

//生成HTML
$fbname = $_POST["fbname"];
$fp = fopen("tpl_share.html", "r");//只讀打開模板
$str=fread($fp,filesize("tpl_share.html"));//讀取模板中內容
$str= str_replace("{fbname}", $name, $str);
$str= str_replace("{filename}", $filename, $str);
fclose($fp);
$handle=fopen("share/".$filename.".html", "w");
fwrite($handle, $str);
fclose($handle);

echo json_encode(array(
	'id'  => $filename,
	'file' => $filename.".jpg"
));
die();
?>