<?php
$eltdf_blog_type = academist_elated_get_archive_blog_list_layout();
academist_elated_include_blog_helper_functions('lists', $eltdf_blog_type);
$eltdf_holder_params = academist_elated_get_holder_params_blog();

get_header();
academist_elated_get_title();
do_action('academist_elated_action_before_main_content');
?>

<div class="<?php echo esc_attr($eltdf_holder_params['holder']); ?>">
    <?php do_action('academist_elated_action_after_container_open'); ?>

    <div class="<?php echo esc_attr($eltdf_holder_params['inner']); ?>">
        <div class="eltdf-grid-row <?php echo esc_attr($holder_classes); ?>">
            <div <?php echo academist_elated_get_content_sidebar_class(); ?>>
                <?php academist_elated_get_blog_type('masonry'); ?>
            </div>

            <div <?php echo academist_elated_get_sidebar_holder_class(); ?>>
                <?php get_sidebar('Sidebar'); ?>
            </div>
        </div>
    </div>

    <?php do_action('academist_elated_action_before_container_close'); ?>
</div>

<?php do_action('academist_elated_action_blog_list_additional_tags'); ?>
<?php get_footer(); ?>