'use strict'
console.log('SCRIPT ALIVE')

const singleTabs = document.querySelectorAll('.single-tab-wrapper')
const singleTabsIconsColor = document.querySelectorAll('.tab-icon-color')
const singleTabsIconsGray = document.querySelectorAll('.tab-icon-gray')
const singleTabsImages = document.querySelectorAll(
	'#tabbed-slider .carousel-item'
)
const carouselIndicators = document.querySelectorAll(
	'.carousel-indicators button'
)
console.log(singleTabs)
console.log(singleTabsIconsColor)

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
