<?php
session_start(); // 啟用 session

if(isset($_GET['id']) && $_GET['id']!=""){
	if(!isset($_SESSION['share_id']) || $_SESSION['share_id'] != $_GET['id']){
		$_SESSION['share_id'] = $_GET['id'];
	}
}else{
	header("Location: game.php");
	die();
}
$base_url = "http".((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "")."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
/*
echo dirname(__FILE__);

require_once dirname(__FILE__).'/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '470511889817568',
  'app_secret' => '57099c6a5469897297102758aa6f3288',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl($base_url.'login-callback.php');

if (isset($_SESSION['facebook_access_token'])) { 
	
	$fbuid="";
	$fbname="";
	$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	try {
		$response = $fb->get('/me');
		$userNode = $response->getGraphUser();

		$fbuid=$userNode["id"];
		$fbname=$userNode->getName();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		//echo 'Graph returned an error: ' . $e->getMessage();
		
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		//echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}
	
}

//unset($_SESSION['變數名稱']);
//session_destroy();


function isMobile()
{
	$useragent=$_SERVER['HTTP_USER_AGENT'];

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){return true;}else{return false;}
}
*/
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=1280, target-densitydpi=device-dpi, maximum-scale=2.0, user-scalable=yes" />
<meta charset="utf-8">
<title>雪梨‧樂做南半球藝術新質民</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta property="fb:page_id" content="1090821730984681" />
<meta property="og:title" content="雪梨‧樂做南半球藝術新質民"></meta>
<meta property="og:site_name" content="雪梨‧樂做南半球藝術新質民"></meta>
<meta property="og:type" content="website"></meta>
<meta property="og:image" content="<?php echo $base_url;?>images/fb.jpg"></meta>
<meta property="og:description" content=""></meta>
<meta property="og:url" content="<?php echo $base_url;?>"></meta>

<link href="js/libs/fancyBox/jquery.fancybox.css" rel="stylesheet" type="text/css">
<link href="css/tpl.css" rel="stylesheet" type="text/css">
<link href="css/game.css" rel="stylesheet" type="text/css">
<script src="js/libs/jquery.min.js" type="text/javascript"></script>
<script src="js/libs/jquery.cookie.js" type="text/javascript"></script>
<script src="js/libs/jquery.ajaxfileupload.js" type="text/javascript"></script>
<script src="js/libs/fancyBox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script>
var base_url = '<?php echo $base_url;?>';
</script>
<script src="js/tpl.js" type="text/javascript"></script>
<script src="js/share.js" type="text/javascript"></script>
</head>

<body>
<header id="header">
    <div class="wrap">
         <div id="logo"><a href="index.html"><img src="images/logo.jpg" /><img src="images/logo_txt.jpg" /></a></div>
        
        <nav id="nav">
        	<ul>
            	<li><a href="#" class="pop-open" id="rules"><b>活動</b>辦法</a></li><li class="current"><a href="game.php"><b>用藝</b>文票根換機票</a></li><li><a href="vivid.html"><b>文青</b>玩雪梨</a></li><li><a href="" target="_blank"><b>航班</b>資訊</a></li><li class="last"><a href="" target="_blank"><b>產品</b>介紹</a></li>
            </ul>
        </nav>
		
		<a href="#" id="menu-btn"><img src="images/menu.png" id="menu-open" /><img src="images/menu-close.png" id="menu-close" /></a>	
		
    </div>
</header>

<section>
    <div class="wrap">
		<a href="http://www.china-airlines.com/ch/index.html" target="_blank" id="logo2"><img src="images/logo2.png" /></a>
		<a href="#" target="_blank" id="logo3"><img src="images/logo3.png" /></a>		
	</div>
</section>

<section>
    <div class="wrap wrap2">
		<div id="canvas-wrap">
			<div id="canvas"><img src="share/<?php echo $_GET['id'];?>.jpg" /></div>
			<div id="canvas-btn">
				<a href="<?php echo $loginUrl;?>" id="btn-share"><img src="images/btn-share.png" /></a>
				<a href="game.php" id="btn-back"><img src="images/btn-back.png" /></a>
			</div>
		</div>		
	</div>
</section>
<div id="loading"><img src="images/loading.gif" /></div>

<div id="popbg"></div>
<div id="pop-rules" class="pop">
	<img src="images/pop-rules.gif" />
	<a href="#" class="pop-close"><img src="images/pop-close.png" /></a>
</div>
<script>
$(function(){
	loading("logs_game", 0);
});
</script>
</body>
</html>
