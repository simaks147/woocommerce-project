<?php

// for authorized users and database without cookies
add_action('wp_ajax_wooprj_wishlist_action_db', 'wooprj_wishlist_action_db_cb');
function wooprj_wishlist_action_db_cb()
{
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wooprj_wishlist_nonce')) {
    // wp_send_json_error('Invalid nonce');

    echo json_encode(array(
      'status' => 'error',
      'message' => __('Invalid nonce', 'wooprj'),
    ));

    wp_die();
  }

  $product_id = (int) $_POST['product_id'];
  $product = wc_get_product($product_id);

  if (!$product || $product->get_status() != 'publish') {
    echo json_encode([
      'status' => 'error',
      'message' => __('Error product', 'wooprj')
    ]);

    wp_die();
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
      $wpdb->insert(
        'wp_wishlist',
        ['user_id' => $user_id, 'products' => $product_id,],
        ['%d', '%d']
      )
    ) {
      $res = json_encode([
        'status' => 'success',
        'message' => __('The product hase been added to wishlist', 'wooprj')
      ]);
    } else {
      $res = json_encode([
        'status' => 'error',
        'message' => __('Error database', 'wooprj')
      ]);
    }
  }

  if ($wishlist_data->products) {
    $wishlist = explode(',', $wishlist_data->products);
  } else {
    $wishlist = [];
  }

  if (false !== ($key = array_search($product_id, $wishlist))) {
    unset($wishlist[$key]);

    $res = json_encode([
      'status' => 'success',
      'message' => __('The product hase been removed from wishlist', 'wooprj')
    ]);

  } else {
    if (count($wishlist) >= 2) {
      array_shift($wishlist);
    }

    $wishlist[] = $product_id;

    $res = json_encode([
      'status' => 'success',
      'message' => __('The product hase been added to wishlist', 'wooprj')
    ]);
  }

  $wishlist = implode(',', $wishlist);

  if (
    false !== $wpdb->update(
      'wp_wishlist',
      ['products' => $wishlist],
      ['id' => $wishlist_data->id],
      ['%s'],
      ['%d']
    )
  ) {
    $res = json_encode([
      'status' => 'success',
      'message' => __('The product hase been added to wishlist', 'wooprj')
    ]);
  } else {
    $res = json_encode([
      'status' => 'error',
      'message' => __('Error database', 'wooprj')
    ]);
  }

  wp_die($res);
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


// for all users without authorization and database, but with cookies
add_action('wp_ajax_wooprj_wishlist_action', 'wooprj_wishlist_action_cb');
add_action('wp_ajax_nopriv_wooprj_wishlist_action', 'wooprj_wishlist_action_cb');
function wooprj_wishlist_action_cb()
{
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wooprj_wishlist_nonce')) {
    // wp_send_json_error('Invalid nonce');

    echo json_encode(array(
      'status' => 'error',
      'message' => __('Invalid nonce', 'wooprj'),
    ));

    wp_die();
  }

  $product_id = (int) $_POST['product_id'];
  $product = wc_get_product($product_id);

  if (!$product || $product->get_status() != 'publish') {
    echo json_encode([
      'status' => 'error',
      'message' => __('Error product', 'wooprj')
    ]);

    wp_die();
  }

  $wishlist = wooprj_get_wishlist();

  if (false !== ($key = array_search($product_id, $wishlist))) {
    unset($wishlist[$key]);

    $res = json_encode([
      'status' => 'success',
      'message' => __('The product hase been removed from wishlist', 'wooprj')
    ]);

  } else {
    if (count($wishlist) >= 2) {
      array_shift($wishlist);
    }

    $wishlist[] = $product_id;

    $res = json_encode([
      'status' => 'success',
      'message' => __('The product hase been added to wishlist', 'wooprj')
    ]);
  }

  $wishlist = implode(',', $wishlist);

  setcookie('wooprj_wishlist', $wishlist, time() + 3600 * 24 * 30, '/');

  wp_die($res);
}

function wooprj_get_wishlist()
{
  $wishlist = isset($_COOKIE['wooprj_wishlist']) ? $_COOKIE['wooprj_wishlist'] : [];

  if ($wishlist) {
    $wishlist = explode(',', $wishlist);
  }

  return $wishlist;
}

function wooprj_in_wishlist($product_id)
{
  $wishlist = wooprj_get_wishlist();

  return false !== array_search($product_id, $wishlist);
}