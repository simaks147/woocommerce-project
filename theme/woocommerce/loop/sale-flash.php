<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<div class="supply absolute top-8 right-10">
	<?php if ($product->is_on_sale()): ?>

		<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale badge badge-accent">' . esc_html__('Sale', 'wooprj') . '</span>', $post, $product); ?>

		<?php
	endif;

	if ($product->is_featured()):
		?>
		<span class="featured badge badge-primary"><?php _e('Hit', 'wooprj') ?></span>
		<?php
	endif;
	?>
</div> <!-- /.supply -->
<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */