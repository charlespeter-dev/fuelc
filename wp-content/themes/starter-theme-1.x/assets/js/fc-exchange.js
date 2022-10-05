let loadMoreBtn = document.getElementById('load-more-btn')
console.log(loadMoreBtn)
let showMoreArea = document.getElementById('load-more-area')
loadMoreBtn.addEventListener('click', function () {
	console.log('OK')
	showMoreArea.style.display = 'grid'
	showMoreArea.style.height = '100%'
	showMoreArea.style.opacity = '1'
	loadMoreBtn.style.display = 'none'
	showMoreArea.style.transition = 'height 1s, opacity 2s'
})
