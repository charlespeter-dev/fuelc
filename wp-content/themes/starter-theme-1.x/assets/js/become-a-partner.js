var element_to_scroll_to = document.querySelectorAll('.area-4')[0]

var button = document.getElementById('hero-btn')
button.addEventListener('click', function () {
	element_to_scroll_to.scrollIntoView()
})
