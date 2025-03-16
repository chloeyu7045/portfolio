(function($) {
	
	"use strict";
	
	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.loader-wrap').length){
			$('.loader-wrap').delay(1000).fadeOut(500);
		}
	}

	if ($(".preloader-close").length) {
        $(".preloader-close").on("click", function(){
            $('.loader-wrap').delay(200).fadeOut(500);
        })
    }
	
	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-top');
			if (windowpos >= 110) {
				siteHeader.addClass('fixed-header');
				scrollLink.addClass('open');
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.removeClass('open');
			}
		}
	}
	
	headerStyle();


	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');
		
	}

	//Mobile Nav Hide Show
	if($('.mobile-menu').length){
		
		
		var mobileMenuContent = $('.main-header .menu-area .main-menu').html();
		$('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);
		$('.sticky-header .main-menu').append(mobileMenuContent);
		
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).toggleClass('open');
			$(this).prev('ul').slideToggle(500);
		});
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('.megamenu').slideToggle(900);
		});
		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function() {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});
	}

	// Elements Animation
	if($('.wow').length){
		var wow = new WOW({
		mobile:       false
		});
		wow.init();
	}

	//Contact Form Validation
	if($('#contact-form').length){
		$('#contact-form').validate({
			rules: {
				username: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				phone: {
					required: true
				},
				subject: {
					required: true
				},
				message: {
					required: true
				}
			}
		});
	}

	if ($(".odometer").length) {
	    var odo = $(".odometer");
	    odo.each(function () {
	      $(this).appear(function () {
	        var countNumber = $(this).attr("data-count");
	        $(this).html(countNumber);
	      });
	    });
	  }


	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}


	//Tabs Box
	if($('.tabs-box').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));
			
			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(100);
				$(target).addClass('active-tab');
			}
		});
	}



	//Accordion Box
	if($('.accordion-box').length){
		$(".accordion-box").on('click', '.acc-btn', function() {
			
			var outerBox = $(this).parents('.accordion-box');
			var target = $(this).parents('.accordion');
			
			if($(this).hasClass('active')!==true){
				$(outerBox).find('.accordion .acc-btn').removeClass('active');
			}
			
			if ($(this).next('.acc-content').is(':visible')){
				return false;
			}else{
				$(this).addClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content').slideUp(300);
				target.addClass('active-block');
				$(this).next('.acc-content').slideDown(300);	
			}
		});	
	}


	// banner-carousel
	if ($('.banner-carousel').length) {
        $('.banner-carousel').owlCarousel({
            loop:true,
			margin:0,
			nav:true,
			animateOut: 'fadeOut',
    		animateIn: 'fadeIn',
    		active: true,
			smartSpeed: 1000,
			autoplay: 6000,
            navText: [ '<span class="icon-6"></span>', '<span class="icon-7"></span>' ],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                800:{
                    items:1
                },
                1024:{
                    items:1
                }
            }
        });
    }


    // single-item-carousel
	if ($('.single-item-carousel').length) {
		$('.single-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="icon-33"></span>', '<span class="icon-34"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},			
				1200:{
					items:1
				}

			}
		});    		
	}


	// two-item-carousel
	if ($('.two-item-carousel').length) {
		$('.two-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="icon-6"></span>', '<span class="icon-7"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:2
				},			
				1200:{
					items:2
				}

			}
		});    		
	}


    // three-item-carousel
	if ($('.three-item-carousel').length) {
		$('.three-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="icon-6"></span>', '<span class="icon-7"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:2
				},			
				1200:{
					items:3
				}

			}
		});    		
	}


	// four-item-carousel
	if ($('.four-item-carousel').length) {
		$('.four-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:3
				},			
				1200:{
					items:4
				}

			}
		});    		
	}


	// five-item-carousel
	if ($('.five-item-carousel').length) {
		$('.five-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:4
				},			
				1200:{
					items:5
				}

			}
		});    		
	}

	// six-item-carousel
	if ($('.six-item-carousel').length) {
		$('.six-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:4
				},			
				1200:{
					items:6
				}

			}
		});    		
	}


	// portfolio-carousel
	if ($('.portfolio-carousel').length) {
		$('.portfolio-carousel').owlCarousel({
			loop:true,
			margin:60,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},			
				1200:{
					items:1
				}

			}
		});    		
	}


	// portfolio-carousel-2
	if ($('.portfolio-carousel-2').length) {
		$('.portfolio-carousel-2').owlCarousel({
			loop:true,
			margin:80,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:2
				},			
				1200:{
					items:3
				}

			}
		});    		
	}


	// portfolio-carousel-3
	if ($('.portfolio-carousel-3').length) {
		$('.portfolio-carousel-3').owlCarousel({
			loop:true,
			margin:50,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:3
				},			
				1200:{
					items:4
				}

			}
		});    		
	}

	// portfolio-carousel-4
	if ($('.portfolio-carousel-4').length) {
		$('.portfolio-carousel-4').owlCarousel({
			loop:true,
			margin:50,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},			
				1200:{
					items:1
				}

			}
		});    		
	}


	// instagram-carousel
	if ($('.instagram-carousel').length) {
		$('.instagram-carousel').owlCarousel({
			loop:true,
			margin:40,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:2
				},			
				1200:{
					items:3
				}

			}
		});    		
	}


	// testimonial-carousel
	if ($('.testimonial-carousel').length) {
		$('.testimonial-carousel').owlCarousel({
			loop:true,
			margin:50,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="icon-6"></span>', '<span class="icon-7"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:2
				},			
				1200:{
					items:2
				}

			}
		});    		
	}

	// testimonial-carousel-2
	if ($('.testimonial-carousel-2').length) {
		$('.testimonial-carousel-2').owlCarousel({
			loop:true,
			margin:70,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="icon-6"></span>', '<span class="icon-7"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:2
				},			
				1200:{
					items:2
				}

			}
		});    		
	}


	// service-carousel
	if ($('.service-carousel').length) {
		$('.service-carousel').owlCarousel({
			loop:true,
			margin:50,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="fal fa-angle-left"></span>', '<span class="fal fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:2
				},			
				1200:{
					items:3
				}

			}
		});    		
	}



	//nice select
	$(document).ready(function() {
		$('select:not(.ignore)').niceSelect();
	  });


	//Sortable Masonary with Filters
	// Sortable Masonry with Filters
