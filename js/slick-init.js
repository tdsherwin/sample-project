jQuery(document).ready(function($){
	$('.home_banner_slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		speed: 1000,
		autoplay: true,
		dots: false,
		arrow: true,
		autoplaySpeed: 4000,

	});
	
	$('.partners_slider').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		infinite: true,
		speed: 1000,
		autoplay: false,
		dots: false,
		arrow: false,
		autoplaySpeed: 5000,
		responsive: [
			{ breakpoint: 921,
		  		settings: {
					slidesToShow: 2,	
					slidesToScroll: 1
		  		}
			},
			{ breakpoint: 569,
		  		settings: {
					slidesToShow: 1,
					slidesToScroll: 1
		  		}
			}
		]
	});
	
	$('.testimonial_slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		speed: 1000,
		autoplay: true,
		dots: false,
		arrow: true,
		autoplaySpeed: 4000,

	});

});
