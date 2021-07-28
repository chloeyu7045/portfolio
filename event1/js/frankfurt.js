// JavaScript Document
var percent = 0;
var currentIndex = 0;
var fbIndex = 1;
var count=0;
var winW = 1024;

function start(){
	
	winW = $(window).width();
	//$('#preload-box div.bar-in').css({width:'100%'});
	setTimeout(function(){
		$('#preload').fadeOut();
	}, 500);
	
	setTimeout(function(){
		$('#bg2').fadeIn();
	}, 1000);
	
	setTimeout(function(){
		if(winW <= 1024){
			$('#airplane').animate({left:'8%', top:'162px', opacity:1}, 3000);
		}else{
			$('#airplane').animate({left:'18.4%', top:'162px', opacity:1}, 3000);
		}
	}, 1500);
	
	setTimeout(function(){
		$('#mark').animate({top:'-32px', opacity:1}, 500, function(){
			$('#title').animate({top:'254px', opacity:1}, 500, function(){});	
		});
	}, 2000);
	
	setTimeout(function(){
		$('#g1').fadeIn();
	}, 3000);
	setTimeout(function(){
		$('#g2').fadeIn();
	}, 3100);
	setTimeout(function(){
		$('#g3').fadeIn();
	}, 3200);
	setTimeout(function(){
		$('#g4').fadeIn();
	}, 3300);
		
		
}

function loading(){
	
	layout();
	var imgCount = $('#preload-img-container > img').length;
	
	//setTimeout(function(){}, 1000);
	$('#preload-img-container').imagesLoaded()
	  .always( function( instance ) {		
		$('#preload-box .txt > span').text('100');		
		submenu();
		start();				
	  })
	  .progress( function( instance, image ) {
		percent = percent + Math.floor( 100/imgCount );
		$('#preload-box > div.txt > span').text(percent);
		//$('#preload-box div.bar-in').css({width:percent + '%'});
	  });
	
}



function layout(){
	winW = $(window).width();
	//$('#preload-box').css({left:((winW-$('#preload-box').width())/2)+120});
	
	$('#mark').css({left:(winW-$('#mark').width())/2});
	$('#title').css({left:(winW-$('#title').width())/2});
	
	$('#popup-close').css({left:((winW-$('#popup-close').width())/2) + 360});
	$('#fb-tag-note').css({left:((winW-$('#fb-tag-note').width())/2) + 230});
	
	$('#popup2').css({left:(winW-$('#popup2').width())/2});
	$('#popup3').css({left:(winW-$('#popup3').width())/2});
	$('#popup4').css({left:(winW-$('#popup4').width())/2});
	$('#popup5').css({left:(winW-$('#popup5').width())/2});
	
	$('#main').show();
}

function submenu(){
	
	var vertic = { duration : 300, easing : 'linear' };
	$('#game-in > a').mouseenter(function(){
		$(this).repeat()
		  .animate({top:'-25px'},vertic)
		  .animate({top:0},vertic).join();
	}).mouseleave(function(){
		$(this).stop(true, true).css({top:0});
	});		
}

function gameLose(){	
	
	$('#popup2-bg').show();
	$('#popup2').show();
	$('.popup2-close').click(function(){
		$('#popup-bg, #popup').hide();
		$('#popup2-bg, #popup2').hide();
		$('.gameWrap').hide();
		return false;	
	});	
	
	$('#popup2-other').click(function(){
		$('.popup').fadeIn();
		$('#title').hide();
		
		$('#popup2-bg').hide();
		$('#popup2').hide();
		
		$('.gameWrap').hide();
		
		var gameID = 'game' + ( Math.floor(Math.random() * 4) + 1 );
		$('#' + gameID).show();
		switch(gameID)
		{
		case 'game1':
			playGame1();
		  break;
		case 'game2':
			playGame2();
		  break;
		case 'game3':
			playGame3();
		  break;
		case 'game4':
			playGame4();
		  break;
		default:
		  
		}
		return false;	
	});
	
	$('#popup2-replay').click(function(){
		$('#popup2-bg').hide();
		$('#popup2').hide();
		switch( $('#thisGame').text() )
		{
		case '1':
			playGame1();
		  break;
		case '2':
			playGame2();
		  break;
		case '3':
			playGame3();
		  break;
		case '4':
			playGame4();
		  break;
		default:
		  
		}
		
		return false;	
	});
}

