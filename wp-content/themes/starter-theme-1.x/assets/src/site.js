// Header.js

/* Show and hide Sub Nav Area 1 */
const nav_link_1 = document.getElementById('nav-link-1')
const sub_nav_area_1 = document.getElementById('sub-nav-area-1')
nav_link_1.addEventListener('mouseover' || 'click', function () {
	sub_nav_area_4.style.display = 'none'
	sub_nav_area_3.style.display = 'none'
	sub_nav_area_2.style.display = 'none'
	sub_nav_area_1.style.display = 'block'
})
sub_nav_area_1.addEventListener('mouseleave', function () {
	sub_nav_area_1.style.display = 'none'
})

/* Show and hide Sub Nav Area 2 */
const nav_link_2 = document.getElementById('nav-link-2')
const sub_nav_area_2 = document.getElementById('sub-nav-area-2')
nav_link_2.addEventListener('mouseover', function () {
	sub_nav_area_4.style.display = 'none'
	sub_nav_area_3.style.display = 'none'
	sub_nav_area_2.style.display = 'block'
	sub_nav_area_1.style.display = 'none'
})
sub_nav_area_2.addEventListener('mouseleave', function () {
	sub_nav_area_2.style.display = 'none'
})

/* Show and hide Sub Nav Area 3 */
const nav_link_3 = document.getElementById('nav-link-3')
const sub_nav_area_3 = document.getElementById('sub-nav-area-3')
nav_link_3.addEventListener('mouseover', function () {
	sub_nav_area_4.style.display = 'none'
	sub_nav_area_3.style.display = 'block'
	sub_nav_area_2.style.display = 'none'
	sub_nav_area_1.style.display = 'none'
})
sub_nav_area_3.addEventListener('mouseleave', function () {
	sub_nav_area_3.style.display = 'none'
})

/* Show and hide Sub Nav Area 4 */
const nav_link_4 = document.getElementById('nav-link-4')
const sub_nav_area_4 = document.getElementById('sub-nav-area-4')
nav_link_4.addEventListener('mouseover', function () {
	sub_nav_area_4.style.display = 'block'
	sub_nav_area_3.style.display = 'none'
	sub_nav_area_2.style.display = 'none'
	sub_nav_area_1.style.display = 'none'
})
sub_nav_area_4.addEventListener('mouseleave', function () {
	sub_nav_area_4.style.display = 'none'
})

/* hide Sub Nav Areas on hover of link 5 (contact) */
const nav_link_5 = document.getElementById('nav-link-5')
nav_link_5.addEventListener('mouseover', function () {
	sub_nav_area_4.style.display = 'none'
	sub_nav_area_3.style.display = 'none'
	sub_nav_area_2.style.display = 'none'
	sub_nav_area_1.style.display = 'none'
})

/* Mobile Menu */
function darken_screen(yesno) {
	if (yesno == true) {
		document.querySelector('.screen-darken').classList.add('active')
	} else if (yesno == false) {
		document.querySelector('.screen-darken').classList.remove('active')
	}
}

function close_offcanvas() {
	darken_screen(false)
	const allCanvas = document.querySelectorAll('.mobile-offcanvas.show')
	allCanvas.forEach(function (canvas) {
		canvas.classList.remove('show')
	})
	document.body.classList.remove('offcanvas-active')
}
function close_offcanvas_single_layer() {
	const allCanvasSingleLayer = document.querySelector(
		'.mobile-offcanvas.level-2.show'
	)
	allCanvasSingleLayer.classList.remove('show')
}

function show_offcanvas(offcanvas_id) {
	darken_screen(true)
	document.getElementById(offcanvas_id).classList.add('show')
	document.body.classList.add('offcanvas-active')
}

var mobileNavOpen = false

document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('[data-trigger]').forEach(function (everyelement) {
		let offcanvas_id = everyelement.getAttribute('data-trigger')

		everyelement.addEventListener('click', function (e) {
			e.preventDefault()
			show_offcanvas(offcanvas_id)
		})
	})
	document
		.querySelectorAll('.mobile-btn-close')
		.forEach(function (everybutton) {
			everybutton.addEventListener('click', function (e) {
				e.preventDefault()
				close_offcanvas()
				mobileNavOpen = false
			})
		})
	document
		.getElementById('hamburger-menu-icon')
		.addEventListener('click', function (e) {
			if (mobileNavOpen === false) {
				e.preventDefault()
				mobileNavOpen = true
			} else {
				e.preventDefault()
				close_offcanvas()
				mobileNavOpen = false
			}
		})
	document
		.querySelectorAll('.mobile-btn-back')
		.forEach(function (everybutton) {
			everybutton.addEventListener('click', function (e) {
				e.preventDefault()
				close_offcanvas_single_layer()
				mobileNavOpen = false
			})
		})

	document
		.querySelector('.screen-darken')
		.addEventListener('click', function (event) {
			close_offcanvas()
			mobileNavOpen = false
		})
})
// DOMContentLoaded  end

