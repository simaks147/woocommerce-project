const $ = window.jQuery;

export default function () {
	// for authorized users and database without cookies
	$('.c-wishlist-icon').on('click', function () {
		const $this = $(this);
		const productId = $this.data('id');
		const ajaxLoader = $this
			.closest('.c-product-card')
			.find('.c-ajax-loader');

		if (!window.wooprj_wishlist_obj.is_auth) {
			alert(window.wooprj_wishlist_obj.need_auth);
			return false;
		}

		$.ajax({
			url: window.wooprj_wishlist_obj.url,
			method: 'POST',
			data: {
				action: 'wooprj_wishlist_action_db',
				nonce: window.wooprj_wishlist_obj.nonce,
				product_id: productId,
			},
			beforeSend: function () {
				ajaxLoader.removeClass('invisible').addClass('visible');
			},
			success: function () {
				if (location.pathname.includes('wishlist')) {
					location.reload();
				}

				ajaxLoader.removeClass('visible').addClass('invisible');
				$this.toggleClass('c-in-wishlist');
			},
			error: function () {
				ajaxLoader.removeClass('visible').addClass('invisible');
				alert('Error');
			},
		});
	});

	// for all users without authorization and database, but with cookies
	$('.c-wishlist-icon2').on('click', function () {
		const $this = $(this);
		const productId = $this.data('id');
		const ajaxLoader = $this
			.closest('.c-product-card')
			.find('.c-ajax-loader');

		$.ajax({
			url: window.wooprj_wishlist_obj.url,
			method: 'POST',
			data: {
				action: 'wooprj_wishlist_action',
				nonce: window.wooprj_wishlist_obj.nonce,
				product_id: productId,
			},
			beforeSend: function () {
				ajaxLoader.removeClass('invisible').addClass('visible');
			},
			success: function () {
				if (location.pathname.includes('wishlist')) {
					location.reload();
				}

				ajaxLoader.removeClass('visible').addClass('invisible');
				$this.toggleClass('c-in-wishlist');
			},
			error: function () {
				ajaxLoader.removeClass('visible').addClass('invisible');
				alert('Error');
			},
		});
	});
}
