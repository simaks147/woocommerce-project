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

get_header(); ?>

<div class="content-area">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			the_title();
			the_content();
		}
	} else {
		echo 'Записей нет';
	}
	?>
</div><!-- .content-area -->

<?php get_footer();

