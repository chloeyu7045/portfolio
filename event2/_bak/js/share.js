// JavaScript Document
var upload = [];
var db = [];
$(function(){	
	//$('#btn-share').on('click', postData);
});

function postData(){
	db = [];
	db["err"] = "";	
	
	if(!upload['ticket'] || upload['ticket']==""){
		db["err"] = db["err"] + '\n請上傳一張相關藝文活動的票根';
	}
	if(!upload['album1'] || upload['album1']==""){
		db["err"] = db["err"] + '\n請上傳第一張照片';
	}
	if(!upload['album2'] || upload['album2']==""){
		db["err"] = db["err"] + '\n請上傳第二張照片';
	}
	if(!upload['photo'] || upload['photo']==""){
		db["err"] = db["err"] + '\n請上傳大頭貼照片';
	}
	
	emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;	
	$(".db").each(function(){  
		var input = $(this);
		if( input.val() == "" ){
			db["err"] = db["err"] + '\n' + input.attr('alt');
		}else{
			if(input.attr('id') == 'email'){
				if( input.val().search(emailRule) == -1 ){
					db["err"] = db["err"] + '\n請確認EMAIL格式';					
				}else{
					db[input.attr('id')] = input.val();
				}
			}else{
				db[input.attr('id')] = input.val();
			}
		}
	});  
	
	if( db["err"] == "" ){
		
		/*
		ticket:upload["ticket"], album1:upload["album1"], album2:upload["album2"], photo:upload["photo"],
		msg:db["msg"],name:db["name"], mobile:db["mobile"],
		email:db["email"]
		*/		
		$.ajax({
			url: "img.php",
			beforeSend: function( xhr ) {
				$('#loading').show();
			},
			type: "POST",
			dataType: "json",
			data: {
				ticket:$.cookie("ticket"), album1:$.cookie("album1"), album2:$.cookie("album2"), photo:$.cookie("photo"),
				msg:$.cookie("msg"),name:$.cookie("name"),mobile:$.cookie("mobile"),
				email:$.cookie("email")
			}
		}).done(function(response) {
			  	
				location.href='share.php?id=' + response.id;
				
				
		});
				
	}else{
		alert(db["err"]);
	}
   return false;
}
