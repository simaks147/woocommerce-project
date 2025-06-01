/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

import recentProductSlider from './components/recent-products-slider';
import productSlider from './components/product-slider';
import cart from './components/cart';
import wishlist from './components/wishlist';

// for native js
document.addEventListener('DOMContentLoaded', () => {
	recentProductSlider();
	productSlider();
});

// for jquery functions and etc.
window.jQuery(document).ready(function () {
	cart();
	wishlist();
});
