<?php
function action_product_archive_categories()
{
    if (!is_shop()) {
        $term = get_queried_object();
    }

    $filter_categories = get_terms(
        array(
            'taxonomy' => 'product_cat',
        )
    );

?>
    <div class="background-accent-color-alt eltdf-course-list-holder eltdf-course-list-holder-v2 eltdf-grid-list    eltdf-large-space eltdf-cl-has-filter-category ">
        <div class="eltdf-grid">
            <div class="eltdf-cl-filter-holder">
                <div class="eltdf-plf-inner">
                    <ul>
                        <li class="eltdf-cl-filter <?= is_shop() ? 'eltdf-cl-current' : '' ?>">
                            <a href="<?= get_post_type_archive_link('product') ?>">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.002" height="15.601" viewBox="0 0 16.002 15.601">
                                        <g id="Group_117" data-name="Group 117" transform="translate(-310 -851.699)">
                                            <path id="Path_84" data-name="Path 84" d="M3,3.474C1.533,3.644.135,3.115.011,2.042S.859.2,2.325.032s2.872.32,3,1.4S4.465,3.307,3,3.474" transform="translate(310 860.242) rotate(-90)" fill="currentColor" />
                                            <path id="Path_85" data-name="Path 85" d="M4,3.662C2.534,3.829.13,3.111.011,2.031S.859.2,2.321.027,6.174.508,6.294,1.579,5.465,3.488,4,3.662" transform="translate(313.956 858.005) rotate(-90)" fill="currentColor" />
                                            <path id="Path_86" data-name="Path 86" d="M4,3.66C2.537,3.831.135,3.113.011,2.033S.859.2,2.324.026,6.173.5,6.3,1.583,5.464,3.492,4,3.66" transform="translate(318.679 858.941) rotate(-90)" fill="currentColor" />
                                            <path id="Path_87" data-name="Path 87" d="M3.037.044C1.574-.157.162.342.016,1.415S.827,3.27,2.284,3.472s2.877-.258,3.025-1.329S4.5.244,3.037.044" transform="translate(322.484 861.515) rotate(-90)" fill="currentColor" />
                                            <path id="Path_88" data-name="Path 88" d="M7.889,9.058a3.113,3.113,0,0,0,.124-4.292C6.392,3.555,6.234,3.276,5.949,2.577A3.336,3.336,0,0,0,3.132,0,2.4,2.4,0,0,0,.839,1.729C-.227,4.551-.275,9.247.684,11.493a2.149,2.149,0,0,0,2.2,1.366c1.634-.268,2.089-1.642,2.838-2.331A13.01,13.01,0,0,1,7.889,9.058" transform="translate(310.617 867.301) rotate(-90)" fill="currentColor" />
                                        </g>
                                    </svg>
                                </span>
                                <span class="text"><?php esc_html_e('All Products', 'academist-core') ?></span>
                            </a>
                        </li>
                        <?php foreach ($filter_categories as $cat) { ?>

                            <?php
                            $icon = get__term_meta($cat->term_id, 'svg_icon');
                            ?>

                            <li class="eltdf-cl-filter <?= $term->term_id == $cat->term_id ? 'eltdf-cl-current' : '' ?>">
                                <a href="<?= get_term_link($cat->term_id) ?>">
                                    <?php if ($icon) { ?>
                                        <span class="icon">
                                            <?= $icon ?>
                                        </span>
                                    <?php } ?>

                                    <span class="text"><?php echo esc_html($cat->name); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
}

add_action('product_archive_categories', 'action_product_archive_categories');



function product_gallery()
{
    global $product;
    $main_image = $product->get_image_id() ? $product->get_image_id() : get__theme_option('placeholder_image');
    $images = $product->get_gallery_image_ids();
?>
    <div class="product-gallery" image_count=<?= count($images) + 1 ?>>

        <div style="--swiper-navigation-color: #000; --swiper-pagination-color: #000" class="mySwiperMain background-light">

            <div class="swiper-wrapper">

                <div class="swiper-slide">

                    <div class="image-box">
                        <img src="<?= wp_get_attachment_image_url($main_image, 'large') ?>" />
                    </div>


                </div>
                <?php if ($images) { ?>
                    <?php foreach ($images as $image) { ?>
                        <div class="swiper-slide">
                            <div class="image-box">
                                <img src="<?= wp_get_attachment_image_url($image, 'large') ?>" />
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>

            </div>
            <?php if ($images) { ?>
                <div class="swiper-button-next d-none d-sm-flex"></div>
                <div class="swiper-button-prev d-none d-sm-flex"></div>
            <?php } ?>

        </div>
        <?php if ($images || $product->get_type() == 'variable') { ?>
            <div thumbsSlider="" class="swiper mySwiperThumb">

                <div class="swiper-wrapper">

                    <div class="swiper-slide">

                        <div class="image-box">

                            <img src="<?= wp_get_attachment_image_url($main_image, 'thumbnail') ?>" />

                        </div>

                    </div>



                    <?php foreach ($images as $image) { ?>

                        <div class="swiper-slide">

                            <div class="image-box">

                                <img src="<?= wp_get_attachment_image_url($image, 'thumbnail') ?>" />

                            </div>

                        </div>



                    <?php } ?>

                </div>


                <div class="swiper-pagination-holder d-flex d-sm-none">
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        <?php } ?>

    </div>
<?php
}

add_action('woocommerce_product_thumbnails', 'product_gallery');


function remove_single_product_image($html, $thumbnail_id)
{
    return '';
}

add_filter('woocommerce_single_product_image_thumbnail_html', 'remove_single_product_image', 10, 2);
