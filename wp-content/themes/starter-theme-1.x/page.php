<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

/**
 * page got password?
 */

$page_got_passwd = false;

if (post_password_required($timber_post->ID)) {
    $page_got_passwd = true;

    $css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'password-form');
    wp_enqueue_style('password-form', $css_url, [], false, 'screen');
}

/**
 * specific css/js
 */

$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), $timber_post->post_name);
$js_absolute_path  = sprintf('%s/assets/js/%s.js', get_stylesheet_directory(), $timber_post->post_name);

$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), $timber_post->post_name);
$js_url = sprintf('%s/assets/js/%s.js', get_stylesheet_directory_uri(), $timber_post->post_name);

if (file_exists($css_absolute_path)) {
    wp_enqueue_style('page-site', $css_url, [], false, 'screen');
}

if (file_exists($js_absolute_path)) {
    wp_enqueue_script('page-script', $js_url, ['jquery'], false, true);
}

/**
 * render
 */


if ($page_got_passwd) {
    Timber::render('page-password.twig', $context);
} else {

    if (in_array($timber_post->post_name, ['community', 'live', 'market-research-cloud', 'contact', 'request-a-demo', 'solutions', 'about-us', 'fc-exchange', 'ignition', 'customer-stories', 'become-a-partner', 'brand-intelligence', 'market-intelligence', 'product-intelligence'])) {
        Timber::render('page.twig', $context);
    } else {
        Timber::render(array('page-' . $timber_post->post_name . '.twig', 'page.twig'), $context);
    }
}