function enableMasonry() {
    if ($('.sortable-masonry').length) {

        var winDow = $(window);
        // 直接讓 Isotope 作用在 masonry-list
        var $container = $('.sortable-masonry .masonry-list');
        var $filter = $('.filter-btns');

        // 初始化 Isotope
        $container.isotope({
            itemSelector: '.masonry-item',
            layoutMode: 'masonry',
            masonry: {
                columnWidth: '.masonry-item.small-column'
            },
            animationOptions: {
                duration: 500,
                easing: 'linear'
            }
        });

        // Isotope Filter 功能
        $filter.find('li').on('click', function () {
            var selector = $(this).attr('data-filter');

            try {
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 500,
                        easing: 'linear',
                        queue: false
                    }
                });
            } catch (err) {
                console.error(err);
            }
            return false;
        });

        // 當視窗大小改變時，重新排列
        winDow.on('resize', function () {
            var selector = $filter.find('li.active').attr('data-filter');

            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 500,
                    easing: 'linear',
                    queue: false
                }
            });
        });

        // 標籤點擊切換 active 樣式
        var filterItemA = $('.filter-btns li');

        filterItemA.on('click', function () {
            var $this = $(this);
            if (!$this.hasClass('active')) {
                filterItemA.removeClass('active');
                $this.addClass('active');
            }
        });
    }
}

