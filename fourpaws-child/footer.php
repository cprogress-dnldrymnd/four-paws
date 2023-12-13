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