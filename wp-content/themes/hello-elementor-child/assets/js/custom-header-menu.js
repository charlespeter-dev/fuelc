/**
 * Top Nav
 * 
 * is now is based on Menu ID from Apprearance > Menus
 * print wp_get_nav_menu_items('main-menu') to get the IDs
 * 
 * 14 - Products
 * 15 - Solutions
 * 32354 - Industies
 * 16 - Resource Hub
 * 17 - Company
 * 18 - Contact
 * 
 ***/

document.addEventListener('DOMContentLoaded', function () {

	const mainmenus = document.querySelectorAll('[id^="nav-link-"]');
	const submenus = document.querySelectorAll('[id^="sub-nav-area-"]');

	function closeSubmenus() {
		submenus.forEach(function (submenu) {
			submenu.style.display = 'none';
		});
	}

	mainmenus.forEach(function (mainmenu) {
		const id = mainmenu.dataset.id;
		const submenu = document.querySelector(`#sub-nav-area-${id}`) ?? null;
		mainmenu.addEventListener('mouseover', function (e) {
			e.stopPropagation();
			closeSubmenus();
			if (submenu) {
				submenu.style.display = 'flex';
			}
		});
	});

	submenus.forEach(function (submenu) {
		submenu.addEventListener('mouseleave', function (e) {
			e.stopPropagation();
			closeSubmenus();
		});
	});
});



// /* Products */

// products_main.addEventListener('mouseover', function () {
// 	solutions_subm.style.display = 'none';
// 	resource_subm.style.display = 'none';
// 	company_subm.style.display = 'none';
// });

// products_subm.addEventListener('mouseleave', function () {
// 	products_subm.style.display = 'none'
// });

// /* Solutions */

// nav_link_2.addEventListener('mouseover', function () {
// 	sub_nav_area_4.style.display = 'none'
// 	sub_nav_area_3.style.display = 'none'
// 	sub_nav_area_2.style.display = 'block'
// 	sub_nav_area_1.style.display = 'none'
// })
// sub_nav_area_2.addEventListener('mouseleave', function () {
// 	sub_nav_area_2.style.display = 'none'
// })

// /* Industies */


// nav_link_32354.addEventListener('mouseover', function () {
// 	sub_nav_area_4.style.display = 'none'
// 	sub_nav_area_2.style.display = 'none'
// 	sub_nav_area_1.style.display = 'none'
// })
// sub_nav_area_32354.addEventListener('mouseleave', function () {
// 	sub_nav_area_32354.style.display = 'none'
// })

// /* Resource Hub */

// nav_link_3.addEventListener('mouseover', function () {
// 	sub_nav_area_4.style.display = 'none'
// 	sub_nav_area_3.style.display = 'block'
// 	sub_nav_area_2.style.display = 'none'
// 	sub_nav_area_1.style.display = 'none'
// })
// sub_nav_area_3.addEventListener('mouseleave', function () {
// 	sub_nav_area_3.style.display = 'none'
// })

// /* Company */

// nav_link_4.addEventListener('mouseover', function () {
// 	sub_nav_area_4.style.display = 'block'
// 	sub_nav_area_3.style.display = 'none'
// 	sub_nav_area_2.style.display = 'none'
// 	sub_nav_area_1.style.display = 'none'
// })
// sub_nav_area_4.addEventListener('mouseleave', function () {
// 	sub_nav_area_4.style.display = 'none'
// })

// /* Contact */

// nav_link_5.addEventListener('mouseover', function () {
// 	sub_nav_area_4.style.display = 'none'
// 	sub_nav_area_3.style.display = 'none'
// 	sub_nav_area_2.style.display = 'none'
// 	sub_nav_area_1.style.display = 'none'
// })

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
	console.log(offcanvas_id);
	darken_screen(true)
	document.getElementById(offcanvas_id).classList.add('show')
	document.body.classList.add('offcanvas-active')
}

var mobileNavOpen = false

