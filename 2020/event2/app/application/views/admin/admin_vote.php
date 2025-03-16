<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $title;?></title>
<?php 
foreach($crud->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($crud->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


<style type='text/css'>
body
{
	font-family:"微軟正黑體";
	font-size: 1em;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 1em;
}
a:hover
{
	text-decoration: underline;
}
h2{
	font-family:"微軟正黑體";
	margin:5px;
}
span.raquo{
	color:#F90;
}
.status1{
	background-color:red;
	color:#FFF;
	-webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
 
    -webkit-box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
    -moz-box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
    box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
 
    -webkit-transition: all 0.15s ease;
    -moz-transition: all 0.15s ease;
    -o-transition: all 0.15s ease;
    -ms-transition: all 0.15s ease;
    transition: all 0.15s ease;
}
.status0{
	background-color:green;
	color:#FFF;
	
	-webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
 
    -webkit-box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
    -moz-box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
    box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
 
    -webkit-transition: all 0.15s ease;
    -moz-transition: all 0.15s ease;
    -o-transition: all 0.15s ease;
    -ms-transition: all 0.15s ease;
    transition: all 0.15s ease;
}
</style>



<script>
function status(f){
	$('.status').on('click', function(){
		var obj = $(this);
		var key=$(this).attr('key');
		var val=$(this).attr('val');
		var op=$(this).attr('op');
		
		$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>index.php/admin/" + f,
		data: { key: key, val: val, op:op }
		})
		.done(function( msg ) {
			//location.reload();
		});
		if(val=='1'){
			$(this).val('通過');
			$(this).attr('val', 0);
			$(this).removeClass('status-1');
			$(this).addClass('status-0');
		}else{
			$(this).val('未通過');
			$(this).attr('val', 1);
			$(this).removeClass('status-0');
			$(this).addClass('status-1');
			
		}
		return false;
	});	
}

function myButton(){
	$('a.status').button().fancybox({
		width: '95%',
		height: '95%',
		onClosed : function(){ 
			//location.reload();
		}
	});
	
	//$('.target-blank').parent().attr("target", "_blank").addClass('iframe fancybox');
}

function myRender(){
	myButton();
	status("change_vote_status");
}

$(function(){
	
	
	myRender();
	
	$(".dataTables_paginate a").click(function(){myRender();});
	$(".dataTables_length").change(function(){myRender();});
	$(".refresh-data").click(function(){myRender();});
	$(".clear-filtering").click(function(){myRender();});
	$(".DataTables_sort_wrapper").click(function(){myRender();});
	$(".dataTables_paginate a").click(function(){myRender();});
	
	$(".groceryCrudTable tfoot input").keyup(function(){myRender();});
	$(".dataTables_filter").keyup(function(){myRender();});

});
</script>
</head>
<body>

<script>
$(function(){
	if( $('a').hasClass('fancybox') ){

		$("a.fancybox").fancybox({
			width: '95%',
			height: '95%'
		});
		
	}
});
</script>

<div id="main_menu">
<div>
	<a href="<?php echo base_url();?>" target="_blank" class="my-button">活動頁面</a> |	
	<a href="<?php echo site_url('admin/user')?>" class="my-button">參與名單</a> | 
	<a href="<?php echo site_url('admin/stage')?>" class="my-button">活動抽獎</a> | 
	<a href="<?php echo site_url('admin/logs')?>" class="my-button">瀏覽記錄</a> | 	
	<a href="<?php echo site_url('admin/logout')?>" class="my-button">登出系統</a>
</div>
<div style='height:20px;'></div> 
</div>
	
<h2><?php echo $h2;?></h2>

	
<div><?php echo $crud->output; ?></div>
</body>
</html>
