<?php

// add new columns
add_filter('manage_post_posts_columns', 'misha_price_and_featured_columns');
// the above hook will add columns only for default 'post' post type, for CPT:
// manage_{POST TYPE NAME}_posts_columns
function misha_price_and_featured_columns($column_array)
{

    $column_array['price'] = 'Price';
    $column_array['featured'] = 'Featured product';
    // the above code will add columns at the end of the array
    // if you want columns to be added in another order, use array_slice()

    return $column_array;
}

// Populate our new columns with data
add_action('manage_posts_custom_column', 'misha_populate_both_columns', 10, 2);
function misha_populate_both_columns($column_name, $post_id)
{

    // if you have to populate more that one columns, use switch()
    switch ($column_name) {
        case 'price': {
                $price = get_post_meta($post_id, 'product_price', true);
                echo $price ? '$' . $price : '';
                break;
            }
        case 'featured': {
                echo get_post_meta($post_id, 'product_featured', true);
                break;
            }
    }
}


// quick_edit_custom_box allows to add HTML in Quick Edit
add_action('quick_edit_custom_box',  'misha_quick_edit_fields', 10, 2);

function misha_quick_edit_fields($column_name, $post_type)
{

    switch ($column_name) {
        case 'price': {
?>
                <fieldset class="inline-edit-col-left">
                    <div class="inline-edit-col">
                        <label>
                            <span class="title">Price</span>
                            <input type="text" name="price">
                        </label>
                    </div>
                <?php
                break;
            }
        case 'featured': {
                ?>
                    <div class="inline-edit-col">
                        <label>
                            <input type="checkbox" name="featured"> Featured product
                        </label>
                    </div>
                </fieldset>
<?php
                break;
            }
    }
}

// save fields after quick edit
add_action('save_post', 'misha_quick_edit_save');

function misha_quick_edit_save($post_id)
{

    // check inlint edit nonce
    if (!wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) {
        return;
    }

    // update the price
    $price = !empty($_POST['price']) ? absint($_POST['price']) : 0;
    update_post_meta($post_id, 'product_price', $price);

    // update checkbox
    $featured = (isset($_POST['featured']) && 'on' == $_POST['featured']) ? 'yes' : 'no';
    update_post_meta($post_id, 'product_featured', $featured);
}