function playGame1(){
	
	$('#thisGame').text(1);
	
	$('#game1-in, #game1a').show();
	$('#game1a > a').show();
	$('.game1-ans').hide();
	$('#game1b').hide();
	$('#game1b > div').hide();	
	
	currentIndex = Math.floor(Math.random() * 2);//隨機正確解答
	fbIndex = Math.floor(Math.random() * 4);	
	
	$('#game1a > a').eq( currentIndex ).addClass('current');
	
	/*
	$('#game1a > a').click(function(){
		
		var thisIndex = $(this).index();		
		
		setTimeout(function(){
			if( thisIndex == currentIndex ){
				$('.game1-ans').eq( 0 ).show();
			}else{
				$('.game1-ans').eq( 1 ).show();
			}
			
			$('#game1-in, #game1a').hide();			
		}, 250);
		
		
		if( thisIndex == currentIndex ){
			//正確
			setTimeout(function(){
				$('.game1-ans').hide();
				$('#game1b').show();
				$('#game1b > div').eq( fbIndex ).fadeIn();
			}, 1000);
		}else{
			//replay
			setTimeout(function(){
				gameLose();
				return false;
			}, 1000);	
			
		}
		
		return false;
	});
	*/
}

function playGame2(){
	
	$('#thisGame').text(2);
	
	$('#game2-in, #game2a').show();
	$('#game2a > a').show();
	$('#game2a > a > div').hide();
	$('#game2b').hide();
	$('#game2b > div').hide();
	$('#game2a > a').removeClass('current');
	
	count=0;	

	currentIndex = Math.floor(Math.random() * 5);
	fbIndex = Math.floor(Math.random() * 4);	
	
	$('#game2a > a').eq( currentIndex ).addClass('current');
	/*
	$('#game2a > a').click(function(){
		
		$(' > div', this).show();
		var thisIndex = $(this).index();		
		
		setTimeout(function(){
				$('#game2a > a').eq( thisIndex ).fadeOut();
		}, 250);
		
		if( thisIndex != currentIndex ){				
			count += 1;
			alert(count);
		}
		
		if( count == 4 ){
			setTimeout(function(){
				$('#game2-in, #game2a').hide();
				$('#game2b').show();
				$('#game2b > div').eq( fbIndex ).fadeIn();
			}, 500);			
		}
		
		if( thisIndex == currentIndex ){				
			//replay
			setTimeout(function(){
				gameLose();
			}, 1000);	
			return false;
		}	
		
		return false;
	});
	*/
	
}

function playGame3(){
	
	$('#thisGame').text(3);
	
	$('#game3-in, #game3a').show();
	$('#game3a-1').show();
	$('#game3a-2, #game3a-3, .game3-ans').hide();
	$('#game3b').hide();
	$('#game3b > div').hide();
	$('#game3 a').removeClass('selected');
	
	count=0;
	fbIndex = Math.floor(Math.random() * 4);
	
	/*
	$('#game3a-1 a').click(function(){
				
		$(this).addClass('selected');
		if( $(this).hasClass('current') ){
			$('#game3-ans1').show();
			count += 1;
			
		}else{
			$('#game3-ans2').show();
		}
		
		setTimeout(function(){
			$('#game3a-1').hide();
			$('.game3-ans').hide();
			$('#game3a-2').show();
				
		}, 1000);
		
		return false;
	});
	
	$('#game3a-2 a').click(function(){
				
		$(this).addClass('selected');
		if( $(this).hasClass('current') ){
			$('#game3-ans1').show();
			count += 1;
		}else{
			$('#game3-ans2').show();
		}
		
		setTimeout(function(){
			$('#game3a-2').hide();
			$('.game3-ans').hide();
			$('#game3a-3').show();
				
		}, 1000);
		
		return false;
	});
	
	$('#game3a-3 a').click(function(){
				
		$(this).addClass('selected');
		if( $(this).hasClass('current') ){
			$('#game3-ans1').show();
			count += 1;
		}else{
			$('#game3-ans2').show();
		}
		
		setTimeout(function(){
			$('#game3a-3').hide();
			$('.game3-ans').hide();
			
			if(count == 3){
				$('#game3a-3, #game3-in').hide();
				$('#game3b').show();
				$('#game3b > div').eq( fbIndex ).fadeIn();
			}else{
				//replay
				gameLose();
			}
			
		}, 1000);
		
		return false;
	});
	*/
	
}

