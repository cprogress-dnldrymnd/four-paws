<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="eltdf-post-content">
        <div class="top-info">
            <div class="row">
                <div class="col-auto">
                    <?= post_category('single-page'); ?>
                </div>
                <div class="col-auto">
                    <?php academist_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
            
                <div class="eltdf-post-text-main">
                    <?php academist_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php the_content(); ?>
                    <?php do_action('academist_elated_action_single_link_pages'); ?>
                </div>
                <div class="eltdf-post-info-bottom clearfix">
                    <div class="eltdf-post-info-bottom-left">
                        <?php academist_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                    </div>
                    <div class="eltdf-post-info-bottom-right">
                        <?php academist_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>