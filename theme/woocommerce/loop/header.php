<?php
/**
 * Product taxonomy archive header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

?>
<header class="woocommerce-products-header mb-6">
	<?php
	/**
	 * Hook: woocommerce_show_page_title.
	 *
	 * Allow developers to remove the product taxonomy archive page title.
	 *
	 * @since 2.0.6.
	 */
	if (apply_filters('woocommerce_show_page_title', true)):
		?>
		<h1 class="woocommerce-products-header__title page-title uppercase text-2xl mb-3"><?php woocommerce_page_title(); ?>
		</h1>
	<?php endif; ?>

	<div class="flex flex-col sm:flex-row gap-4">

		<?php if ($shop_img = wooprj_get_shop_thumb()): ?>
			<div class="max-w-[140px]">
				<?php echo $shop_img; ?>
			</div>
		<?php endif; ?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @since 1.6.2.
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action('woocommerce_archive_description');
		?>
	</div>
</header>