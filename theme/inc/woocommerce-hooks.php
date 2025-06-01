<?php

// remove WooCommerce styles
add_filter('woocommerce_enqueue_styles', '__return_false');

// product card
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', function () {
  echo '<h2 class="card-title">' . get_the_title() . '</h2>';
}, 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_filter('woocommerce_product_get_rating_html', function ($html, $rating, $count) {
  global $product;
  $html = '';

  if (0 < $rating) {
    /* translators: %s: rating */
    $label = sprintf(__('Rated %s out of 5', 'woocommerce'), $rating);
    $html = '<div class="rating-wrap flex items-center gap-2"><span class="star-rating" role="img" aria-label="' . esc_attr($label) . '">' . wc_get_star_rating_html($rating, $count) . '</span><span class="review-count">(' . $product->get_rating_count() . ')</span></div>';
    ;
  }

  return $html;
}, 10, 3);

// custom shortcode
add_shortcode('wooprj_recent_products', 'wooprj_recent_products');
function wooprj_recent_products($atts)
{
  global $woocommerce_loop, $woocommerce;

  extract(shortcode_atts(array(
    'limit' => '12',
    'orderby' => 'date',
    'order' => 'DESC'
  ), $atts));

  $args = array(
    'post_status' => 'publish',
    'post_type' => 'product',
    'posts_per_page' => $limit,
    'orderby' => $orderby,
    'order' => $order
  );

  ob_start();

  $products = new WP_Query($args);

  if ($products->have_posts()): ?>

    <?php while ($products->have_posts()):
      $products->the_post(); ?>

      <?php wc_get_template_part('content', 'recent-product'); ?>

    <?php endwhile; ?>

  <?php endif;

  wp_reset_postdata();

  return '<div class="woocommerce">
  <div class="swiper">
  <div class="swiper-wrapper">' . ob_get_clean() . '</div>
  <div class="swiper-pagination relative! top-1!"></div></div></div>';
}

// Show cart contents / total Ajax
add_filter('woocommerce_add_to_cart_fragments', 'wooprj_header_add_to_cart_fragment');
function wooprj_header_add_to_cart_fragment($fragments)
{
  $fragments['.c-basket-drawer-badge'] = '<span class="c-basket-drawer-badge badge badge-sm badge-accent">' . count(WC()->cart->get_cart()) . '</span>';
  return $fragments;
}

//Change several of the breadcrumb defaults
add_filter('woocommerce_breadcrumb_defaults', 'wooprj_woocommerce_breadcrumbs');
function wooprj_woocommerce_breadcrumbs()
{
  return array(
    'delimiter' => '',
    'wrap_before' => '<div class="c-breadcrumbs"><div class="l-container py-6"><div class="breadcrumbs text-sm"><ul>',
    'wrap_after' => '</ul></div></div></div>',
    'before' => '<li>',
    'after' => '</li>',
    'home' => __('Home', 'wooprj'),
  );
}

// Add shop thumbnail to category page 
function wooprj_get_shop_thumb()
{
  $html = '';

  if (is_product_category()) {
    global $wp_query;
    $cat = $wp_query->get_queried_object();
    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
    $image = wp_get_attachment_url($thumbnail_id);
    if ($image) {
      $html .= '<img src="' . $image . '" alt="' . $cat->name . '" />';
    }
  }

  return $html;
}

// remove notices block
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);

// remove category title
remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
add_action('woocommerce_shop_loop_subcategory_title', function ($category) {
  echo "<h5 class='mt-2'>{$category->name} <span class='text-accent'>({$category->count})</span></h5>";
}, 10);

// remove sidebar from single product page
add_action('template_redirect', function () {
  if (is_product()) {
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
  }
});

// override default address fields for checkout form
add_filter('woocommerce_default_address_fields', 'wooprj_woocommerce_default_address_fields');
function wooprj_woocommerce_default_address_fields($fields)
{
  unset($fields['postcode'], $fields['address_2']);
  return $fields;
}

add_filter('woocommerce_min_password_strength', function () {
  return 0;
});