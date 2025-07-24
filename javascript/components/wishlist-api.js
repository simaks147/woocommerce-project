export default function () {
	// for authorized users and database
	document.querySelectorAll('.c-wishlist-icon').forEach(icon => {
		icon.addEventListener('click', async function () {
			const productId = this.dataset.id;
			const ajaxLoader = this
				.closest('.c-product-card')
				.querySelector('.c-ajax-loader');

			const formdata = new FormData();
			formdata.append('product_id', productId);


			if (!window.wooprj_wishlist_obj.is_auth) {
				alert(window.wooprj_wishlist_obj.need_auth);
				return false;
			}


			ajaxLoader.classList.remove('invisible');
			ajaxLoader.classList.add('visible')

			try {
				await fetch(window.wooprj_wishlist_obj.rest_url, {
					method: 'POST',
					body: formdata,
					headers: {
						'X-WP-Nonce': window.wooprj_wishlist_obj.rest_nonce,
					},
				});

				if (location.pathname.includes('wishlist')) {
					location.reload();
				}

				ajaxLoader.classList.remove('visible');
				ajaxLoader.classList.add('invisible')
				this.classList.toggle('c-in-wishlist');

			} catch {
				ajaxLoader.classList.remove('visible');
				ajaxLoader.classList.add('invisible')
				alert('Error');
			}
		})
	});
}
