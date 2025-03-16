// JavaScript Document
function loading(page, s){
	if( $.cookie(page) == null ){		
		setTimeout(function(){
			$('#loading').fadeOut();
			$.cookie(page, 'true');
			if(page=="logs_index"){				
				start(1000);
			}			
		},s);
	}else{		
		$('#loading').hide();
		if(page=="logs_index"){
			start();
		}
	}
	
	if(page != "logs_game"){
		$.removeCookie('ticket');
		$.removeCookie('album1');
		$.removeCookie('album2');
		$.removeCookie('msg');
		$.removeCookie('name');
		$.removeCookie('photo');
		$.removeCookie('mobile');
		$.removeCookie('email');
	}
}

function start(){
	$('#bg').fadeOut(1000);
	setTimeout(function(){
		$('#index_txt2').animate({'padding-top':60, opacity:1},1000, function(){
			$('#index_txt1_01').animate({'margin-left':0, opacity:1},1000, function(){				
			});
			$('#index_txt1_02').animate({'margin-left':0, opacity:1},1000, function(){
				$('#index_btn').fadeIn();					
			});
		});
	},1000);
	
}

$(function(){
	$('#menu-btn').on('click', function(){
		$('img', this).toggle();
		$('#nav').toggle();
		return false;
	});	
	
	$('.pop-open').on('click', function(){
		$('#popbg').show();
		var id=$(this).attr("id");
		$('#pop-' + id).show();
		$('section').hide();
		return false;
	});	
	
	$('.pop-close').on('click', function(){
		$('#popbg').hide();
		$('.pop').hide();
		$('section').show();
		return false;
	});	
	
	
});

$(window).resize(function(){
	var winW = $(window).width();
	if(winW <= 768){
		$('#menu-btn').show();
		$('#menu-open').show();
		$('#menu-close').hide();
		$('#nav').hide();
	}else{
		$('#menu-btn').hide();
		$('#menu-open').hide();
		$('#menu-close').show();
		$('#nav').show();
	}
});