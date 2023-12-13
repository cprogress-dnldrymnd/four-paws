<?php
do_action('rc_blocks_section');
do_action('academist_elated_get_footer_template');
?>
<?php if (is_page(189) && isset($_GET['target'])) { ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('<?= $_GET['target'] ?>').click();
        });
    </script>
<?php } ?>