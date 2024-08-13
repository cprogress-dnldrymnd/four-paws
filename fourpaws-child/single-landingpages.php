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
    <footer class="eltdf-page-footer">
        <div class="image-box">
            <img src="https://www.fourpawsgroomschool.co.uk/wp-content/uploads/2023/08/animals.png" alt="Dog and Cat Cartoon">
        </div>
        <div class="eltdf-footer-bottom-holder">
            <div class="eltdf-footer-bottom-inner eltdf-grid">
                <div class="eltdf-grid-row ">
                    <div class="eltdf-grid-col-4">
                        <div id="block-12" class="widget eltdf-footer-bottom-column-1 widget_block widget_text ">
                            <p class="color-white"><span>© 2023 All rights reserved. Four Paws Groom School</span></p>
                        </div>
                    </div>
                    <div class="eltdf-grid-col-4">
                        <div id="block-17" class="widget eltdf-footer-bottom-column-2 widget_block">
                            <p> </p>
                            <div class="payment-methods d-flex align-item-center justify-content-center">
                                <div class="method">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Group_3" data-name="Group 3" width="48" height="32" viewBox="0 0 48 32">
                                        <g id="Rectangle_1" data-name="Rectangle 1" fill="#fff" stroke="#cccccb" stroke-width="2">
                                            <rect width="48" height="32" rx="4" stroke="none"></rect>
                                            <rect x="1" y="1" width="46" height="30" rx="3" fill="none"></rect>
                                        </g>
                                        <path id="Icon_awesome-apple-pay" data-name="Icon awesome-apple-pay" d="M6.217,10.566a2.088,2.088,0,0,1-1.676.793,2.358,2.358,0,0,1,.6-1.734,2.5,2.5,0,0,1,1.665-.856,2.531,2.531,0,0,1-.59,1.8m.58.915c-.926-.053-1.718.527-2.154.527s-1.117-.5-1.851-.484a2.734,2.734,0,0,0-2.319,1.41c-1,1.718-.261,4.255.707,5.654.473.691,1.037,1.452,1.782,1.426.707-.027.984-.457,1.835-.457S5.9,20.013,6.648,20c.771-.016,1.255-.691,1.729-1.383a6.013,6.013,0,0,0,.771-1.59,2.513,2.513,0,0,1-1.505-2.282A2.559,2.559,0,0,1,8.861,12.6,2.629,2.629,0,0,0,6.8,11.481m5.34-1.926V19.922h1.612V16.38h2.229a3.29,3.29,0,0,0,3.463-3.42,3.252,3.252,0,0,0-3.41-3.4H12.137Zm1.612,1.356h1.856a1.934,1.934,0,0,1,2.2,2.053,1.944,1.944,0,0,1-2.2,2.064H13.749ZM22.377,20a2.656,2.656,0,0,0,2.372-1.324h.032v1.245H26.27v-5.16c0-1.495-1.2-2.463-3.037-2.463-1.707,0-2.973.979-3.021,2.319h1.452a1.416,1.416,0,0,1,1.521-1.058c.984,0,1.537.457,1.537,1.3v.574l-2.011.122c-1.867.112-2.878.878-2.878,2.207A2.288,2.288,0,0,0,22.377,20Zm.436-1.229c-.856,0-1.4-.415-1.4-1.043,0-.654.527-1.032,1.532-1.09l1.787-.112v.585a1.748,1.748,0,0,1-1.915,1.66Zm5.452,3.968c1.569,0,2.308-.6,2.952-2.415L34.041,12.4H32.4l-1.894,6.122h-.032L28.584,12.4H26.9l2.723,7.548-.149.457a1.281,1.281,0,0,1-1.356,1.08c-.128,0-.372-.016-.473-.027V22.7A5.575,5.575,0,0,0,28.265,22.741Z" transform="translate(6.981 1.245)"></path>
                                    </svg>
                                </div>
                                <div class="method">
                                    <svg id="Group_5" data-name="Group 5" xmlns="http://www.w3.org/2000/svg" width="48" height="32" viewBox="0 0 48 32">
                                        <g id="Rectangle_2" data-name="Rectangle 2" fill="#fff" stroke="#cccccb" stroke-width="2">
                                            <rect width="48" height="32" rx="4" stroke="none"></rect>
                                            <rect x="1" y="1" width="46" height="30" rx="3" fill="none"></rect>
                                        </g>
                                        <g id="google-pay-primary-logo-logo-svgrepo-com" transform="translate(7.026 10.259)">
                                            <g id="Group_4" data-name="Group 4" transform="translate(14.802 0.779)">
                                                <path id="Path_1" data-name="Path 1" d="M1042.154,60.56v3.95H1040.9V54.753h3.325a3,3,0,0,1,2.153.845,2.823,2.823,0,0,1,0,4.131,2.994,2.994,0,0,1-2.153.83Zm0-4.606v3.407h2.1a1.7,1.7,0,0,0,1.273-2.857c-.011-.011-.021-.023-.033-.033a1.636,1.636,0,0,0-1.24-.518Zm8.012,1.662a3.109,3.109,0,0,1,2.194.742,2.636,2.636,0,0,1,.8,2.036v4.115h-1.2v-.927h-.054a2.4,2.4,0,0,1-2.072,1.145,2.689,2.689,0,0,1-1.846-.654,2.089,2.089,0,0,1-.742-1.635,1.983,1.983,0,0,1,.784-1.648,3.3,3.3,0,0,1,2.092-.613,3.708,3.708,0,0,1,1.839.408V60.3a1.427,1.427,0,0,0-.517-1.109,1.775,1.775,0,0,0-1.21-.456,1.921,1.921,0,0,0-1.662.886l-1.1-.7a3.068,3.068,0,0,1,2.695-1.307Zm-1.623,4.851a1,1,0,0,0,.415.818,1.529,1.529,0,0,0,.974.327,2,2,0,0,0,1.411-.586,1.832,1.832,0,0,0,.623-1.377,2.561,2.561,0,0,0-1.635-.468,2.117,2.117,0,0,0-1.274.368,1.1,1.1,0,0,0-.513.917Zm11.5-4.633-4.185,9.62h-1.294l1.553-3.366-2.753-6.254h1.362l1.989,4.8h.027l1.935-4.8Z" transform="translate(-1040.9 -54.752)" fill="#5f6368"></path>
                                            </g>
                                            <path id="Path_2" data-name="Path 2" d="M399.584,324.14a6.661,6.661,0,0,0-.1-1.14H394.2v2.159h3.027a2.593,2.593,0,0,1-1.119,1.7v1.4h1.807a5.479,5.479,0,0,0,1.668-4.124Z" transform="translate(-388.594 -318.406)" fill="#4285f4"></path>
                                            <path id="Path_3" data-name="Path 3" d="M47.008,474.233a5.361,5.361,0,0,0,3.716-1.354l-1.807-1.4a3.4,3.4,0,0,1-5.055-1.778H42v1.445A5.6,5.6,0,0,0,47.008,474.233Z" transform="translate(-41.403 -463.02)" fill="#34a853"></path>
                                            <path id="Path_4" data-name="Path 4" d="M2.459,220.791a3.359,3.359,0,0,1,0-2.146V217.2H.6a5.605,5.605,0,0,0,0,5.035Z" transform="translate(0 -214.111)" fill="#fbbc04"></path>
                                            <path id="Path_5" data-name="Path 5" d="M47.008,2.2a3.045,3.045,0,0,1,2.15.84l1.6-1.6a5.393,5.393,0,0,0-3.751-1.46A5.607,5.607,0,0,0,42,3.065L43.861,4.51A3.353,3.353,0,0,1,47.008,2.2Z" transform="translate(-41.403 0.024)" fill="#ea4335"></path>
                                        </g>
                                    </svg>

                                </div>
                                <div class="method">
                                    <svg id="mastercard-light-large" xmlns="http://www.w3.org/2000/svg" width="48" height="32" viewBox="0 0 48 32">
                                        <rect id="card_bg" width="48" height="32" rx="4" fill="#dfe3e8"></rect>
                                        <g id="mastercard" transform="translate(4.71 3.2)">
                                            <g id="Group" opacity="0">
                                                <rect id="Rectangle" width="38.71" height="25.6" fill="#fff"></rect>
                                            </g>
                                            <rect id="Rectangle-2" data-name="Rectangle" width="10.21" height="16.68" transform="translate(14.25 4.46)" fill="#f26122"></rect>
                                            <path id="Path" d="M13.169,10.61a10.58,10.58,0,0,1,4-8.34,10.61,10.61,0,1,0,0,16.68A10.58,10.58,0,0,1,13.169,10.61Z" transform="translate(2.181 2.19)" fill="#ea1d25"></path>
                                            <path id="Shape" d="M.5.411H.43V0h.1L.66.29.78,0h.1V.409H.81V.1L.7.37H.62L.5.1V.41ZM.2.41H.14V.07H0V0H.35V.07H.2V.409Z" transform="translate(35.29 18.96)" fill="#f69e1e"></path>
                                            <path id="Path-2" data-name="Path" d="M17.16,10.6A10.61,10.61,0,0,1,0,18.943,10.61,10.61,0,0,0,1.78,4.053,10.4,10.4,0,0,0,0,2.263,10.61,10.61,0,0,1,17.16,10.6Z" transform="translate(19.35 2.197)" fill="#f69e1e"></path>
                                        </g>
                                    </svg>

                                </div>
                                <div class="method">
                                    <svg id="paypal-color-large" xmlns="http://www.w3.org/2000/svg" width="48" height="32" viewBox="0 0 48 32">
                                        <rect id="card_bg" width="48" height="32" rx="4" fill="#fff"></rect>
                                        <path id="card_bg-2" d="M44,32H4a4,4,0,0,1-4-4V4A4,4,0,0,1,4,0H44a4,4,0,0,1,4,4V28A4,4,0,0,1,44,32ZM4,2A2,2,0,0,0,2,4V28a2,2,0,0,0,2,2H44a2,2,0,0,0,2-2V4a2,2,0,0,0-2-2Z" fill="#cccccb"></path>
                                        <g id="paypal" transform="translate(15.603 6)">
                                            <path id="Path" d="M4.11,18.64l.35-2.2H0L2.56.18A.21.21,0,0,1,2.63.05.24.24,0,0,1,2.77,0H8.98c2.07,0,3.49.43,4.24,1.28a2.75,2.75,0,0,1,.67,1.27,4.42,4.42,0,0,1,0,1.75v.5l.35.2a2.49,2.49,0,0,1,.71.53,2.59,2.59,0,0,1,.57,1.29,5.73,5.73,0,0,1-.08,1.86,6.48,6.48,0,0,1-.77,2.11,4.3,4.3,0,0,1-1.21,1.33,5.06,5.06,0,0,1-1.63.73,7.91,7.91,0,0,1-2,.24H9.34a1.47,1.47,0,0,0-.94.34,1.42,1.42,0,0,0-.49.88v.2L7.3,18.39v.15a.15.15,0,0,1,0,.08H7.24Z" transform="translate(0.706 0.68)" fill="#253d80"></path>
                                            <path id="Path-2" data-name="Path" d="M11.175,0l-.06.37c-.82,4.2-3.63,5.66-7.21,5.66H2.085a.89.89,0,0,0-.88.75L.275,12.7l-.27,1.68a.47.47,0,0,0,.46.54h3.24a.78.78,0,0,0,.77-.66V14.1l.61-3.87v-.21a.77.77,0,0,1,.76-.66h.53c3.13,0,5.59-1.27,6.3-5a4.24,4.24,0,0,0-.64-3.73,3.23,3.23,0,0,0-.86-.63Z" transform="translate(4.101 5.08)" fill="#189bd7"></path>
                                            <path id="Path-3" data-name="Path" d="M9.04.291l-.38-.1L8.24.111A10.06,10.06,0,0,0,6.64,0H1.76a.72.72,0,0,0-.33.07A.76.76,0,0,0,1,.651L0,7.221v.19a.89.89,0,0,1,.88-.75H2.7C6.28,6.661,9.09,5.2,9.91,1l.06-.37A4.48,4.48,0,0,0,9.3.351Z" transform="translate(5.376 4.449)" fill="#242e65"></path>
                                            <path id="Path-4" data-name="Path" d="M6.376,5.1a.76.76,0,0,1,.43-.58.72.72,0,0,1,.33-.07h4.88a10.06,10.06,0,0,1,1.6.11l.42.08.38.1.19.06a4.48,4.48,0,0,1,.67.28,4,4,0,0,0-.8-3.57C13.476.45,11.836,0,9.7,0H3.476A.89.89,0,0,0,2.6.75L.006,17.16a.54.54,0,0,0,.53.62h3.84l1-6.11Z" transform="translate(0)" fill="#253d80"></path>
                                        </g>
                                    </svg>

                                </div>
                                <div class="method">
                                    <svg id="visa-color_large" xmlns="http://www.w3.org/2000/svg" width="48" height="32" viewBox="0 0 48 32">
                                        <rect id="card_bg" width="48" height="32" rx="4" fill="#2a2a6c"></rect>
                                        <path id="visa-logo" d="M17.014,9.52a7.127,7.127,0,0,1-2.6-.491l.43-2a5.019,5.019,0,0,0,2.377.6h.063c.712-.01,1.43-.3,1.43-.91.01-.392-.326-.7-1.24-1.15-.9-.439-2.09-1.176-2.09-2.51,0-1.8,1.645-3.06,4-3.06a6.414,6.414,0,0,1,2.24.41l-.419,2a4.512,4.512,0,0,0-1.92-.432c-.147,0-.295.007-.441.022-.691.091-1,.453-1,.77,0,.388.5.647,1.123.975,1,.521,2.234,1.17,2.227,2.695l.05-.08c-.01,1.92-1.647,3.16-4.17,3.16Zm6.626-.08H21.12L24.71.87a1.087,1.087,0,0,1,1-.68h2l1.939,9.249H27.43l-.29-1.38H24.13l-.49,1.38ZM26.02,2.69,24.76,6.16h1.99ZM12.7,9.41H10.3l2-9.25h2.4l-2,9.249ZM7.45,9.38H4.84L2.93,1.99a1,1,0,0,0-.571-.81A9.917,9.917,0,0,0,0,.4L.06.13H4.13a1.118,1.118,0,0,1,1.11.941l1,5.35L8.73.13h2.6L7.45,9.379Z" transform="translate(9.645 11.23)" fill="#fff"></path>
                                    </svg>

                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                    <div class="eltdf-grid-col-4">
                        <div id="block-18" class="widget eltdf-footer-bottom-column-3 widget_block"><a href="https://www.fourpawsgroomschool.co.uk/privacy-policy/">Privacy Policy</a>
                            <span> • </span>
                            <a href="https://www.fourpawsgroomschool.co.uk/cookie-policy-uk/">Cookie Policy</a> • <a href="https://www.fourpawsgroomschool.co.uk/cat-dog-grooming-articles/">Articles</a>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<?php wp_footer() ?>

</html>