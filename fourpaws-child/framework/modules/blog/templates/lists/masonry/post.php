<?php
$post_classes[] = 'eltdf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-heading">
            <?php academist_elated_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-text-main">
                    <div class="content">
                        <?php academist_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                        <?php academist_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                        <?php academist_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    </div>
                    <div class="button-box">
                        <a itemprop="url" href="<?= get_the_permalink() ?>" target="_self" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid eltdf-btn-arrow button-accent">
                            <span class="eltdf-btn-text">Read more</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>