function playGame4(){
	
	$('#thisGame').text(4);
	
	$('#game4-in, #game4a').show();
	$('.game4-ans').hide();
	$('#game4b').hide();
	$('#game4b > div').hide();	
	$('#game4a-2').css({left:0});
	
	fbIndex = Math.floor(Math.random() * 4);
	
	/*
	$('#game4a-1').click(function(){
		$('#game4-ans1').show();
		setTimeout(function(){
			//replay
			gameLose();
		}, 1000);
		return false;
	});
	$('#game4a-2').click(function(){
		//$('#game4-in').hide();
		$('#game4a-2').animate({left:'+=330px'}, 1500, function(){
			$('#game4-ans2').fadeIn();
		});
		
		setTimeout(function(){
			$('#game4-ans2').hide();
			$('#game4a, #game4-in').hide();
			//$('#game4-in2, #game4b').show();
			$('#game4b').show();
			$('#game4b > div').eq( fbIndex ).fadeIn();
		}, 3500);
		return false;
	});
	$('#game4a-3').click(function(){
		$('#game4-ans3').show();
		setTimeout(function(){
			//replay
			gameLose();
		}, 1000);
		return false;
	});
	*/
}

function onLogin(response) {
  if (response.status == 'connected') {
		
		$('#fbuid').text(response.authResponse.userID);
		FB.api('/me', function(response) {
			$('#fbname').text(response.last_name + response.first_name);
			$('#fbemail').text(response.email);	
			
			//appRequests(response.last_name + response.first_name);
			
		});	
		
		share();
  }
}

function getLoaginStatus(){
	
	FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
		onLogin(response);
	  } else {
		FB.login(function(response) {
		  onLogin(response);
		}, {scope: 'publish_actions, email'});
	  }
	  
	});	
}

function share(){
	
	var url = $('#thisShare').text();
	
	FB.ui({
	  method:'share',
	  href: url
	}, function(response){
		//alert("success");
		formSubmit();
	});	
	
}

function postData(){
	
	var op = 'post';
	
	if ( !$("#form-chk").prop( "checked" ) ) {
		alert('請確認"得獎者提醒"是否巳了解並且選取!');
		return false;
	}
	
	$('#name').removeClass('request');
	$('#mobile').removeClass('request');
	$('#email').removeClass('request');
	$('#address').removeClass('request');
	
	var fbuid = $('#fbuid').text();
	var fbname = $('#fbname').text();
	var fbemail = $('#fbemail').text();
	
	var name = $('#name').val();
	var mobile = $('#mobile').val();
	var email = $('#email').val();
	var address = $('#address').val();
	
	if(name==""){
		$('#name').addClass('request');
		setTimeout((function() { 
			$('#name').removeClass('request');
		}), 1000);
	}
	if(mobile==""){
		$('#mobile').addClass('request');
		setTimeout((function() { 
			$('#mobile').removeClass('request');
		}), 1000);
	}
	if(address==""){
		$('#address').addClass('request');
		setTimeout((function() { 
			$('#address').removeClass('request');
		}), 1000);
	}
	
	//Regular expression Testing  
	emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/; 
	
	if( email=="" || email.search(emailRule) == -1 ){
		$('#email').addClass('request');
		setTimeout((function() { 
			$('#email').removeClass('request');
		}), 1000);
	}
	
	if( name!="" && mobile!="" && (email!="" && email.search(emailRule) != -1) && address!="" ){
		/*
		$.ajax({
			url: base_url + "index.php/page/post_data/",
			 beforeSend: function( xhr ) {
				//$('#popup-bg').show();
			},
			type: "POST",
			data: {op:op, fbuid:fbuid, fbname:fbname, fbemail:fbemail, name:name, mobile:mobile, email:email, address:address, u1:u1, u2:u2, u3:u3}
		}).done(function(response) {
			
			
			if(response == "success"){				
				$('#breadcrumb ul li:eq(5)').addClass('active');
				$('#step4').hide();
				$('#popup-bg').hide();
				$('#step1').hide();
				$('#step5').show();
			}else{
				$('#breadcrumb ul li:eq(5)').addClass('active');
				$('#step4').hide();
				$('#popup-bg').hide();
				$('#step1').hide();
				$('#step5').show();
			}
			
		});
		*/
		alert('資料巳送出, 感謝您的參與, 祝您中獎!');
		setTimeout((function() { 
			$('#popup2-bg').hide();
			$('#popup3').hide();
			$('.popup, .gameWrap, #fb-tag-note').hide();
			$('#title').show();
		}), 1000);
	}
	
}

