<?php
$base_url = "http".((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "")."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
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
<script src="js/game.js" type="text/javascript"></script>
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
		
		<div id="form-wrap">
			<br /><br /><br /><br />
			<div id="form">
				<div id="form-inner">
					<a href="index.html" id="form-close"><img src="images/pop-close.png" /></a>
					<h1>上傳藝文活動票根、生活照片與心得，製作屬於你的藝文回顧</h1>
					
					<form action="share.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
					
						<div class="row">
							<div class="label">2015年我看過的</div>
							<div class="input"><input type="file" name="ticket" id="ticket" class="upload" alt="請上傳一張相關藝文活動的票根" /><b id="ticket_info">請上傳一張相關藝文活動的票根</b></div>
						</div>
						
						<div class="row row2">
							<div class="label">我喜歡的瞬間<br /><b>長寬比例1:1</b></div>
							<div class="input">
								<input type="file" name="album1" id="album1" class="upload" alt="請上傳第一張照片" /><b id="album1_info">請上傳第一張照片</b><br >
								<input type="file" name="album2" id="album2" class="upload" alt="請上傳第二張照片" /><b id="album2_info">請上傳第二張照片</b>
							</div>
						</div>
						
						<div class="row row3">
							<div class="label">我想說<br /><p><b>請填寫130字內心得</b><br /><b id="msg_info"></b></p></div>
							<div class="input">
								<textarea name="msg" id="msg" class="input2 db" alt="請輸入我想說"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="label">姓名</div>
							<div class="input">
								<input name="name" type="text" id="name" class="input1 db" alt="請輸入姓名" />
							</div>
						</div>
						
						<div class="row">
							<div class="label">大頭貼照片</div>
							<div class="input"><input type="file" name="photo" id="photo" class="upload" alt="請上傳大頭貼照片" /><b id="photo_info"></b></div>
						</div>
						
						<div class="row">
							<div class="label">手機</div>
							<div class="input">
								<input name="mobile" type="text" id="mobile" class="input1 db" alt="請輸入手機" />
							</div>
						</div>
						
						<div class="row last">
							<div class="label">E-MAIL</div>
							<div class="input">
								<input name="email" type="text" id="email" class="input1 db" alt="請輸入E-MAIL" />
							</div>
						</div>
						
						<div class="row-btn">
						<input name="reset" type="reset" id="btn-reset" value="清除重填&rarr;" />
						<input name="submit" type="submit" id="btn-submit" value="確認送出&rarr;" />
						</div>
						
					</form>
					
				</div>
			</div>
		</div><!--//form-wrap-->
		
		
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
	loading("logs_game", 1500);
});
</script>
</body>
</html>
