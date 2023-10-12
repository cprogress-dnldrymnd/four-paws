<?php
$price = academist_lms_calculate_course_price( get_the_ID() );
$currency_postition = get_option( 'woocommerce_currency_pos' );
?>
<div class="eltdf-ci-price-holder">
	<?php if ( $price == 0 ) { ?>
		<span class="eltdf-ci-price-free">
        <?php esc_html_e( 'Free', 'academist-lms' ); ?>
      </span>
	<?php } else { ?>
		<span class="eltdf-ci-price-value">
		  <?php
		  	if (academist_elated_is_woocommerce_installed()) {
				if ($currency_postition === 'left') {
					echo get_woocommerce_currency_symbol() . esc_html($price);
				} else {
					echo esc_html($price) . get_woocommerce_currency_symbol();
				}
			}?>
      </span>
	<?php } ?>
</div>