$(function(){
	
	loading();
	  
  	$('#game-in > a').click(function(){
		$('.popup').fadeIn();
		$('#title').hide();
		var gameID = $(this).attr('class');
		$('#' + gameID).show();
		switch(gameID)
		{
		case 'game1':
			playGame1();
		  break;
		case 'game2':
			playGame2();
		  break;
		case 'game3':
			playGame3();
		  break;
		case 'game4':
			playGame4();
		  break;
		default:
		  
		}
		return false;	
	});
	
	$('#m1').click(function(){
		$('#popup2-bg').fadeIn();
		$('#popup4').fadeIn();
		return false;
	});
	$('.popup4-close').click(function(){
		$('#popup2-bg').hide();
		$('#popup4').hide();
		return false;
	});
	
	$('#m3').click(function(){
		$('#popup2-bg').fadeIn();
		$('#popup5').fadeIn();
		return false;
	});
	$('.popup5-close').click(function(){
		$('#popup2-bg').hide();
		$('#popup5').hide();
		return false;
	});
	
	
	
	$('#m2').click(function(){
		
		$('.popup').fadeIn();
		$('#title').hide();
		
		$('.gameWrap').hide();

		var gameID = 'game' + ( Math.floor(Math.random() * 4) + 1 );

		$('#' + gameID).show();
		switch(gameID)
		{
		case 'game1':
			playGame1();
		  break;
		case 'game2':
			playGame2();
		  break;
		case 'game3':
			playGame3();
		  break;
		case 'game4':
			playGame4();
		  break;
		default:
		  
		}
		return false;	
	});
  
	
	
	//game1
	$('#game1a > a').click(function(){
		
		var thisIndex = $(this).index();		
		
		setTimeout(function(){
			if( thisIndex == currentIndex ){
				$('.game1-ans').eq( 0 ).show();
			}else{
				$('.game1-ans').eq( 1 ).show();
			}
			
			$('#game1-in, #game1a').hide();			
		}, 250);
		
		
		if( thisIndex == currentIndex ){
			//正確
			setTimeout(function(){
				$('.game1-ans').hide();
				$('#game1b, #fb-tag-note').show();
				$('#game1b > div').eq( fbIndex ).fadeIn();
			}, 1000);
		}else{
			//replay
			setTimeout(function(){
				gameLose();
				return false;
			}, 1000);	
			
		}
		
		return false;
	});
	
	//game2
	$('#game2a > a').click(function(){
		
		$(' > div', this).show();
		var thisIndex = $(this).index();		
		
		setTimeout(function(){
				$('#game2a > a').eq( thisIndex ).fadeOut();
		}, 250);
		
		if( thisIndex != currentIndex ){				
			count += 1;
			//alert(count);
		}
		
		if( count == 4 ){
			setTimeout(function(){
				$('#game2-in, #game2a').hide();
				$('#game2b, #fb-tag-note').show();
				$('#game2b > div').eq( fbIndex ).fadeIn();
			}, 500);			
		}
		
		if( thisIndex == currentIndex ){				
			//replay
			setTimeout(function(){
				gameLose();
			}, 1000);	
			return false;
		}	
		
		return false;
	});
	
	//game3
	$('#game3a-1 a').click(function(){
				
		$(this).addClass('selected');
		if( $(this).hasClass('current') ){
			$('#game3-ans1').show();
			count += 1;
			
		}else{
			$('#game3-ans2').show();
		}
		
		setTimeout(function(){
			$('#game3a-1').hide();
			$('.game3-ans').hide();
			$('#game3a-2').show();
				
		}, 800);
		
		return false;
	});
	
	$('#game3a-2 a').click(function(){
				
		$(this).addClass('selected');
		if( $(this).hasClass('current') ){
			$('#game3-ans1').show();
			count += 1;
		}else{
			$('#game3-ans2').show();
		}
		
		setTimeout(function(){
			$('#game3a-2').hide();
			$('.game3-ans').hide();
			$('#game3a-3').show();
				
		}, 800);
		
		return false;
	});
	
	$('#game3a-3 a').click(function(){
				
		$(this).addClass('selected');
		if( $(this).hasClass('current') ){
			$('#game3-ans1').show();
			count += 1;
		}else{
			$('#game3-ans2').show();
		}
		
		setTimeout(function(){
			$('#game3a-3').hide();
			$('.game3-ans').hide();
			
			if(count == 3){
				$('#game3a-3, #game3-in').hide();
				$('#game3b, #fb-tag-note').show();
				$('#game3b > div').eq( fbIndex ).fadeIn();
				
			}else{
				//replay
				gameLose();
			}
			
		}, 800);
		
		return false;
	});
	
	//game4
	$('#game4a-1').click(function(){
		$('#game4-ans1').show();
		setTimeout(function(){
			//replay
			gameLose();
		}, 800);
		return false;
	});
	$('#game4a-2').click(function(){
		//$('#game4-in').hide();
		$('#game4a-2').animate({left:'+=330px'}, 1200, function(){
			$('#game4-ans2').fadeIn();
		});
		
		setTimeout(function(){
			$('#game4-ans2').hide();
			$('#game4a, #game4-in').hide();
			//$('#game4-in2, #game4b').show();
			$('#game4b, #fb-tag-note').show();
			$('#game4b > div').eq( fbIndex ).fadeIn();
		}, 2600);
		return false;
	});
	$('#game4a-3').click(function(){
		$('#game4-ans3').show();
		setTimeout(function(){
			//replay
			gameLose();
		}, 800);
		return false;
	});
	
	$('#mark').click(function(){
		$('.popup, .gameWrap, #fb-tag-note').hide();
		$('#title').show();
		//alert('close');
		return false;
	});
	
	
	$('.share a').click(function(){
		//var url = $(this).attr("http");
		$('#thisShare').text( $(this).attr("href") );
		getLoaginStatus();			
		return false;	
	});
	
	//test
	/*
	$('#m4').click(function(){
		$('#popup2-bg').fadeIn();
		$('#popup3').fadeIn();
		return false;
	});
	*/
	$('.popup3-close').click(function(){
		$('#popup2-bg').hide();
		$('#popup3').hide();
		$('.popup, .gameWrap, #fb-tag-note').hide();
		$('#title').show();
		return false;
	});
	
	$('#popup-close').click(function(){
		$('#popup2-bg').hide();
		$('#popup3').hide();
		$('.popup, .gameWrap, #fb-tag-note').hide();
		$('#title').show();
		return false;
	});
	
	$('#form-submit').click(function(){
		postData();
		return false;
	});
	
});

function formSubmit(){
	$('#popup2-bg').fadeIn();
	$('#popup3').fadeIn();	
}

$(window).resize(function(){
	layout();
});