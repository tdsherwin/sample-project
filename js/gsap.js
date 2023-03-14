var $ = jQuery.noConflict();
$(document).ready(function($){

	gsap.registerPlugin(ScrollTrigger);

//SET ANIMATION DIRECTION
	if( $('.top').length ){
		gsap.from('.top', {
			scrollTrigger:{
				trigger : 'section',
				start : 'top center',
				autoAlpha : 0,
				toggleAction : 'restart reset restart reset',
				autoalpha: 0,
			},
			y: -75,
			duration: 1,
		});
	}
	
	if( $('.bottom').length ){
		gsap.from('.bottom', {
			scrollTrigger:{
				trigger : 'section',
				start : 'top center',
				autoAlpha : 0,
				toggleAction : 'restart reset restart reset',
				autoalpha: 0,
			},
			y: 75,
			duration: 1,
		});
	}
	
	if( $('.left').length ){
		gsap.from('.left', {
			scrollTrigger:{
				trigger : 'section',
				start : 'top center',
				autoAlpha : 0,
				toggleAction : 'restart reset restart reset',
				autoalpha: 0,
			},
			x: -75,
			duration: 1,
		});
	}
	
	if( $('.right').length ){
		gsap.from('.right', {
			scrollTrigger:{
				trigger : 'section',
				start : 'top center',
				autoAlpha : 0,
				toggleAction : 'restart reset restart reset',
				autoalpha: 0,
			},
			x: 75,
			duration: 1,
		});
	}
	
	if( $('.stagger').length ){
		gsap.from('.stagger', {
			scrollTrigger:{
				trigger : 'section',
				start : 'top center',
				autoAlpha : 0,
				toggleAction : 'restart reset restart reset',
				autoalpha: 0,
			},
			y: 75,
			stagger: .5,
			duration: 1,
		});
	}	
});