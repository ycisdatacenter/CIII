/***************************************************************************************************************
||||||||||||||||||||||||||||         CUSTOM SCRIPT FOR CHARITY HOME            ||||||||||||||||||||||||||||||||||||
****************************************************************************************************************
||||||||||||||||||||||||||||              TABLE OF CONTENT                  ||||||||||||||||||||||||||||||||||||
****************************************************************************************************************
****************************************************************************************************************
1 revolutionSliderActiver
2 galleryMasonaryLayout
3 LightBox / Fancybox
4 Gallery Filters
5 accrodion
6 pieChart RoundCircle
7 progressBarConfig
8 teamCarosule
9 testiCarosule
10 clientsCarosule
11 owlCarosule
12 CounterNumberChanger
13 stickyHeader
14 contactFormValidation
15 event slider
16 Common CssJs
17 selectInput
18 datePicker
19 gMap
20 mobileMenu
****************************************************************************************************************
||||||||||||||||||||||||||||            End TABLE OF CONTENT                ||||||||||||||||||||||||||||||||||||
****************************************************************************************************************/
"use strict";
/*=====================*/
	/* 8 - LIGHT-BOX */
	/*=====================*/
    jQuery(document).ready(function(){
        console.log('run2');
        jQuery('div#main-navigation ul#Primary  li.menu-item > i.fa.fa-chevron-down').click(function(){
            jQuery(this).parents('li').siblings('li').find('a').removeClass('clicked_back_color');
            jQuery(this).prev('a').toggleClass('clicked_back_color');
        });
    });
	/*activity indicator functions*/
	var activityIndicatorOn = function(){
		jQuery('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
	};
	var activityIndicatorOff = function(){
		jQuery('#imagelightbox-loading').remove();
	};
	
	/*close button functions*/
	var closeButtonOn = function(instance){
		jQuery('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function(){ jQuery(this).remove(); instance.quitImageLightbox(); return false; });
	};
	var closeButtonOff = function(){
		jQuery('#imagelightbox-close').remove();
	};
	
	/*overlay*/
	var overlayOn = function(){jQuery('<div id="imagelightbox-overlay"></div>').appendTo('body');};
	var overlayOff = function(){jQuery('#imagelightbox-overlay').remove();};
	
	/*caption*/
	var captionOff = function(){jQuery('#imagelightbox-caption').remove();};
	var captionOn = function(){
		var description = jQuery('a[href="' + jQuery('#imagelightbox').attr('src') + '"]').data('title');
		if(description.length)
			jQuery('<div id="imagelightbox-caption">' + description +'</div>').appendTo('body');
	};
	/*arrows*/
    var arrowsOn = function(instance, selector) {
        var jQueryarrows = jQuery('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"><i class="fa fa-chevron-left"></i></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"><i class="fa fa-chevron-right"></i></button>');
        jQueryarrows.appendTo('body');
        jQueryarrows.on('click touchend', function(e) {
            e.preventDefault();
            var jQuerythis = jQuery(this);
            if( jQuerythis.hasClass('imagelightbox-arrow-left')) {
                instance.loadPreviousImage();
            } else {
                instance.loadNextImage();
            }
            return false;
        });
    };	
	var arrowsOff = function(){jQuery('.imagelightbox-arrow').remove();};	
			
	var selectorG = '.lightbox';
	if(jQuery(selectorG).length){
		var instanceG = jQuery(selectorG).imageLightbox({
			quitOnDocClick:	false,
			onStart:		function() {arrowsOn(instanceG, selectorG);overlayOn(); closeButtonOn(instanceG);},
			onEnd:			function() {arrowsOff();captionOff(); overlayOff(); closeButtonOff(); activityIndicatorOff();},
			onLoadStart: 	function() {captionOff(); activityIndicatorOn();},
			onLoadEnd:	 	function() {jQuery('.imagelightbox-arrow').css('display', 'block');captionOn(); activityIndicatorOff();}
		});		
	}			
// 6 pieChart RoundCircle
function expertizeRoundCircle () {
	var rounderContainer = jQuery('.piechart.style-one');
	if (rounderContainer.length) {
		rounderContainer.each(function () {
			var Self = jQuery(this);
			var value = Self.data('value');
			var size = Self.parent().width();
			var color = Self.data('fg-color');
			Self.find('span').each(function () {
				var expertCount = jQuery(this);
				expertCount.appear(function () {
					expertCount.countTo({
						from: 1,
						to: value*100,
						speed: 3000
					});
				});
			});
			Self.appear(function () {					
				Self.circleProgress({
					value: value,
					size: 142,
					thickness: 10,
					emptyFill: 'rgba(208,104,63,1)',
					animation: {
						duration: 3000
					},
					fill: {
						color: color
					}
				});
			});
		});
	};
}
function stickyHeader () {
  if (jQuery('.stricky').length) {
    var strickyScrollPos = jQuery('.stricky').next().offset().top;
    if(jQuery(window).scrollTop() > strickyScrollPos) {
      jQuery('.stricky').removeClass('slideIn animated');
      jQuery('.stricky').addClass('stricky-fixed slideInDown animated');
    }
    else if(jQuery(this).scrollTop() <= strickyScrollPos) {
      jQuery('.stricky').removeClass('stricky-fixed slideInDown animated');
      jQuery('.stricky').addClass('slideIn animated');
    }
  };
}
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 120){  
    jQuery('#main-navigation-wrapper').removeClass('slideIn animated');
      jQuery('#main-navigation-wrapper').addClass("sticky_header slideInDown animated");
    }
    else{
    jQuery('#main-navigation-wrapper ').removeClass('sticky_header slideInDown animated');
      jQuery('#main-navigation-wrapper ').addClass('slideIn animated');
    }
});
jQuery('.static-section1 ul li h2').each(function () {
   jQuery(this).prop('Counter',0).animate({
        Counter: jQuery(this).text()
    }, {
        duration: 10000,
        easing: 'swing',
        step: function (now) {
            jQuery(this).text(Math.ceil(now));
        }
    });
});
// Dom Ready Function
jQuery(document).on('ready', function () {
	(function (jQuery) {
		expertizeRoundCircle();
	})(jQuery);
});
"use strict"; // Start of use strict
function bootstrapAnimatedLayer() {
    /* Demo Scripts for Bootstrap Carousel and Animate.css article
     * on SitePoint by Maria Antonietta Perna
     */
    //Function to animate slider captions 
    function doAnimations(elems) {
        //Cache the animationend event in a variable
        var animEndEv = 'webkitAnimationEnd animationend';
        elems.each(function() {
            var $this = jQuery(this),
                $animationType = $this.data('animation');
				$this.addClass($animationType).one(animEndEv, function() {
                $this.removeClass($animationType);
            });
        });
    }
    //Variables on page load 
    var $myCarousel = jQuery('#minimal-bootstrap-carousel'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    //Initialize carousel 
    $myCarousel.carousel({
        interval: 7000
    });
    //Animate captions in first slide on page load 
    doAnimations($firstAnimatingElems);
    //Pause carousel  
    $myCarousel.carousel('pause');
    //Other slides to be animated on carousel slide event 
}
function clientCarousel() {
    if (jQuery('.client-carousel').length) {
        jQuery('.client-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    autoWidth: false
                },
                480: {
                    items: 2,
                    autoWidth: false
                },
                600: {
                    items: 3,
                    autoWidth: false
                },
                1000: {
                    items: 6,
                    autoWidth: false
                }
            }
        });
    };
}
function thmProjectFilter() {
    if (jQuery('.mixit-gallery').length) {
        jQuery('.mixit-gallery').mixItUp();
    };
}
function thmBarChart() {
    if (jQuery('#thm-bar-chart').length) {
        var ctx = jQuery("#thm-bar-chart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "Company dataset",
                    backgroundColor: "rgba(248,248,248,0.8)",
                    borderColor: "rgba(218,218,218,1)",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(59,65,94,0.5)",
                    hoverBorderColor: "rgba(218,218,218,1)",
                    data: [55, 65, 90, 85, 75, 95, 98],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    };
}
function doughnutChartBox() {
    if (jQuery('#doughnut-chartBox').length) {
        var ctx = jQuery("#doughnut-chartBox");
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    "65%",
                    "13%",
                    "22%"
                ],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: [
                        "#CEC2AB",
                        "#8D6DC4",
                        "#F79468"
                    ],
                    hoverBackgroundColor: [
                        "#3B415E",
                        "#3B415E",
                        "#3B415E"
                    ],
                    hoverBorderColor: [
                        "#fff",
                        "#fff",
                        "#fff"
                    ]
                }]
            },
            option: {
                position: "left",
                responsive: true,
            }
        });
    };
}
function testiCarousel() {
    if (jQuery('.testi-carousel').length) {
        jQuery('.testi-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    autoWidth: false
                },
                480: {
                    items: 1,
                    autoWidth: false
                },
                600: {
                    items: 1,
                    autoWidth: false
                },
                1000: {
                    items: 1,
                    autoWidth: false
                }
            }
        });
    };
}
//Drop downs
jQuery('ul i.fa').on('click', function() {
	jQuery(this).toggleClass('DDopen');
	jQuery(this).closest('ul').find('ul').removeClass('opened');
	jQuery(this).parent().find('> ul').addClass('opened');
	jQuery(this).closest('ul').find('ul').not('.opened').slideUp(350);
	jQuery(this).parent().find('> ul').slideToggle(350);
	jQuery(this).closest('ul').find('i.fa').not(this).removeClass('DDopen');
});
   
    jQuery(document).ready(function( $ ) {
        $('.counter').counterUp({
            delay: 50,
            time: 2000
        });
    });
