<?php

// for authorized users and database
add_action('rest_api_init', function () {
  register_rest_route('wishlist/v1', '/products', [
    'methods' => 'POST',
    'callback' => 'wooprj_wishlist_api',
  ]);
});

function wooprj_wishlist_api(WP_REST_Request $request)
{
  $product_id = (int) $_POST['product_id'];
  $product = wc_get_product($product_id);

  if (!$product || $product->get_status() != 'publish') {
    return new WP_Error('error', __('Error product', 'wooprj'), ['status' => 404]);
  }


  global $wpdb;
  $user_id = get_current_user_id();

  $wishlist_data = $wpdb->get_row(
    $wpdb->prepare(
      "SELECT *FROM wp_wishlist WHERE user_id = %d",
      $user_id
    )
  );


  if (!$wishlist_data) {
    if (
      false === $wpdb->insert(
        'wp_wishlist',
        ['user_id' => $user_id, 'products' => $product_id,],
        ['%d', '%d']
      )
    ) {
      return new WP_Error('error', __('Error database', 'wooprj'), ['status' => 500]);
    }
  }


  if ($wishlist_data->products) {
    $wishlist = explode(',', $wishlist_data->products);
  } else {
    $wishlist = [];
  }


  if (false !== ($key = array_search($product_id, $wishlist))) {
    unset($wishlist[$key]);

    $res = rest_ensure_response([
      'code' => 'success',
      'message' => __('The product hase been removed from wishlist', 'wooprj')
    ]);

  } else {
    if (count($wishlist) >= 2) {
      array_shift($wishlist);
    }

    $wishlist[] = $product_id;

    $res = rest_ensure_response([
      'code' => 'success',
      'message' => __('The product hase been added to wishlist', 'wooprj')
    ]);
  }


  $wishlist = implode(',', $wishlist);


  if (
    false === $wpdb->update(
      'wp_wishlist',
      ['products' => $wishlist],
      ['id' => $wishlist_data->id],
      ['%s'],
      ['%d']
    )
  ) {
    return new WP_Error('error', __('Error database', 'wooprj'), ['status' => 500]);
  }


  return $res;
}

function wooprj_get_wishlist_db()
{
  if (!is_user_logged_in()) {
    return [];
  }

  global $wpdb;
  $user_id = get_current_user_id();

  $wishlist_data = $wpdb->get_row(
    $wpdb->prepare(
      "SELECT *FROM wp_wishlist WHERE user_id = %d",
      $user_id
    )
  );

  if (!empty($wishlist_data->products)) {
    return explode(',', $wishlist_data->products);
  }

  return [];
}

define('WISHLIST', wooprj_get_wishlist_db());

function wooprj_in_wishlist_db($product_id)
{
  return in_array($product_id, WISHLIST);
}

function wooprj_create_wishlist_db()
{
  global $wpdb;

  $wpdb->query("CREATE TABLE IF NOT EXISTS `wp_wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `products` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci");
}

wooprj_create_wishlist_db();