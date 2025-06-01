const $ = window.jQuery;

export default function () {
	// Show loader when adding to cart
	$('body').on('adding_to_cart', function (e, btn) {
		btn.closest('.card')
			.find('.c-ajax-loader')
			.removeClass('invisible')
			.addClass('visible');
	});

	$('body').on(
		'added_to_cart',
		function (e, response_fragments, response_cart_hash, btn) {
			setTimeout(function () {
				btn.closest('.card')
					.find('.c-ajax-loader')
					.removeClass('visible')
					.addClass('invisible');
			}, 1000);
		}
	);
}
