<?php
do_action('rc_blocks_section');
do_action('academist_elated_get_footer_template');
?>
<?php if (is_page(189) && isset($_GET['target'])) { ?>
    <script>
        jQuery(document).ready(function() {
            $hash = window.location.hash;
            if ($hash) {
                $hash.replace(/[0-9]/g, '');
                console.log($hash);
                jQuery('#ui-id-7').click();
            }

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
</script>