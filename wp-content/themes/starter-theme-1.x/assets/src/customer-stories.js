//// Slick Slider

jQuery(document).ready(function ($) {
	// Your code here
	$('.slider-text-wrapper').slick({
		dots: false,
		arrows: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		speed: 1250,
		// fade: true,
	})
})
