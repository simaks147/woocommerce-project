<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
	return;
}
?>
<!-- <div class="swiper-slide"> -->
<div <?php wc_product_class('card bg-base-100 w-88 shadow-md swiper-slide h-auto!', $product); ?>>
	<div
		class="c-ajax-loader absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center bg-white/50 invisible">
		<span class="loading loading-ring loading-xl"></span>
	</div>

	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action('woocommerce_before_shop_loop_item');

	?>
	<figure class="p-6">
		<a href="<?php the_permalink(); ?>">
			<?php

			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_before_shop_loop_item_title - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action('woocommerce_before_shop_loop_item_title');

			?>
		</a>
	</figure>

	<div class="card-body">
		<?php

		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action('woocommerce_shop_loop_item_title');

		?>
		<div class="description"><?php the_content('') ?></div>

		<?php
		woocommerce_template_loop_rating();

		?>

		<div class="card-actions flex flex-col items-center mt-auto">
			<?php

			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action('woocommerce_after_shop_loop_item_title');



			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action('woocommerce_after_shop_loop_item');

			?>
		</div> <!-- /.card-actions-->
	</div> <!-- /.card-body -->
</div> <!-- /.card -->
<!-- </div> /.swiper-slide -->