var $ = jQuery.noConflict();
$(document).ready(function($){
//STICKY HEADER
  var $window = $(window);
  $window.scroll(function() {
	$scroll_position = $window.scrollTop();
	  if ($scroll_position > 0) { 
		  $('.header_sticky').addClass('is-sticky');
	  } else {
		  $('.header_sticky').removeClass('is-sticky');
	  }
  });

  var $wpAdminBar = $('#wpadminbar');
  if ($wpAdminBar.length) {
	  $('.header-sticky #masthead').css('top', '64px');
	  $('.main_menu').addClass('topAdmin');
	  $('.custom_menu_about').parent().addClass('topAdmin');
  } else {
	  $('.header-sticky #masthead').css('top', '0px');
  }

//SUB-MENU SCRIPTS
	$('#primary-menu').addClass('sub-menu-level-0');
	$('#primary-menu ul').addClass('sub-menu-level-1');
	$('#primary-menu ul ul').addClass('sub-menu-level-2').removeClass('sub-menu-level-1');

//SCROLL TO TOP OF PAGE
/*
$('.scroll_top_btn').click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

$('.move_top').click(function() {
  $("html, body").animate({ 
  	scrollTop: $(".form_container").offset().top-120 
	}, "slow");
  return false;
});*/
	
//PRELOADER ON LOAD
	$(".se-pre-con").fadeOut(300);

//READMORE SHORTCODE	
	$('.readmore_content').css('display', 'none');
	$('.readmore_btn').click(function(){
		if ( $(this).prev().css('display') == 'none') {
			$(this).prev().css('display', 'contents');
			$(this).addClass('readless_btn');
			$(this).text('Read Less');
		} else {
			$(this).prev().css('display', 'none');
			$(this).text('Read More');
			$(this).removeClass('readless_btn');
		}
	});

//STOP VIDEO IF MODAL IS CLOSED
	var videoSrc = $('.modal iframe').attr("src");
	$(".modal").on('hidden.bs.modal', function (e) {
		$(".modal iframe").attr("src", videoSrc);
    	$(".modal iframe").attr("src", $(".modal iframe").attr("src"));
	});

//PLAY VIDEO IF MODAL IS OPEN
	$('.modal').on('show.bs.modal', function () { 
	  var videoSrc1 = '#' + $(this).attr("id") + ' iframe';
	  var videoSrc2 = $(videoSrc1).attr('src');
	  $(videoSrc1).attr("src", videoSrc2+"&autoplay=1");
	});

//LAZY	
	var lazyLoadInstance = new LazyLoad({
	  elements_selector: ".lazy"
	});


//
	var headerHeight = $('#masthead').height();
	$('.header-gap').css('height', headerHeight);


//SMOOTH SCROLLING ANCHOR TAB

/*
 $('.footer_menu_col a').click(function() 
  {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        || location.hostname == this.hostname) 
    {
      
      var target = $(this.hash),
      headerHeight = $("#masthead").height(); // Get fixed header height
            
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              
      if (target.length) 
      {
        $('html,body').animate({
          scrollTop: target.offset().top - 110
        }, 750);

      }
    }
  });*/

// ISOTOPE
  var $container = $('.isotope').isotope({
    itemSelector: '.element-item',
  });

  var filterFns = {
    numberGreaterThan50: function() {
      var number = $(this).find('.number').text();
      return parseInt(number, 10) > 50;
    },

    ium: function() {
      var name = $(this).find('.name').text();
      return name.match(/ium$/);
    }
  };

  $('#filters').on( 'click', 'button', function() {
		var filterValue = $( this ).attr('data-filter');
		$container.isotope({ filter: filterValue });
	});
  
  $('.button-group').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
		$buttonGroup.on( 'click', 'button', function() {
		  $buttonGroup.find('.is-checked').removeClass('is-checked');
		  $( this ).addClass('is-checked');
		});
	});
	
	
  
 if( $('body').hasClass('page-id-284') ) {
  //****************************
  // Isotope Load more button
  //****************************
  var initShow = 12; //number of items loaded on init & onclick load more button
  var counter = initShow; //counter for load more button
  var iso = $container.data('isotope'); // get Isotope instance

  loadMore(initShow); //execute function onload

  function loadMore(toShow) {
    $container.find(".hidden").removeClass("hidden");

    var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
      return item.element;
    });
    $(hiddenElems).addClass('hidden');
    $container.isotope('layout');

    //when no more to load, hide show more button
    if (hiddenElems.length == 0) {
      jQuery("#load-more").hide();
    } else {
      jQuery("#load-more").show();
    };

  }

  //append load more button
  var numItem = $('.element-item').length;
  if (numItem > 9){
  	$container.after('<div class="button_loadmore"><button id="load-more">Load More</button></div>');
  }
  //when load more button clicked
  $("#load-more").click(function() {
    if ($('#filters').data('clicked')) {
      //when filter button clicked, set initial value for counter
      counter = initShow;
      $('#filters').data('clicked', false);
    } else {
      counter = counter;
    };

    counter = counter + initShow;

    loadMore(counter);
  });

  //when filter button clicked
  $("#filters").click(function() {
    $(this).data('clicked', true);

    loadMore(initShow);
  });
 }


