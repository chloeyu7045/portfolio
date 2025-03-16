// JavaScript Document
var error = "";
$(function(){	
	
	$(".upload").AjaxFileUpload({
		onComplete: function(filename, response) {
			if(!response.error){
				$.cookie(response.file, response.name);
				$("#" + response.file + "_info").html(				
					'<a href="upload/' + response.name + '" rel="gallery1" class="fancybox"><img src="upload/' + response.name + '" /></a>'
				);
			}else{
				$(this).val("");
				alert(response.error);
			}
		}
	});
	
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
	$('#btn-reset').on('click', function(){
		
		$('#ticket_info').text('請上傳一張相關藝文活動的票根');
		$('#album1_info').text('請上傳第一張照片');
		$('#album2_info').text('請上傳第二張照片');
		$('#photo_info').html('');
		
		$(".db").each(function(){  
			var input = $(this);
			input.val("");
		});
		
		$.removeCookie('ticket');
		$.removeCookie('album1');
		$.removeCookie('album2');
		$.removeCookie('msg');
		$.removeCookie('name');
		$.removeCookie('photo');
		$.removeCookie('mobile');
		$.removeCookie('email');
		
	});
	
	var n = $("#msg").val().length;
    $('#msg_info').text('目前 : ' + n + '字');
    $('#msg').on('keydown', function(){
        n = $("#msg").val().length;
        $('#msg_info').text('目前 : ' + n + '字');
    });
    $('#msg').on('click', function(){
        n = $("#msg").val().length;
        $('#msg_info').text('目前 : ' + n + '字');
    });
	
	$(".db").each(function(){  
		var input = $(this);
		input.val("");
	}); 

	$(".upload").each(function(){  
		var input = $(this);
		input.val("");
	});
	
	$('#btn-submit').on('click', postData);
	
	$('#btn-back').on('click', function(){
		$('#form-wrap').show();
		$('.wrap2').hide();
		return false;
	});
	
	init();
	
});

function init(){	
	
	if($.cookie('ticket') && $.cookie('ticket')!=""){
		$("#ticket_info").html(				
			'<a href="upload/' + $.cookie('ticket') + '" rel="gallery1" class="fancybox"><img src="upload/' + $.cookie('ticket') + '" /></a>'
		);
	}
	
	if($.cookie('album1') && $.cookie('album1')!=""){
		$("#album1_info").html(				
			'<a href="upload/' + $.cookie('album1') + '" rel="gallery1" class="fancybox"><img src="upload/' + $.cookie('album1') + '" /></a>'
		);
	}
	
	if($.cookie('album2') && $.cookie('album2')!=""){
		$("#album2_info").html(				
			'<a href="upload/' + $.cookie('album2') + '" rel="gallery1" class="fancybox"><img src="upload/' + $.cookie('album2') + '" /></a>'
		);
	}
	
	if($.cookie('photo') && $.cookie('photo')!=""){
		$("#photo_info").html(				
			'<a href="upload/' + $.cookie('photo') + '" rel="gallery1" class="fancybox"><img src="upload/' + $.cookie('photo') + '" /></a>'
		);
	}
	
	if($.cookie('msg') && $.cookie('msg')!=""){
		$('#msg').val($.cookie('msg'));
	}
	
	if($.cookie('name') && $.cookie('name')!=""){
		$('#name').val($.cookie('name'));
	}
	
	if($.cookie('mobile') && $.cookie('mobile')!=""){
		$('#mobile').val($.cookie('mobile'));
	}
	
	if($.cookie('email') && $.cookie('email')!=""){
		$('#email').val($.cookie('email'));
	}
}

function postData(){
	error = "";	
	
	if(!$.cookie('ticket') || $.cookie('ticket')==""){
		error = error + '\n請上傳一張相關藝文活動的票根';
	}
	if(!$.cookie('album1') || $.cookie('album1')==""){
		error = error + '\n請上傳第一張照片';
	}
	if(!$.cookie('album2') || $.cookie('album2')==""){
		error = error + '\n請上傳第二張照片';
	}
	if(!$.cookie('photo') || $.cookie('photo')==""){
		error = error + '\n請上傳大頭貼照片';	}	

	
	$(".db").each(function(){  
		var input = $(this);
		if( input.val() == "" ){
			error = error + '\n' + input.attr('alt');
		}else{
			if(input.attr('id') == 'email'){
				emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;	
				if( input.val().search(emailRule) == -1 ){
					error = error + '\n請確認EMAIL格式';					
				}else{
					$.cookie(input.attr('id'), input.val());
				}
			}else if(input.attr('id') == 'msg'){
				if( $("#msg").val().length > 130 ){
					error = error + '\n我想說, 請填寫130字內心得';
				}else{
					$.cookie(input.attr('id'), input.val());
				}				
			}else{
				$.cookie(input.attr('id'), input.val());
			}
		}
	});  
	
	if( error == "" ){
		
		$.ajax({
			url: "img.php",
			beforeSend: function( xhr ) {
				$('#loading').show();
			},
			type: "POST",
			dataType: "json",
			data: {
				ticket:$.cookie("ticket"), album1:$.cookie("album1"), album2:$.cookie("album2"), photo:$.cookie("photo"),
				msg:$.cookie("msg"),name:$.cookie("name")
			}
		}).done(function(response) {
				location.href='share.php?id=' + response.id;
				
				
		});
				
		
	}else{
		alert(error);
	}
   return false;
}
