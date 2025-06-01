<!doctype html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="wrap" class="flex flex-col min-h-[100vh]">
		<main id="main" class="flex-auto">

			<div class=" c-header-top">
				<div class="l-container py-2">
					<div class="flex justify-between items-center">
						<div>
							<?php if (!empty(get_theme_mod('wooprj_phone'))): ?>
								<a href="tel:<?= get_theme_mod('wooprj_phone') ?>">
									<span class="dashicons dashicons-phone mr-2"></span>
									<?= get_theme_mod('wooprj_phone') ?>
								</a>
							<?php endif; ?>
						</div>
						<div class="flex gap-2">
							<?php if (!empty(get_theme_mod('wooprj_youtube'))): ?>
								<a href="<?= get_theme_mod('wooprj_youtube') ?>">
									<span class="dashicons dashicons-youtube text-3xl w-[30px] h-[30px] text-red-500"></span>
								</a>
							<?php endif; ?>
							<?php if (!empty(get_theme_mod('wooprj_facebook'))): ?>
								<a href="<?= get_theme_mod('wooprj_facebook') ?>">
									<span class="dashicons dashicons-facebook text-3xl w-[30px] h-[30px] text-blue-500"></span>
								</a>
							<?php endif; ?>
							<?php if (!empty(get_theme_mod('wooprj_instagram'))): ?>
								<a href="<?= get_theme_mod('wooprj_instagram') ?>">
									<span class="dashicons dashicons-instagram text-3xl w-[30px] h-[30px] text-pink-500"></span>
								</a>
							<?php endif; ?>
						</div>
						<div>
							<a href="<?= wc_logout_url() ?>"
								class="btn btn-secondary"><?= is_user_logged_in() ? 'Logout' : 'Login'; ?></a>
						</div>

					</div>
				</div>
			</div>

			<div class="c-header-main">
				<div class="l-container py-6 flex justify-between items-center">

					<div class="c-hrader-logo text-4xl">
						<a href="<?= home_url('/'); ?>"><?php bloginfo('name'); ?></a>
					</div>

					<div class="c-header-search">
						<?php aws_get_search_form(true); ?>
					</div>

				</div>
			</div>

			<div class="c-header-bottom bg-secondary">
				<div class="l-container py-2 flex justify-between items-center relative z-2">

					<nav class="c-header-nav">
						<div class="max-md:dropdown md:invisible">
							<div tabindex="0" role="button" class="btn btn-ghost md:hidden">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
								</svg>
							</div>
							<?php
							wp_nav_menu(array(
								'theme_location' => 'header-menu',
								'container' => false,
								'menu_class' => 'menu max-md:menu-md dropdown-content max-md:bg-base-100 
																max-md:rounded-box max-md:z-1 max-md:mt-3 max-md:w-52 max-md:p-2 
																max-md:shadow md:visible md:menu-horizontal md:px-1 md:flex',
								'walker' => new Wooprj_Header_Menu(),
							));
							?>
						</div>
					</nav>

					<a href="<?= get_permalink(get_page_by_path('wishlist')) ?>" class="ml-auto mr-4">
						<span class="align-middle dashicons dashicons-heart"></span>
					</a>

					<?php if (!is_cart()): ?>
						<div class="c-basket-drawer drawer-end drawer w-auto">
							<input id="basket-drawer" type="checkbox" class="drawer-toggle" />
							<div class="drawer-content">
								<label for="basket-drawer" class="drawer-button flex items-center gap-1 cursor-pointer">
									<span class="dashicons dashicons-cart text-white"></span>
									<span
										class="c-basket-drawer-badge badge badge-sm badge-accent"><?php echo count(WC()->cart->get_cart()); ?></span>
								</label>
							</div>
							<div class="drawer-side">
								<label for="basket-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
								<?php woocommerce_mini_cart() ?>
							</div>
						</div>
					<?php endif; ?>

				</div>
			</div>