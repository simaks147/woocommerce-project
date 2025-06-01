<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

?>
<div class="c-single-product-notices">
	<div class="l-container pt-4 pb-4">
		<?php

		/**
		 * Hook: woocommerce_before_single_product.
		 *
		 * @hooked woocommerce_output_all_notices - 10
		 */
		do_action('woocommerce_before_single_product');

		?>
	</div>
</div>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('c-product', $product); ?>>
	<div class="l-container flex flex-wrap flex-col md:flex-row gap-6 pt-0">

		<div class="c-product-image w-[300px]">
			<div class="swiper">
				<div class="swiper-wrapper" id="lightgallery">
					<?php
					$product_img_id = $product->get_image_id();
					$gallery_img_ids = $product->get_gallery_image_ids();

					if ($product_img_id) {
						$main_img = wp_get_attachment_image_src($product_img_id, 'medium')[0];
						$zomm_img = wp_get_attachment_image_src($product_img_id, 'full')[0];
					} else {
						$main_img = wc_placeholder_img_src('medium');
					}
					?>

					<a href="<?= $zomm_img; ?>" class="swiper-slide">
						<img src="<?= $main_img; ?>" alt="<?= $product->get_title(); ?>">
					</a>

					<?php if ($gallery_img_ids): ?>
						<?php foreach ($gallery_img_ids as $img_id): ?>
							<a href="<?= wp_get_attachment_image_src($img_id, 'full')[0]; ?>" class="swiper-slide">
								<img src="<?= wp_get_attachment_image_src($img_id, 'medium')[0]; ?>" alt="<?= $product->get_title(); ?>">
							</a>
						<?php endforeach; ?>
					<?php endif; ?>

				</div> <!-- /.swiper-wrapper -->
				<div class="swiper-button-prev text-secondary! font-bold"></div>
				<div class="swiper-button-next text-secondary! font-bold"></div>
			</div><!-- /.swiper -->
		</div><!-- /.c-product-image -->

		<div class="c-product-summary">
			<div class="summary entry-summary">
				<?php
				woocommerce_show_product_sale_flash();

				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action('woocommerce_single_product_summary');
				?>
			</div>
		</div><!-- /.c-product-summary -->

		<div class="c-product-info w-full">
			<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action('woocommerce_after_single_product_summary');
			?>
		</div><!-- /.c-product-info -->

	</div><!-- /.l-container -->
</div> <!-- /.c-product -->

<?php do_action('woocommerce_after_single_product'); ?>