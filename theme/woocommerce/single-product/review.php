<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>
<div <?php comment_class('card card-border bg-base-100 mb-6'); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>" class="card-body comment_container">
		<div class="c-comment-info relative ">
			<?php
			/**
			 * The woocommerce_review_before hook
			 *
			 * @hooked woocommerce_review_display_gravatar - 10
			 */
			do_action('woocommerce_review_before', $comment);
			?>
			<div class="c-comment-review-meta absolute right-0 top-0">

				<?php
				/**
				 * The woocommerce_review_meta hook.
				 *
				 * @hooked woocommerce_review_display_meta - 10
				 */
				do_action('woocommerce_review_meta', $comment);

				/**
				 * The woocommerce_review_before_comment_meta hook.
				 *
				 * @hooked woocommerce_review_display_rating - 10
				 */
				do_action('woocommerce_review_before_comment_meta', $comment);
				?>
			</div> <!-- .c-comment-review-meta -->
		</div> <!-- .c-comment-info -->

		<div class="comment-text">
			<?php
			do_action('woocommerce_review_before_comment_text', $comment);

			/**
			 * The woocommerce_review_comment_text hook
			 *
			 * @hooked woocommerce_review_display_comment_text - 10
			 */
			do_action('woocommerce_review_comment_text', $comment);

			do_action('woocommerce_review_after_comment_text', $comment);
			?>
		</div><!-- .comment-text -->
	</div><!-- .card-body comment_container -->