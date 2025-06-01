export default function () {
	new window.Swiper('.c-recent-products .swiper', {
		width: 352,
		spaceBetween: 16,
		keyboard: {
			enabled: true,
			onlyInViewport: false,
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		},
	});
}
