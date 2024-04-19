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




/**

 * Add a custom field to the checkout page

 */

add_action('woocommerce_after_order_notes', 'custom_checkout_field');

function custom_checkout_field($checkout)

{
    $post_type = array();
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product_id = $cart_item['product_id'];
        $post_type[] = get_post_type($product_id);
    }

    if (in_array('course', $post_type)) {

        woocommerce_form_field(
            'preferred_location',
            array(

                'type' => 'select',
                'required' => false,
                'options' => array(
                    '' => 'Select Location',
                    'Northwich, Cheshire' => 'Northwich, Cheshire',
                    'Ledbury, Herefordshire' => 'Ledbury, Herefordshire',
                    'Market Drayton, Shropshire' => 'Market Drayton, Shropshire',
                ),

                'class' => array(
                    'notes preferred_location_field'
                ),

                'label' => __('If you are booking a course please select your preferred training location'),
            ),

            $checkout->get_value('custom_field_name')
        );
    }
}


add_action('woocommerce_after_checkout_billing_form', 'action_woocommerce_after_checkout_billing_form');



/**
 
 * Validate Checkout field
 
 */

add_action('woocommerce_checkout_process', 'customised_checkout_field_process');
/*
function customised_checkout_field_process()

{

    // Show an error message if the field is not set.
    if (!$_POST['preferred_location']) wc_add_notice(__('Preferred Training Venue/Location is a Required Field!'), 'error');
}

*/
/**
 
 * Update the value given in custom field
 
 */

add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

function custom_checkout_field_update_order_meta($order_id)

{
    if (!empty($_POST['preferred_location'])) {
        update_post_meta($order_id, 'preferred_location', sanitize_text_field($_POST['preferred_location']));
    }

    if (!empty($_POST['newsletter']) && $_POST['newsletter']) {
        update_post_meta($order_id, 'newsletter', sanitize_text_field($_POST['newsletter']));
    }
}

/**
 * @snippet       Save & Display Custom Field @ WooCommerce Order
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 6
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_action('woocommerce_checkout_update_order_meta', 'bbloomer_save_new_checkout_field');

function bbloomer_save_new_checkout_field($order_id)
{
    if ($_POST['preferred_location']) update_post_meta($order_id, 'preferred_location', esc_attr($_POST['preferred_location']));
    if ($_POST['newsletter']) update_post_meta($order_id, 'newsletter', esc_attr($_POST['newsletter']));
}

add_action('woocommerce_thankyou', 'bbloomer_show_new_checkout_field_thankyou');

function bbloomer_show_new_checkout_field_thankyou($order_id)
{
    if (get_post_meta($order_id, 'preferred_location', true)) echo '<p><strong>Preferred Training Venue/Location:</strong> ' . get_post_meta($order_id, 'preferred_location', true) . '</p>';
    if (get_post_meta($order_id, 'newsletter', true)) echo '<p><strong>Sign up to newsletter:</strong> Yes</p>';
}

add_action('woocommerce_admin_order_data_after_billing_address', 'bbloomer_show_new_checkout_field_order');

function bbloomer_show_new_checkout_field_order($order)
{
    $order_id = $order->get_id();
    if (get_post_meta($order_id, 'preferred_location', true)) echo '<p><strong>Preferred Training Venue/Location:</strong> ' . get_post_meta($order_id, 'preferred_location', true) . '</p>';
    if (get_post_meta($order_id, 'newsletter', true)) echo '<p><strong>Sign up to newsletter:</strong> Yes</p>';
}

add_action('woocommerce_email_after_order_table', 'bbloomer_show_new_checkout_field_emails', 20, 4);

function bbloomer_show_new_checkout_field_emails($order, $sent_to_admin, $plain_text, $email)
{
    if (get_post_meta($order->get_id(), 'preferred_location', true)) echo '<p><strong>Preferred Training Venue/Location:</strong> ' . get_post_meta($order->get_id(), 'preferred_location', true) . '</p>';
    if (get_post_meta($order->get_id(), 'newsletter', true)) echo '<p><strong>Sign up to newsletter:</strong> Yes</p>';
}