// 確保 DOM 加載後執行
$(document).ready(function () {
    enableMasonry();
});



    // Progress Bar
	if ($('.count-bar').length) {
		$('.count-bar').appear(function(){
			var el = $(this);
			var percent = el.data('percent');
			$(el).css('width',percent).addClass('counted');
		},{accY: -50});

	}


	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1000);
	
		});
	}


	// ------------------------------- AOS Animation
    if ($("[data-aos]").length) { 
        AOS.init({
        duration: 1000,
        mirror: true
      });
    }


	 // page direction
	function directionswitch() {
	  	if ($('.demo-switch').length) {

	    	$('.demo_switch button').on('click', function() {
			   $('.boxed_wrapper').toggleClass(function(){
			      return $(this).is('.dark_bg, .light_bg') ? 'dark_bg light_bg' : 'dark_bg';
			  })
			});
	  	};
	}


	const lenis = new Lenis()

	lenis.on('scroll', () => {

	})

	function raf(time) {
		lenis.raf(time)
		requestAnimationFrame(raf)
	}

	requestAnimationFrame(raf)


	if($('.curved-circle').length) {
        $('.curved-circle').circleType({position: 'absolute', dir: 1.11, radius: 80, forceHeight: true, forceWidth: true});
    }

    if($('.curved-circle-two').length) {
        $('.curved-circle-two').circleType({position: 'absolute', dir: 1.82, radius: 85, forceHeight: true, forceWidth: true});
    }


    /* mouse cursor */
    document.getElementsByTagName("body")[0].addEventListener("mousemove", function(n) {
        e.style.left = n.clientX + "px", 
        e.style.top = n.clientY + "px"
    });
    var 
        e = document.getElementById("mouse-pointer");
        
    $(document).mousemove(function(e){
        
    });


    /* 9. ScrollAnimations */
	var $containers = $('[data-animation]:not([data-animation-text]), [data-animation-box]');
	$containers.scrollAnimations();


	//Parallax Scene for Icons
	if($('.parallax-scene-1').length){
		var scene = $('.parallax-scene-1').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-2').length){
		var scene = $('.parallax-scene-2').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-3').length){
		var scene = $('.parallax-scene-3').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-4').length){
		var scene = $('.parallax-scene-4').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-5').length){
		var scene = $('.parallax-scene-5').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-6').length){
		var scene = $('.parallax-scene-6').get(0);
		var parallaxInstance = new Parallax(scene);
	}


	// Animation gsap 
  function title_animation() {
    var tg_var = jQuery('.sec-title-animation');
    if (!tg_var.length) {
      return;
    }
    const quotes = document.querySelectorAll(".sec-title-animation .title-animation");

    quotes.forEach(quote => {

      //Reset if needed
      if (quote.animation) {
        quote.animation.progress(1).kill();
        quote.split.revert();
      }

      var getclass = quote.closest('.sec-title-animation').className;
      var animation = getclass.split('animation-');
      if (animation[1] == "style4") return

      quote.split = new SplitText(quote, {
        type: "lines,words,chars",
        linesClass: "split-line"
      });
      gsap.set(quote, {
        perspective: 400
      });

      if (animation[1] == "style1") {
        gsap.set(quote.split.chars, {
          opacity: 0,
          y: "90%",
          rotateX: "-40deg"
        });
      }
      if (animation[1] == "style2") {
        gsap.set(quote.split.chars, {
          opacity: 0,
          x: "50"
        });
      }
      if (animation[1] == "style3") {
        gsap.set(quote.split.chars, {
          opacity: 0,
        });
      }
      quote.animation = gsap.to(quote.split.chars, {
        scrollTrigger: {
          trigger: quote,
          start: "top 90%",
        },
        x: "0",
        y: "0",
        rotateX: "0",
        opacity: 1,
        duration: 1,
        ease: Back.easeOut,
        stagger: .02
      });
    });
  }
  ScrollTrigger.addEventListener("refresh", title_animation);



	/*	=========================================================================
	When document is on ready, do
	========================================================================== */

	jQuery(document).on('ready', function () {
		(function ($) {
			// add your functions
			directionswitch()
		})(jQuery);
	});



	/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */
	
	$(window).on('scroll', function() {
		headerStyle();
	});

	
	
	/* ==========================================================================
   When document is loaded, do
   ========================================================================== */
	
	$(window).on('load', function() {
		handlePreloader();
		enableMasonry();
		title_animation();
	});

	

})(window.jQuery);



// portfolio 
document.querySelectorAll(".portfolio-block-one .inner-box").forEach(box => {
    box.addEventListener("mouseenter", function () {
        this.classList.add("style-hover");
        this.querySelector(".content-box").style.opacity = "1";
        this.querySelector(".image-box").style.display = "none";
    });

    box.addEventListener("mouseleave", function () {
        this.classList.remove("style-hover");
        this.querySelector(".content-box").style.opacity = "0";
        this.querySelector(".image-box").style.display = "block";
    });
});



// Json
document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const projectId = urlParams.get("id"); // 取得網址中的 ?id= 值

  if (!projectId) {
    console.error("Project ID not provided");
    return;
  }

  fetch("assets/data/projects.json")
    .then(response => response.json())
    .then(data => {
      const project = data.find(item => item.id === projectId);

      if (!project) {
        console.error("Project not found");
        return;
      }

      // 更新圖片
      document.querySelector("#projects-visual img").src = project.image;

      // 更新分類連結
      document.querySelector("#project-link a").href = project.link;
      document.querySelector("#project-link a").textContent = project.category;

      // 更新標題與內容
      document.querySelector("#projects-tilte").textContent = project.title;
      document.querySelector("#projects-content").textContent = project.content;

      // 更新 Project Overview
      document.querySelector("#project-overview-role").textContent = project.role;
      document.querySelector("#project-overview-tools").textContent = project.tools;
      document.querySelector("#project-overview-collaboration").textContent = project.collaboration;

      // 動態載入 Design Process
      function updateDesignSection(sectionId, images) {
        const container = document.querySelector(`#${sectionId} .tags-img`);
        container.innerHTML = images.map(img => `<img src="${img}" loading="lazy">`).join("");
        if (images.length > 0) {
          document.getElementById(sectionId).style.display = "block";
        } else {
          document.getElementById(sectionId).style.display = "none";
        }
      }

      updateDesignSection("design-process-flowchart", project.flowchart);
      updateDesignSection("design-process-wireframe", project.wireframe);
      updateDesignSection("design-process-designsystem", project.designsystem);
      updateDesignSection("design-process-uidesign", project.uidesign);
      updateDesignSection("design-process-visualdesign", project.visualdesign);
      updateDesignSection("design-process-frontend-development", project.frontenddevelopment);
    })
    .catch(error => console.error("Error loading project data:", error));
});


// project link

document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    const filterClass = params.get("filter");

    if (filterClass) {
        // 觸發篩選按鈕
        const filterButton = document.querySelector(`.filter[data-filter=".${filterClass}"]`);
        if (filterButton) {
            filterButton.click(); // 模擬點擊以觸發篩選功能
        }
    }
});




