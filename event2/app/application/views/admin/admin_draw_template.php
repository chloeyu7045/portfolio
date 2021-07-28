<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $title;?></title>
<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.easing.1.3.js"></script>
 
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
	
}
.button{
	font-family:"微軟正黑體";
	font-size:1.2em;
	padding:5px 10px;
}
#lucky{
	margin-bottom:10px;	
}
#chk-lucky{
	display:none;
}
#lucky table{
	border-top:1px solid #ddd;
	border-left:1px solid #ddd;	
}
#lucky table tr th{
	border-bottom:1px solid #ddd;
	border-right:1px solid #ddd;
	line-height:40px;
}
#lucky table tr td{
	border-bottom:1px solid #ddd;
	border-right:1px solid #ddd;	
	text-align:center;
	padding:5px 0;
}
</style>

</head>
<body>
<h1>抽獎</h1>
<h3>獎項 : <?php echo $stage->gift;?> / 名額 : <?php echo $stage->num;?></h3>


<div id="lucky">
<?php
if($num){
	$response = "";
	$response .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$response .= '<tr><th>姓名</th><th>Email</th><th>電話</th><th>地址</th></tr>';
	foreach($result as $row){
		$response .= '<tr>';
		$response .= '<td>'.$row->name.'</td>';
		
		$response .= '<td>'.$row->email.'</td>';
		$response .= '<td>'.$row->mobile.'</td>';
		$response .= '<td>'.$row->address.'</td>';
		$response .= '</tr>';
		$response .= '<input name="uid[]" type="hidden" class="uid" value="'.$row->uid.'" />';
	}

	$response .= '</table>';
	echo $response;
}
?>
</div>

<?php if(!$num){ ?>
<input type="button" name="draw" id="draw" class="button" value="抽出得獎者" />
<input type="button" name="chk-lucky" id="chk-lucky" class="button" value="確認中獎名單" />
<?php } ?>

<script>
$(function(){
	<?php if($num){ ?>
	$('#lucky table tr:even').css({'background-color' : '#f5f5f5'});
	$('#lucky table tr th').css({'background-color' : '#cccccc'});
	<?php } ?>
	
	$('#draw').click(function(){
		var stid = <?php echo $stage->stid;?>;
		$.ajax({
			url: '<?php echo base_url();?>index.php/admin/draw_user/',
			cache: false,
			dataType: 'html',
			type:'POST',
			timeout: 5000,
			data: { stid:stid},
			beforeSend: function( xhr ) {
				$('#draw').hide();
				$('#chk-lucky').hide();
				$('#lucky').html('<img src="<?php echo base_url();?>images/luck_200x200.gif" />');
				
			},
			error: function(xhr) {
			   
			},
			success: function(response) {
				
				setTimeout(function(){
					$('#lucky').html(response);
					
					$('#lucky table tr:even').css({'background-color' : '#f5f5f5'});
					$('#lucky table tr th').css({'background-color' : '#cccccc'});
					
					$('#draw').val("再抽一次").show();
					$('#chk-lucky').show();
				},2000);
				
			}
		});	
	});
	
	$('#chk-lucky').click(function(){
		var stid = <?php echo $stage->stid;?>;
		var uid = [];
		$(".uid").each(function(index){	uid[index] = $(this).val();	});
		$.ajax({
				url: '<?php echo base_url();?>index.php/admin/lucky/',
				cache: false,
				dataType: 'text',
				type:'POST',
				timeout: 5000,
				data: { stid:stid, uid:uid	},
				error: function(xhr) {				   
				},
				success: function(response) {					
					parent.location.reload(true);
				}
			});
	});
	
});
</script>


</body>
</html>
