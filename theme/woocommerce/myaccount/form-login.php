<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="l-container pt-5">

	<?php

	do_action('woocommerce_before_customer_login_form'); ?>

	<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')): ?>

		<div class=" grid sm:grid-flow-col auto-cols-fr gap-10 u-columns col2-set" id="customer_login">

			<div class="u-column1">

			<?php endif; ?>

			<h2 class="text-xl mb-4 font-bold"><?php esc_html_e('Login', 'woocommerce'); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>

				<?php do_action('woocommerce_login_form_start'); ?>

				<p class="flex flex-col mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span
							class="required" aria-hidden="true">*</span><span
							class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
					<input type="text" class="input woocommerce-Input woocommerce-Input--text input-text" name="username"
						id="username" autocomplete="username"
						value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required
						aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
				</p>
				<p class="flex flex-col mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required"
							aria-hidden="true">*</span><span
							class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
					<input class="input woocommerce-Input woocommerce-Input--text input-text" type="password" name="password"
						id="password" autocomplete="current-password" required aria-required="true" />
				</p>

				<?php do_action('woocommerce_login_form'); ?>

				<p class="form-row">
					<label
						class="block woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox checkbox checkbox-xs"
							name="rememberme" type="checkbox" id="rememberme" value="forever" />
						<span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
					</label>
					<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
					<button type="submit"
						class="my-3 btn btn-primary woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
						name="login"
						value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a class="link	text-sm"
						href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
				</p>

				<?php do_action('woocommerce_login_form_end'); ?>

			</form>

			<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')): ?>

			</div>

			<div class="u-column2">

				<h2 class="text-xl mb-4 font-bold"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

				<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>

					<?php do_action('woocommerce_register_form_start'); ?>

					<?php if ('no' === get_option('woocommerce_registration_generate_username')): ?>

						<p class="flex flex-col mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required"
									aria-hidden="true">*</span><span
									class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
							<input type="text" class="input woocommerce-Input woocommerce-Input--text input-text" name="username"
								id="reg_username" autocomplete="username"
								value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required
								aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
						</p>

					<?php endif; ?>

					<p class="flex flex-col mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required"
								aria-hidden="true">*</span><span
								class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
						<input type="email" class="input woocommerce-Input woocommerce-Input--text input-text" name="email"
							id="reg_email" autocomplete="email"
							value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" required
							aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
					</p>

					<?php if ('no' === get_option('woocommerce_registration_generate_password')): ?>

						<p class="flex flex-col mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required"
									aria-hidden="true">*</span><span
									class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
							<input type="password" class="input woocommerce-Input woocommerce-Input--text input-text" name="password"
								id="reg_password" autocomplete="new-password" required aria-required="true" />
						</p>

					<?php else: ?>

						<p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

					<?php endif; ?>

					<?php do_action('woocommerce_register_form'); ?>

					<p class="woocommerce-form-row form-row">
						<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
						<button type="submit"
							class="btn btn-primary woocommerce-Button woocommerce-button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit"
							name="register"
							value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
					</p>

					<?php do_action('woocommerce_register_form_end'); ?>

				</form>

			</div>

		</div>
	<?php endif; ?>

	<?php do_action('woocommerce_after_customer_login_form'); ?>

</div> <!-- ./l-container pt-5 -->