<?php
do_action('rc_blocks_section');
do_action('academist_elated_get_footer_template');
?>
<?php if (is_page(189) && isset($_GET['target'])) { ?>
	<script>
		jQuery(document).ready(function() {
			<?php if ($_GET['target'] == 'payment-plans') { ?>
				jQuery('#ui-id-7').click();
			<?php } else if ($_GET['target'] == 'accommodation') { ?>
				jQuery('#ui-id-8').click();
			<?php } ?>

			jQuery('html, body').animate({
				scrollTop: jQuery("#row-about-tabs").offset().top
			}, 2000);
		});
	</script>
<?php } ?>

<script>
	var mySwiperThumb = new Swiper(".mySwiperThumb", {
		loop: true,
		spaceBetween: 10,
		centeredSlides: true,
		watchSlidesProgress: true,
		pagination: {
			dynamicBullets: true,
			clickable: true
		},
		breakpoints: {
			0: {
				slidesPerView: 4,
			},

			1200: {
				slidesPerView: 4,
			},
			1400: {
				slidesPerView: 5,
			},
		},
	});

	var mySwiperMain = new Swiper(".mySwiperMain", {
		loop: true,
		spaceBetween: 0,
		centeredSlides: true,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},

		thumbs: {
			swiper: mySwiperThumb,
		},
	});

	jQuery(document).ready(function() {
		jQuery('#events-category').change(function(e) {
			$link = jQuery(this).val();
			window.location.href = $link;
			e.preventDefault();
		});
	});
</script>