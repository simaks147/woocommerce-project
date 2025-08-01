<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)): ?>

	<div class="tabs tabs-lift">
		<?php $i = 0;
		foreach ($product_tabs as $key => $product_tab): ?>

			<input type="radio" name="<?php echo "product_info_tab" ?>" class="tab" <?php if ($i === 0)
					 echo "checked"; ?>
				aria-label="<?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?>" />
			<div class="tab-content border-base-300 bg-base-100 p-10">
				<?php
				if (isset($product_tab['callback'])) {
					call_user_func($product_tab['callback'], $key, $product_tab);
				}
				?>
			</div>

			<?php $i++; endforeach; ?>
	</div>

	<?php do_action('woocommerce_product_after_tabs'); ?>

<?php endif; ?>