// instance of fuction while Document ready event   
jQuery(document).on('ready', function() {
    (function($) {
        bootstrapAnimatedLayer();
        clientCarousel();
        thmProjectFilter();
        thmBarChart();
        doughnutChartBox();
        testiCarousel();
    })(jQuery);
});

jQuery(".navbar-nav li.menu-item-has-children").addClass("dropdown");
jQuery(".navbar-nav li.menu-item-has-children ul").addClass("dropdown-submenu");
jQuery(".widget_categories ul").addClass("blog-category-cl");
jQuery("div#Primary > ul").addClass("nav navbar-nav");
jQuery("div#Primary > ul > li.page_item_has_children > ul ").addClass("sub-menu dropdown-submenu");
jQuery("div#Primary > ul > li.page_item_has_children > ul > li.page_item_has_children > ul").addClass("sub-menu dropdown-submenu");
jQuery( "#main-navigation #Primary" ).removeClass( "display_none" );
jQuery(document).ready(function($) {
/*
|--------------------------------------------------------------------------
| Global myTheme Obj / Variable Declaration
|--------------------------------------------------------------------------
|
*/
	var myTheme = window.myTheme || {},
    $win = $( window );
/*
|--------------------------------------------------------------------------
| isotope
|--------------------------------------------------------------------------
|
*/
	myTheme.Isotope = function () {
	
		// 4 column layout
		var isotopeContainer = $('.isotopeContainer');
		if( !isotopeContainer.length || !jQuery().isotope ) return;
		$win.load(function(){
			isotopeContainer.isotope({
				itemSelector: '.isotopeSelector'
			});
		$('.isotopeFilters').on( 'click', 'a', function(e) {
				$('.isotopeFilters').find('.active').removeClass('active');
				$(this).parent().addClass('active');
				var filterValue = $(this).attr('data-filter');
				isotopeContainer.isotope({ filter: filterValue });
				e.preventDefault();
			});
		});
		
		// 3 column layout
		var isotopeContainer2 = $('.isotopeContainer2');
		if( !isotopeContainer2.length || !jQuery().isotope ) return;
		$win.load(function(){
			isotopeContainer2.isotope({
				itemSelector: '.isotopeSelector'
			});
		$('.isotopeFilters2').on( 'click', 'a', function(e) {
				$('.isotopeFilters2').find('.active').removeClass('active');
				$(this).parent().addClass('active');
				var filterValue = $(this).attr('data-filter');
				isotopeContainer2.isotope({ filter: filterValue });
				e.preventDefault();
			});
		});
		
		// 2 column layout
		var isotopeContainer3 = $('.isotopeContainer3');
		if( !isotopeContainer3.length || !jQuery().isotope ) return;
		$win.load(function(){
			isotopeContainer3.isotope({
				itemSelector: '.isotopeSelector'
			});
		$('.isotopeFilters3').on( 'click', 'a', function(e) {
				$('.isotopeFilters3').find('.active').removeClass('active');
				$(this).parent().addClass('active');
				var filterValue = $(this).attr('data-filter');
				isotopeContainer3.isotope({ filter: filterValue });
				e.preventDefault();
			});
		});
		
		// 1 column layout
		var isotopeContainer4 = $('.isotopeContainer4');
		if( !isotopeContainer4.length || !jQuery().isotope ) return;
		$win.load(function(){
			isotopeContainer4.isotope({
				itemSelector: '.isotopeSelector'
			});
		$('.isotopeFilters4').on( 'click', 'a', function(e) {
				$('.isotopeFilters4').find('.active').removeClass('active');
				$(this).parent().addClass('active');
				var filterValue = $(this).attr('data-filter');
				isotopeContainer4.isotope({ filter: filterValue });
				e.preventDefault();
			});
		});
	
	};
	
/*
|--------------------------------------------------------------------------
| Functions Initializers
|--------------------------------------------------------------------------
|
*/	
	myTheme.Isotope();
});
/* Mobile Menu */
if ( jQuery(window).width() < 991 )
{
	jQuery( "body" ).addClass("mobile-menu");
}
jQuery('#btt').click(function() {
       jQuery(window).scroll(function() {
	   if(jQuery(this).scrollTop() != 0) {
		   jQuery('#btt').fadeIn();           
		   } else {       
		   jQuery('#btt').fadeOut();
		   }
	   });
       
	   jQuery('#btt').click(function() {
	   
	   jQuery('body,html').animate({scrollTop:0},800);  
	   
	   });
});
function customTabSingleService () {
    if (jQuery('.tabmenu-box').length) {
        var tabWrap = jQuery('.tab-content-box');
        var tabClicker = jQuery('.tabmenu-box ul li');
        
        tabWrap.children('div').hide();
        tabWrap.children('div').eq(0).show();
        tabClicker.on('click', function() {
            var tabName = jQuery(this).data('tab-name');
            tabClicker.removeClass('active');
            jQuery(this).addClass('active');
            var id = '#'+ tabName;
            tabWrap.children('div').not(id).hide();
            tabWrap.children('div'+id).fadeIn('500');
            return false;
        });        
    }
}
// Dom Ready Function
jQuery(document).on('ready', function () {
	(function (jQuery) {
        // add your functions
     
        customTabSingleService ();
	})(jQuery);
});
jQuery('.plus').on('click',function(e){
var val = parseInt(jQuery(this).prev('input').val());
jQuery(this).prev('input').val( val+1 );
});
jQuery('.minus').on('click',function(e){
var val = parseInt(jQuery(this).next('input').val());
if(val !== 0){
    jQuery(this).next('input').val( val-1 );
} });
if (jQuery('.testiCarousel').length) {
        jQuery('.testiCarousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    autoWidth: false
                },
                480: {
                    items: 1,
                    autoWidth: false
                },
                600: {
                    items: 2,
                    autoWidth: false
                },
                1000: {
                    items: 4,
                    autoWidth: false
                }
            }
        });
    };
