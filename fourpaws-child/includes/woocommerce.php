<?php
function action_woocommerce_before_shop_loop() {
    echo 'test';
}

add_action('woocommerce_before_shop_loop', 'action_woocommerce_before_shop_loop');