<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php
    /**
     * academist_elated_action_header_meta hook
     *
     * @see academist_elated_header_meta() - hooked with 10
     * @see academist_elated_user_scalable_meta - hooked with 10
     * @see academist_core_set_open_graph_meta - hooked with 10
     */
    do_action('academist_elated_action_header_meta');

    wp_head(); ?>

    <?php if (isset($_GET['post_type']) && isset($_GET['s'])) { ?>
        <style>
            .eltdf-search-page-holder .eltdf-search-page-form {
                display: none !important;
            }
        </style>
    <?php } ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <section class="landing-page">
        <?php the_content() ?>
    </section>
</body>
<?php wp_footer() ?>

</html>