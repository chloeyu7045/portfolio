<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>


<style>
body{
	margin:0;
	padding:0;
	font-family:"微軟正黑體", "新細明體";	
	font-size:16px;
	/*background:#0d0619;
	overflow-x:hidden;*/
}
input, label{
	font-family:"微軟正黑體", "新細明體";
	font-size:16px;
	font-weight:bold;
}
label{margin-right:10px;}
#wrap{
	position:relative;
	width:100%;
	height:670px;
	
	overflow:hidden;
}
#login_box{
	position:absolute;
	display:none;
	border:4px solid #333;
	width:300px;
	height:150px;
	right:50px;
	top:300px;
	-webkit-border-radius: 25px;
 	-border-radius: 25px;
	border-radius: 25px;
	box-shadow:6px 6px 6px rgba(15%,15%,15%,0.3);
}
#form{
	color:#333;
	margin:10px;
}
#form h2{
	margin:0;
}
#form>div{line-height:32px;}
#username, #password{width:150px;}
#form span{
	margin-left:5px;
	color:#F00;
	font-size:13px;
	font-weight:normal;
}
#button{
	margin-left:40px;	
	color:#333333;
}

#err{
  color:#F00;
	font-size:13px;
	font-weight:normal;
}

#slogan{
	position:absolute;
	color:#333;
	font-size:18px;
	text-shadow:6px 6px 6px #666;
}

#slogan:hover{
	cursor:pointer;
}
</style>
<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/jquery.validate.min.js" type="text/javascript"></script>
</head>

<body>

<div id="wrap">

<div id="login_box">
<form id="form">
<h2>系統登入</h2>
<div><label for="username">帳號</label><input name="username" type="text" id="username" /></div>
<div><label for="password">密碼</label><input name="password" type="password" id="password" /></div>
<div><input type="submit" name="button" id="button" value="登入" /><span id="err"></span></div>

</form>
</div>

<div id="slogan"><?php echo $slogan;?></div>
  
</div>


<script type="text/javascript"> 
<!--
function tackUp(){
	 $("#slogan").animate({
		//opacity: 1,
		top: "-=3"
		//left: "-=3",
		//width: "28",
		//height: "45"
		}, 500, function() {
		// Animation complete.
		tackDown();
	 });
}
function tackDown(){
	$("#slogan").animate({
		//opacity: 0.9,
		top: "+=3"
		//left: "+=3",
		//width: "22",
		//height: "39"
		}, 500, function() {
		// Animation complete.
		tackUp();
	 });
}

$(document).ready(function() {
	
	$('#wrap').width($(window).width()).height($(window).height());
	
	$("#slogan").offset({
		left:($(window).width()-$("#slogan").width())/2, 
		top:($(window).height()-$("#slogan").height())/2
	});
	
	$("#login_box").offset({ 
		left:($(window).width()-$("#login_box").width())/2, 
		top:($(window).height()-$("#login_box").height())/2
	});
	
	$(window).resize(function(){
		$('#wrap').animate({ 
		left:0,
		top:0,
		width: $(window).width(),
		height:$(window).height()
		}, 100, "easeOutQuad", 
		function() { 
			$("#slogan").animate({ 
				left: ($(window).width()-$("#slogan").width())/2,
				top:($(window).height()-$("#slogan").height())/2
				}, 100, "easeOutQuad");
			
			$("#login_box").animate({ 
				left:($(window).width()-$("#login_box").width())/2, 
				top:($(window).height()-$("#login_box").height())/2
				}, 100, "easeOutQuad");
		
		});
	});
	tackUp();
	
	
	
	
	$("#slogan").click(function(){
		
		$( "#slogan" ).animate({ 
		//left: 0,
		top:250
		}, 1000, "easeOutQuad", 
		function() { 
			$(this).hide();
			$( "#login_box" ).fadeIn();
		
		});
		
	});	
	
	$("#form").validate({
		event: "blur",
		focusCleanup: true,
		rules: {
			username: "required",
			password: "required"
		},
		messages: {
			username: "<span>請輸入帳號</span>",
			password: "<span>請輸入密碼</span>"
		},
		submitHandler: function() {
		
			var username = $('#username').val();
			var password = $('#password').val();
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/chk_login/',
				cache: false,
				dataType: 'html',
				type:'POST',
				timeout: 5000,
				data: { username:username, password:password },
				error: function(xhr) {
				   $('#form').html('Error: '+xhr.status+' '+xhr.statusText);
				},
				success: function(response) {
					
					
					//alert(response);
					//return false;
					// $('#form').html(response);
					if(response=="err"){
						$('#err').html("帳號或密碼有誤");
					}else{
						//window.location.reload();
						location.href='<?php echo base_url();?>index.php/admin/user/';
					}
				}
			});
			
		},
		success: function(label) {
			//
		},
		onkeyup: false
	});

	
});

//-->
</script>

</body>
</html>