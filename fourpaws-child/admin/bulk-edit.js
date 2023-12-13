jQuery(document).ready(function ($) {

    // we create a copy of the WP inline edit post function
    const wp_inline_edit = inlineEditPost.edit;

    // and then we overwrite the function with our own code
    inlineEditPost.edit = function (post_id) {

        // "call" the original WP edit function
        // we don't want to leave WordPress hanging
        wp_inline_edit.apply(this, arguments);

        // now we take care of our business

        // get the post ID from the argument
        if (typeof (post_id) == 'object') { // if it is object, get the ID number
            post_id = parseInt(this.getId(post_id));
        }

        if (post_id > 0) {
            // define the edit row
            const edit_row = $('#edit-' + post_id);
            const post_row = $('#post-' + post_id);

            $('.location-checkbox', post_row).each(function (index, element) {
                $id = $(this).attr('location-key');
                $('input[name="' + $id + '"]', edit_row).prop('checked', true);
            });
        }
    };


});
