<?php

/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!$notices) {
	return;
}

?>
<div class="woocommerce-message-holder">
	<?php foreach ($notices as $notice) : ?>
		<div class="woocommerce-message" <?php echo wc_get_notice_data_attr($notice); ?> role="alert">
			<div class="row g-4 align-items-center justify-content-between">
				<div class="col-auto">
					<div class="message">
						<?= wc_kses_notice($notice['notice']) ?>
					</div>
				</div>

				<div class="col-auto">
					<div class="button-box button-accent button-small">
						<a href="/checkout/">
							View Cart & Checkout
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>