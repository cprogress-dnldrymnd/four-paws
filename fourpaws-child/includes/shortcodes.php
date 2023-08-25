<?php

function slider($atts, $content = null)
{
    extract(
        shortcode_atts(
            array(
                'id' => '',
            ),
            $atts
        )
    );

    $slides = get__post_meta_by_id($id, 'slides');
    ob_start();
?>
    <div class="hero-slider">
        <!-- Swiper -->
        <div class="swiper mySwiper mySwiperHero">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide) { ?>
                    <?php
                    $image = $slide['image'];
                    $heading = $slide['heading'];
                    $description = $slide['description'];
                    $button_text_1 = $slide['button_text_1'];
                    $button_link_1 = $slide['button_link_1'];
                    $button_text_2 = $slide['button_text_2'];
                    $button_link_2 = $slide['button_link_2'];
                    ?>
                    <div class="swiper-slide" style="background-image: url(<?= wp_get_attachment_image_url($image, 'full') ?>);">
                        <div class="eltdf-row-grid-section">
                            <div class="inner color-white content-margin">
                                <div class="heading-box">
                                    <h2><?= $heading ?></h2>
                                </div>
                                <div class="description-box">
                                    <?= wpautop($description) ?>
                                </div>
                                <div class="button-group-box">
                                    <?php if ($button_text_1) { ?>
                                        <a itemprop="url" href="<?= $button_link_1 ?>" target="_self" style="color: #ffffff;margin: 0 15px 0 0" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid eltdf-btn-arrow">
                                            <span class="eltdf-btn-text"><?= $button_text_1 ?></span>
                                        </a>
                                    <?php } ?>
                                    <?php if ($button_text_2) { ?>
                                        <a itemprop="url" href="<?= $button_link_2 ?>" target="_self" style="color: #ffffff" class="eltdf-btn eltdf-btn-medium eltdf-btn-outline eltdf-btn-arrow">
                                            <span class="eltdf-btn-text"><?= $button_text_2 ?></span>
                                        </a>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="bullets">
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </div>
<?php
    return ob_get_clean();
}

add_shortcode('slider', 'slider');
