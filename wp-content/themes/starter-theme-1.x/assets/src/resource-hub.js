let postExcerpt = document.getElementsByClassName('excerpt');
var i;
for (i = 0; i < postExcerpt.length; i++) {
	let img = document.createElement('img');
	img.src = '/wp-content/uploads/2021/10/subnav-link-arrow.svg';
	img.classList.add('post-result-arrow');
	postExcerpt[i].appendChild(img);
}
