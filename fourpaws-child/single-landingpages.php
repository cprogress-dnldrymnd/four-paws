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
    <div class="top-bar-bg">

    </div>
    <div class="eltdf-top-bar eltdf-top-bar-landing">
        <strong>FLEXIBLE PAYMENT</strong> OPTIONS AVAILABLE
    </div>
    <header class="eltdf-page-header">
        <div class="eltdf-menu-area eltdf-menu-right">
            <div class="eltdf-grid">
                <div class="eltdf-vertical-align-containers">
                    <div class="eltdf-position-left">
                        <div class="eltdf-position-left-inner">
                            <div class="eltdf-logo-wrapper">
                                <a itemprop="url" href="https://www.fourpawsgroomschool.co.uk/" style="height: 62px;">
                                    <img itemprop="image" class="eltdf-normal-logo" src="https://www.fourpawsgroomschool.co.uk/wp-content/uploads/2023/08/Four-Paws-Logo.svg" width="162" height="124" alt="logo">
                                    <img itemprop="image" class="eltdf-dark-logo" src="https://www.fourpawsgroomschool.co.uk/wp-content/uploads/2023/08/Four-Paws-Logo.svg" width="162" height="124" alt="dark logo"> <img itemprop="image" class="eltdf-light-logo" src="https://www.fourpawsgroomschool.co.uk/wp-content/uploads/2023/08/Four-Paws-Logo.svg" width="162" height="124" alt="light logo"> </a>
                            </div>
                        </div>
                    </div>
                    <div class="eltdf-position-right">
                        <div class="eltdf-position-right-inner">

                            <img src="https://fourpawsgroomschool.co.uk/wp-content/uploads/2023/08/google-rev.png" alt="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="landing-page">
        <?php the_content() ?>
    </section>
    <footer>
        <div class="eltdf-row-grid-section">
            <img src="https://www.fourpawsgroomschool.co.uk/wp-content/uploads/2023/08/animals.png" alt="">
        </div>
        
    </footer>
</body>
<?php wp_footer() ?>

</html>