document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('[data-trigger]').forEach(function (everyelement) {
		let offcanvas_id = everyelement.getAttribute('data-trigger');

		everyelement.addEventListener('click', function (e) {
			if (offcanvas_id == 'mobile_nav_submenu_18')
				return;

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
		.querySelector('.screen-darken').addEventListener('click', function (event) {
			close_offcanvas()
			mobileNavOpen = false
		})
})
// DOMContentLoaded  end

/* Mobile Menu Links */
/* Link 1 (left to right on desktop) */
// const navLink1 = document.getElementById('mobile-nav-link-14')
// navLink1.setAttribute('data-trigger', 'mobile_nav_submenu_14')

// /* Link 2 */
// const navLink2 = document.getElementById('mobile-nav-link-15')
// navLink2.setAttribute('data-trigger', 'mobile_nav_submenu_15')

// /* Link 3 */
// const navLink3 = document.getElementById('mobile-nav-link-16')
// navLink3.setAttribute('data-trigger', 'mobile_nav_submenu_16')

// /* Link 3 */
// const navLink4 = document.getElementById('mobile-nav-link-17')
// navLink4.setAttribute('data-trigger', 'mobile_nav_submenu_17')

/* Hide all subnavs for mobile and tablet */
/* Toggle MobileNav when enlarging screen */
let screenSize = screen.width
window.onresize = hideSubnavs
function hideSubnavs() {
	// console.log('screen resizing!');
	if (screenSize < 992) {
		const submenus = document.querySelectorAll('[id^="sub-nav-area-"]');
		submenus.forEach(function (submenu) {
			submenu.style.display = 'none';
		});
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
// if (document.body.scrollTop === 0) {
// 	document.getElementById('main-navbar').style.background = 'none'
// }
// window.onscroll = function () {
// 	scrollFunction()
// }
// function scrollFunction() {
// 	if (
// 		document.body.scrollTop > 20 ||
// 		document.documentElement.scrollTop > 20
// 	) {
// 		document.getElementById('main-navbar').style.background = 'white'
// 	} else {
// 		document.getElementById('main-navbar').style.background = 'none'
// 	}
// }

// const originalLogoSrc = document.querySelector('.nav-logo').src
const originalLogoSrc = 'https://fuelcycle.com/wp-content/uploads/2021/12/fuel-cycle-logo.svg';

// Change Navbar Logo on Scroll
// jQuery(function () {
// 	jQuery(window).scroll(function () {
// 		if (jQuery(this).scrollTop() > 650) {
// 			jQuery('.nav-logo').attr(
// 				'src',
// 				'https://fuelcycle.com/wp-content/uploads/2021/12/fuelcycle_logo_sm@2x-e1645824041694.png'
// 			)

// 			jQuery('#main-navbar .nav-link').addClass('hidden')
// 			jQuery('.nav-icon img').addClass('hidden')
// 			jQuery(
// 				'#main-navbar .nav-container .nav-item.menu-expand'
// 			).removeClass('hidden')
// 			jQuery('#main-navbar .nav-container .nav-item.menu-expand').click(
// 				function () {
// 					jQuery('#main-navbar .nav-link').removeClass('hidden')
// 					jQuery('.nav-icon img').removeClass('hidden')
// 					jQuery(
// 						'#main-navbar .nav-container .nav-item.menu-expand'
// 					).addClass('hidden')
// 				}
// 			)
// 		}
// 		if (jQuery(this).scrollTop() < 650) {
// 			jQuery('.nav-logo').attr('src', `${originalLogoSrc}`)

// 			jQuery('#main-navbar .nav-link').removeClass('hidden')
// 			jQuery('.nav-icon img').removeClass('hidden')
// 			jQuery('#main-navbar .nav-container .nav-item.menu-expand').addClass(
// 				'hidden'
// 			)
// 		}
// 	})
// })

// Change Nav Orange Arrow on Hover

function hover(element) {
	element.setAttribute(
		'src',
		'https://fuelcycle.com/wp-content/uploads/2021/12/arrow-right-purple.svg'
	)
}

function unhover(element) {
	element.setAttribute(
		'src',
		'https://fuelcycle.com/wp-content/uploads/2021/12/arrow-right-orange-1.svg'
	)
}

// Back to Top Arrow
document.addEventListener('DOMContentLoaded', function () {
	const backToTopArrow = document.querySelector('.back-to-top-icon');
	backToTopArrow?.addEventListener('click', function () {
		document.body.scrollTop = 0 // For Safari
		document.documentElement.scrollTop = 0 // For Chrome, Firefox, IE and Opera
	});
});

// bsync

(function () {
    try {
        var script = document.createElement('script');
        if ('async') {
            script.async = true;
        }
        script.src = 'https://localhost:5555/browser-sync/browser-sync-client.js?v=3.0.2';
        if (document.body) {
            document.body.appendChild(script);
        } else if (document.head) {
            document.head.appendChild(script);
        }
    } catch (e) {
        console.error("Browsersync: could not append script tag", e);
    }
})()