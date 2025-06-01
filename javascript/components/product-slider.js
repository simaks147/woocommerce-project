export default function () {
	new window.Swiper('.c-product .swiper', {
		width: 300,
		slidePerView: 1,
		keyboard: {
			enabled: true,
			onlyInViewport: false,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	window.lightGallery(document.getElementById('lightgallery'), {
		// plugins: [lgZoom, lgThumbnail],
		speed: 500,
	});
}
