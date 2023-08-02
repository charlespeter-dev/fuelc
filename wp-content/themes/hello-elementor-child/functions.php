<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'hello-elementor-child',
        get_stylesheet_directory_uri() . '/style.css',
        [],
        HELLO_ELEMENTOR_VERSION
    );
});
