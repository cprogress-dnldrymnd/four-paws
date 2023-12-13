jQuery(function ($) {

    const wp_inline_edit_function = inlineEditPost.edit;

    // we overwrite the it with our own
    inlineEditPost.edit = function (post_id) {

        // let's merge arguments of the original function
        wp_inline_edit_function.apply(this, arguments);

        // get the post ID from the argument
        if (typeof (post_id) == 'object') { // if it is object, get the ID number
            post_id = parseInt(this.getId(post_id));
        }

        // add rows to variables
        const edit_row = $('#edit-' + post_id)
        const post_row = $('#post-' + post_id)


        jQuery('.location-checkbox').each(function (index, element) {
            $id = jQuery(this).attr('location-key');
            $(':input[name="' + $id + '"]', edit_row).prop('checked', true);
        });

        $(':input[name="featured"]', edit_row).prop('checked', featuredProduct);

    }
});

$('#bulk_edit').on('click', function (event) {
    const bulk_row = $('#bulk-edit');

    // Get the selected post ids that are being edited.
    const post_ids = [];

    // Get the data.
    const related_posts = $(':input[name="wz_tutorials_related_posts"]', bulk_row).val();
    const exclude_this_post = $('select[name="wz_tutorials_exclude_this_post"]', bulk_row).val();

    // Get post IDs from the bulk_edit ID. .ntdelbutton is the class that holds the post ID.
    bulk_row.find('#bulk-titles-list .ntdelbutton').each(function () {
        post_ids.push($(this).attr('id').replace(/^(_)/i, ''));
    });
    // Convert all post_ids to integer.
    post_ids.map(function (value, index, array) {
        array[index] = parseInt(value);
    });

    // Save the data.
    $.ajax({
        url: ajaxurl, // this is a variable that WordPress has already defined for us
        type: 'POST',
        async: false,
        cache: false,
        data: {
            action: 'wz_tutorials_save_bulk_edit', // this is the name of our WP AJAX function that we'll set up next
            post_ids: post_ids, // and these are the 2 parameters we're passing to our function
            related_posts: related_posts,
            exclude_this_post: exclude_this_post,
            wz_tutorials_bulk_edit_nonce: wz_tutorials_bulk_edit.nonce
        }
    });
});