'use strict'
console.log('SCRIPT ALIVE')

const singleTabs = document.querySelectorAll('.single-tab-wrapper--tab')
const singleTabsIconsColor = document.querySelectorAll(
	'.single-tab-wrapper--tab .tab-icon-color'
)
const singleTabsIconsGray = document.querySelectorAll(
	'.single-tab-wrapper--tab .tab-icon-gray'
)
const singleTabsImages = document.querySelectorAll(
	'#tabbed-slider .carousel-item'
)
const carouselIndicators = document.querySelectorAll(
	'#tabbed-slider .carousel-indicators button'
)

const singleTabsCarousel = document.querySelectorAll(
	'.single-tab-wrapper--carousel'
)

singleTabsCarousel.forEach((tab, index) => {
	if (index) {
		tab.classList.add('hidden')
	}
})

for (const [index, tab] of singleTabs.entries()) {
	tab.addEventListener('mouseenter', function () {
		singleTabsIconsColor.forEach((icon) => {
			icon.classList.remove('active')
			icon.classList.add('hidden')
		})
		singleTabsIconsGray.forEach((icon) => {
			icon.classList.remove('hidden')
			icon.classList.add('active')
		})
		singleTabsImages.forEach((image) => {
			image.classList.remove('active')
		})
		carouselIndicators.forEach((indicator) => {
			indicator.classList.remove('active')
		})

		singleTabsIconsGray[index].classList.add('hidden')
		singleTabsIconsGray[index].classList.remove('active')

		singleTabsIconsColor[index].classList.add('active')
		singleTabsIconsColor[index].classList.remove('hidden')

		singleTabsImages[index].classList.add('active')

		carouselIndicators[index].classList.add('active')
	})
}

for (const [index, indicator] of carouselIndicators.entries()) {
	indicator.addEventListener('click', function () {
		console.log('clicked')
		singleTabsIconsColor.forEach((icon) => {
			icon.classList.remove('active')
			icon.classList.add('hidden')
		})
		singleTabsIconsGray.forEach((icon) => {
			icon.classList.remove('hidden')
			icon.classList.add('active')
		})
		singleTabsImages.forEach((image) => {
			image.classList.remove('active')
		})
		carouselIndicators.forEach((indicator) => {
			indicator.classList.remove('active')
		})
		singleTabsCarousel.forEach((tab) => {
			tab.classList.add('hidden')
		})

		singleTabsIconsGray[index].classList.add('hidden')
		singleTabsIconsGray[index].classList.remove('active')

		singleTabsIconsColor[index].classList.add('active')
		singleTabsIconsColor[index].classList.remove('hidden')

		singleTabsImages[index].classList.add('active')

		carouselIndicators[index].classList.add('active')

		singleTabsCarousel[index].classList.remove('hidden')
	})
}

//// Cases Slider
const casesIndicators = document.querySelector(
	'#cases-slider .left-side .carousel-indicators'
)
const casesArrowsIndicators = document.querySelectorAll(
	'#cases-slider .right-side .carousel-indicators button'
)
console.log(casesArrowsIndicators)
casesIndicators.addEventListener('click', function (e) {
	const indexClicked = e.target.dataset.bsSlideTo
	casesArrowsIndicators[indexClicked].click()
})

//// Slick Slider

jQuery(document).ready(function ($) {
	// Your code here
	$('.articles-responsive').slick({
		infinite: false,
		arrows: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		],
	})
})

// MODAL
jQuery(document).ready(function ($) {
	// Gets the video src from the data-src on each button

	var $videoSrc
	$('.video-btn').click(function () {
		$videoSrc = $(this).data('src')
	})

	// when the modal is opened autoplay it
	$('#myModal').on('shown.bs.modal', function (e) {
		// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
		$('#video').attr(
			'src',
			$videoSrc + '?autoplay=1&amp;modestbranding=1&amp;showinfo=0'
		)
	})

	// stop playing the youtube video when I close the modal
	$('#myModal').on('hide.bs.modal', function (e) {
		// a poor man's stop video
		$('#video').attr('src', $videoSrc)
	})

	// document ready
})