// Home7 Service
if (jQuery('.hm7ServiceCarousl').length) {
        jQuery('.hm7ServiceCarousl').owlCarousel({
                loop: true,
                margin: 0,
                loop: true,
                dots: true,
                nav: false,
                autoplay:true,
                smartSpeed: 1500,
                pagination:false,
                // navigation:true ,           
                autoplayHoverPause:false,
                fluidSpeed:true,
                responsive: {
                        0: {
                            items: 1,
                            autoWidth: false
                        },
                        480: {
                            items: 1,
                            autoWidth: false
                        },
                        600: {
                            items: 2,
                            autoWidth: false
                        },
                        1000: {
                            items: 4,
                            autoWidth: false
                        }
                    }
               });
    };
// Home8 Header Sidebar
function openSideNav() {
  document.getElementById("headerSidebar").style.padding = "0 20px 60px 35px";
  document.getElementById("headerSidebar").style.right = "0";
}
function closeSideNav() {
  document.getElementById("headerSidebar").style.right = "-420px";
  document.getElementById("headerSidebar").style.padding = "0";
}
(function ($) {
    "use strict"
    // Accordion Toggle Items
    var iconOpen = 'fa fa-minus',
        iconClose = 'fa fa-plus';
    $(document).on('show.bs.collapse hide.bs.collapse', '.accordion', function (e) {
        var $target = $(e.target);
        $target.siblings('.accordion-heading').find('em').toggleClass(iconOpen + ' ' + iconClose);
        if (e.type == 'show') {
            jQuery('#accordion2 em.icon-fixed-width').removeClass(iconOpen);
            jQuery('#accordion2 em.icon-fixed-width').addClass(iconClose);
            jQuery('#accordion2 .accordion-toggle').removeClass('active');
            jQuery('#accordion2 .accordion-body.collapse').removeClass('in');
            $target.prev('.accordion-heading').find('.accordion-toggle').addClass('active');
            $target.prev('.accordion-group').find('.accordion-body.collapse').addClass('in');
            $target.siblings('.accordion-heading').find('em').addClass('fa-minus');
            $target.siblings('.accordion-heading').find('em').removeClass('fa-plus');
        }
        if (e.type == 'hide') {
            jQuery('#accordion2 em.icon-fixed-width').removeClass(iconOpen);
            jQuery('#accordion2 em.icon-fixed-width').addClass(iconClose);
            jQuery('#accordion2 .accordion-toggle').removeClass('active');
            jQuery('#accordion2 .accordion-body.collapse').removeClass('in');
            $(this).find('.accordion-toggle').not($target).removeClass('active');
            $target.siblings('.accordion-heading').find('em').addClass('fa-plus');
            $target.siblings('.accordion-heading').find('em').removeClass('fa-minus');
        }
    });
})(jQuery);

/*
 Countdown For Coming soon
*/
        function coundown(tildate) {
          var now = new Date().getTime();
          var countDownDate = new Date(tildate).getTime();
          var distance = countDownDate - now;
          if (distance < 0) {
            document.getElementById("clockdiv").innerHTML = "EXPIRED";
             jQuery('#clockdiv').addClass("timerexpired");   
          }
          else
          {
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;  
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;
          }
        }
        // End Countdown For Coming soon
(function ($) {
$(".plumberGrid").owlCarousel({
            items: 1,
            nav: false,
            dot: true,
            loop: true,
            margin: 40,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 1500,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                481: {
                    items: 1,
                },
                1000: {
                    items: 1,
                }
            }
        });
})(jQuery);