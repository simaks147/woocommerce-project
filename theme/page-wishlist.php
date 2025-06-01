<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package woo-project-theme
 */

get_header();
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>

<div class="c-wishlist">
	<div class="l-container pt-5">
		<h2 class="uppercase text-2xl mb-3"><?php _e('Wishlist', 'wooprj'); ?></h2>
		<?php
		if (!is_user_logged_in()) {
			_e('You are not logged in', 'wooprj');

		} else {
			//for authorized users and database without cookies (for all users without authorization and database, but with cookies, use function 'wooprj_get_wishlist' instead WISHLIST)
			$wishlist = implode(',', WISHLIST);

			if ($wishlist) {
				echo do_shortcode("[products ids='$wishlist' limit='8']");
			} else {
				_e('Your wishlist is empty', 'wooprj');
			}
		}
		?>
	</div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

get_footer();

