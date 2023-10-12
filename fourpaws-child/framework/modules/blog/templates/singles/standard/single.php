<?php

academist_elated_get_single_post_format_html($blog_single_type);

do_action('academist_elated_action_after_article_content');

?>
<div class="top-info">
    <div class="row">
        <div class="col-auto">
            <?= post_category('single-page'); ?>
        </div>
    </div>
</div>
<?php

academist_elated_get_module_template_part('templates/parts/single/single-navigation', 'blog');

academist_elated_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

academist_elated_get_module_template_part('templates/parts/single/comments', 'blog');