/* Mobile Menu Links */
/* Link 1 (left to right on desktop) */
const navLink1 = document.getElementById('mobile-nav-link-1')
navLink1.setAttribute('data-trigger', 'mobile_nav_submenu_1')

/* Link 2 */
const navLink2 = document.getElementById('mobile-nav-link-2')
navLink2.setAttribute('data-trigger', 'mobile_nav_submenu_2')

/* Link 3 */
const navLink3 = document.getElementById('mobile-nav-link-3')
navLink3.setAttribute('data-trigger', 'mobile_nav_submenu_3')

/* Link 3 */
const navLink4 = document.getElementById('mobile-nav-link-4')
navLink4.setAttribute('data-trigger', 'mobile_nav_submenu_4')

/* Hide all subnavs for mobile and tablet */
/* Toggle MobileNav when enlarging screen */
let screenSize = screen.width
window.onresize = hideSubnavs
function hideSubnavs() {
	// console.log('screen resizing!');
	if (screenSize < 992) {
		sub_nav_area_4.style.display = 'none'
		sub_nav_area_3.style.display = 'none'
		sub_nav_area_2.style.display = 'none'
		sub_nav_area_1.style.display = 'none'
	} else {
	}
}
// Change Header / Navbar color on scroll
// jQuery(function () {
// 	jQuery(document).scroll(function () {
// 		var $nav = jQuery('#main-navbar')
// 		$nav.toggleClass('scrolled', jQuery(this).scrollTop() > $nav.height())
// 	})
// })
window.onscroll = function () {
	scrollFunction()
}
function scrollFunction() {
	if (
		document.body.scrollTop > 20 ||
		document.documentElement.scrollTop > 20
	) {
		document.getElementById('main-navbar').style.background = 'white'
	} else {
		document.getElementById('main-navbar').style.background = 'none'
	}
}

const originalLogoSrc = document.querySelector('.nav-logo').src
console.log(originalLogoSrc)

// Change Navbar Logo on Scroll
jQuery(function () {
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 650) {
			jQuery('.nav-logo').attr(
				'src',
				'https://fuelcyclettc.wpengine.com/wp-content/uploads/2021/12/fuelcycle_logo_sm@2x-e1645824041694.png'
			)

			jQuery('#main-navbar .nav-link').addClass('hidden')
			jQuery('.nav-icon img').addClass('hidden')
			jQuery(
				'#main-navbar .nav-container .nav-item.menu-expand'
			).removeClass('hidden')
			jQuery('#main-navbar .nav-container .nav-item.menu-expand').click(
				function () {
					jQuery('#main-navbar .nav-link').removeClass('hidden')
					jQuery('.nav-icon img').removeClass('hidden')
					jQuery(
						'#main-navbar .nav-container .nav-item.menu-expand'
					).addClass('hidden')
				}
			)
		}
		if (jQuery(this).scrollTop() < 650) {
			jQuery('.nav-logo').attr('src', `${originalLogoSrc}`)

			jQuery('#main-navbar .nav-link').removeClass('hidden')
			jQuery('.nav-icon img').removeClass('hidden')
			jQuery('#main-navbar .nav-container .nav-item.menu-expand').addClass(
				'hidden'
			)
		}
	})
})

// Change Nav Orange Arrow on Hover

function hover(element) {
	element.setAttribute(
		'src',
		'http://fcwp.local/wp-content/uploads/2021/12/arrow-right-purple.svg'
	)
}

function unhover(element) {
	element.setAttribute(
		'src',
		'http://fcwp.local/wp-content/uploads/2021/12/arrow-right-orange-1.svg'
	)
}

// Back to Top Arrow
const backToTopArrow = document.querySelector('.back-to-top-icon')
backToTopArrow.addEventListener('click', function () {
	document.body.scrollTop = 0 // For Safari
	document.documentElement.scrollTop = 0 // For Chrome, Firefox, IE and Opera
})
