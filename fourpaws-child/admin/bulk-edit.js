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

    $('#bulk_edit').on('click', function (event) {
        const bulk_row = $('#bulk-edit');

        // Get the selected post ids that are being edited.
        const post_ids = [];

        // Get the data.
        all_location = $('#bulk-edit input[name="_all_location"]', bulk_row).is(":checked")

        if (all_location) {
            const _all_location = 'yes';
        }

        // Get post IDs from the bulk_edit ID. .ntdelbutton is the class that holds the post ID.
        bulk_row.find('#bulk-titles-list .ntdelbutton').each(function () {
            post_ids.push($(this).attr('id').replace(/^(_)/i, ''));
        });
        // Convert all post_ids to integer.
        post_ids.map(function (value, index, array) {
            array[index] = parseInt(value);
        });

        // Save the data.

        var data = {}

        data['action'] = 'wz_tutorials_save_bulk_edit';
        data['post_ids'] = post_ids;
        data['_all_location'] = _all_location;
        data['wz_tutorials_bulk_edit_nonce'] = wz_tutorials_bulk_edit.nonce;


        $('.other-locations input[type="checkbox"]').each(function (index, element) {
            const name = $(this).attr('name');
            const value = $('.bulk-edit-row input[name="' + name + '"]', bulk_row).val();
            // data[name] = value;

        });

        console.log(data);

        $.ajax({
            url: ajaxurl, // this is a variable that WordPress has already defined for us
            type: 'POST',
            async: false,
            cache: false,
            data: {
                action: 'wz_tutorials_save_bulk_edit', // this is the name of our WP AJAX function that we'll set up next
                post_ids: post_ids, // and these are the 2 parameters we're passing to our function
                _all_location: _all_location,
                wz_tutorials_bulk_edit_nonce: wz_tutorials_bulk_edit.nonce
            }
        });
    });


});
