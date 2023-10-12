<?php
$title_tag    = isset($title_tag) ? $title_tag : 'h4';
$title_styles = isset($this_object) && isset($params) ? $this_object->getTitleStyles($params) : array();
$month = get_the_time('m');
$year = get_the_time('Y');
$title = get_the_title();
?>

<<?php echo esc_attr($title_tag); ?> itemprop="name" class="entry-title eltdf-post-title" <?php academist_elated_inline_style($title_styles); ?>>
    <?php if (academist_elated_blog_item_has_link()) { ?>
        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php } ?>
        <?php the_title(); ?>
        <?php if (academist_elated_blog_item_has_link()) { ?>
        </a>
    <?php } ?>
</<?php echo esc_attr($title_tag); ?>>

<div itemprop="dateCreated" class="eltdf-post-info-date entry-date published updated">
    <?php if (empty($title) && academist_elated_blog_item_has_link()) { ?>
        <a itemprop="url" href="<?php the_permalink() ?>">
        <?php } else { ?>
            <a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
            <?php } ?>

            <?php the_time(get_option('date_format')); ?>
            </a>
            <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(academist_elated_get_page_id()); ?>" />
</div>