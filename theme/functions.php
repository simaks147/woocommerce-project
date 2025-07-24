<?php

if (!defined('WOOPRJ_VERSION')) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define('WOOPRJ_VERSION', '0.1.0');
}

if (!defined('WOOPRJ_TYPOGRAPHY_CLASSES')) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `wooprj_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'WOOPRJ_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if (!function_exists('wooprj_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wooprj_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on woo-project-theme, use a find and replace
		 * to change 'woo-project-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('wooprj', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'header-menu' => __('Header menu', 'woo-project-theme'),
				'footer-menu' => __('Footer menu', 'woo-project-theme'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments 
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		// add_editor_style('style-editor.css');
		// add_editor_style('style-editor-extra.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Remove support for block templates.
		remove_theme_support('block-templates');



		// woocommerce support
		add_theme_support('woocommerce');
		// add_theme_support('wc-product-gallery-zoom');
		// add_theme_support('wc-product-gallery-lightbox');
		// add_theme_support('wc-product-gallery-slider');


		// custom thumbnails sizes
		add_image_size('wooprj-featured-image', 1600, 600, true);
	}
endif;
add_action('after_setup_theme', 'wooprj_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wooprj_widgets_init()
{
	register_sidebar(
		array(
			'name' => __('Sidebar', 'wooprj'),
			'id' => 'sidebar-1',
			'description' => __('Add widgets here to appear in your sidebar.', 'wooprj'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'wooprj_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function wooprj_scripts()
{
	wp_enqueue_style('woo-project-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), WOOPRJ_VERSION);
	wp_enqueue_style('woo-project-lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery@2.8.3/css/lightgallery-bundle.min.css', array(), WOOPRJ_VERSION);
	wp_enqueue_style('woo-project-theme-style', get_stylesheet_uri(), array(), WOOPRJ_VERSION);


	wp_enqueue_script('woo-project-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), WOOPRJ_VERSION, true);
	wp_enqueue_script('woo-project-lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery@2.8.3/lightgallery.umd.min.js', array(), WOOPRJ_VERSION, true);
	wp_enqueue_script('woo-project-theme-script', get_template_directory_uri() . '/js/script.min.js', array(), WOOPRJ_VERSION, true);

	wp_localize_script('woo-project-theme-script', 'wooprj_wishlist_obj', array(
		'is_auth' => is_user_logged_in(),
		'need_auth' => __('You need to login first', 'wooprj'),
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('wooprj_wishlist_nonce'),
		'rest_url' => esc_url_raw(rest_url() . 'wishlist/v1/products'),
		'rest_nonce' => wp_create_nonce('wp_rest')
	));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'wooprj_scripts');

/**
 * Enqueue the block editor script.
 */
function wooprj_enqueue_block_editor_script()
{
	if (is_admin()) {
		wp_enqueue_script(
			'woo-project-theme-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			WOOPRJ_VERSION,
			true
		);
		wp_add_inline_script('woo-project-theme-editor', "tailwindTypographyClasses = '" . esc_attr(WOOPRJ_TYPOGRAPHY_CLASSES) . "'.split(' ');", 'before');
	}
}
add_action('enqueue_block_assets', 'wooprj_enqueue_block_editor_script');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function wooprj_tinymce_add_class($settings)
{
	$settings['body_class'] = WOOPRJ_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter('tiny_mce_before_init', 'wooprj_tinymce_add_class');


// utils functions
require_once get_template_directory() . '/inc/utils-functions.php';

// woocommerce hooks
require_once get_template_directory() . '/inc/woocommerce-hooks.php';

// header menu
require_once get_template_directory() . '/inc/class-wooprj-header-menu.php';

// customizer
require_once get_template_directory() . '/inc/customizer.php';

// custom post types
require_once get_template_directory() . '/inc/custom-post-types.php';

// wishlist
// require_once get_template_directory() . '/inc/wishlist.php';

// wishlist api
require_once get_template_directory() . '/inc/wishlist-api.php';