//ACCORDION
$('.add_accordion').each(function(){
	var those = $(this);
	var $first_div = '#' + $(this).find('.accordion_container:first').find('.accordion').attr('id');
	var $question_div = '#' + $(this).find('.accordion_container:first').find('.accordion_question_container').attr('id');
	var $answer_div = '#' + $(this).find('.accordion_container:first').find('.accordion_answer_container').attr('id');
	var $btn_icon = '#' + $(this).find('.accordion_container:first').find('.accordion-button-icon').attr('id');
	var $content_div = $(this).find('.accordion_container:first').addClass('accordion_container_active');

//	$($first_div).addClass('accordion_active');
//	$($question_div).addClass('question_active');
//	$($answer_div).addClass('answer_active').slideDown(300);
//	$($btn_icon).text('-');
//	$($btn_icon).removeClass('xdclose').addClass('xdopen');
	
	those.find('.accordion_question_container').click(function(){
		var that = $(this);
		if( $(this).next().css('display') == 'none' ){
			those.find('.accordion').removeClass('accordion_active');
			those.find('.accordion_container').removeClass('accordion_container_active');
			those.find('.accordion_question_container').removeClass('question_active');
			those.find('.accordion_answer_container').removeClass('answer_active');
		//	those.find('.accordion-button-icon').text('+');
			those.find('.accordion-button-icon').removeClass('xdclose').addClass('xdopen');
			those.find('.accordion_answer_container').slideUp(300);
			
			that.parent().addClass('accordion_active');
			that.parent().parent().addClass('accordion_container_active');
			that.addClass('question_active');
			that.next().addClass('answer_active');
			that.next().slideDown(300);
		//	that.find('.accordion-button-icon').text('-');
			that.find('.accordion-button-icon').removeClass('xdopen').addClass('xdclose');
		} else {
			those.find('.accordion').removeClass('accordion_active');
			those.find('.accordion_container').removeClass('accordion_container_active');
			those.find('.accordion_question_container').removeClass('question_active');
			those.find('.accordion_answer_container').removeClass('answer_active');
		//	those.find('.accordion-button-icon').text('+');
			those.find('.accordion-button-icon').removeClass('xdclose').addClass('xdopen');
			those.find('.accordion_answer_container').slideUp(300);
		}
	});
});

//EXTENDED MENU SCRIPT
	$('.em_hamburger svg').click(function(){
		if( $('#em_mobile_menu').css('display') == 'block' ) {
			$('#em_mobile_menu').slideUp();
			return false;
		} else {
			$('#em_mobile_menu').slideDown();
			return false;
		}
	});
	
	$window.click(function(){
		if( $('#em_mobile_menu').css('display') == 'block' ) {
			$('#em_mobile_menu').slideUp();
			return false;
		} 
	});

//JQUERY READMORE
	$('.sh_gallery a').hide();
	$('.sh_gallery a:lt(12)').show();
	$('.lvo_btn').click(function () {
		$('.sh_gallery a:not(:visible):lt(12)').show();
		if ($('.sh_gallery a:not(:visible)').length == 0)
			$(this).hide();
			return false;   
	});

//LOAD MORE PROJECTS
	$(document).on('click', '.post_load_more', function(){
		var that = $(this);
		var page = that.data('page');
		var newPage = page+1;
		var ajaxurl = that.data('url');

		$.ajax({
		   url : ajaxurl,
		   type : 'post',
		   data : {
			 page : page,
			 action : 'post_load_more',			 
		   },
		   error : function( response ){
			 console.log(response);
		   },
		   beforeSend : function ( xhr ) {
			  $('.post_load_more').text('Loading...'); 
		   },
		   success : function( response ){
			 if( response == 0 ){
				 $('.load_more_button').hide();
			 } else {
				 that.data('page', newPage);
				 $('.latest_container').append( response );
				 $('.post_load_more').text( 'Load More' );
			 }
		   }
		});
	});

}); //document on load END