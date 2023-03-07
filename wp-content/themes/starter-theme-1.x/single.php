<?php

/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$args['search_filter_id'] = 27217;
$context['ttcposts'] = new Timber\PostQuery($args);
$context['pagination'] = Timber::get_pagination();

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

$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), 'post');
$js_absolute_path  = sprintf('%s/assets/js/%s.js', get_stylesheet_directory(), 'post');

$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'post');
$js_url = sprintf('%s/assets/js/%s.js', get_stylesheet_directory_uri(), 'post');

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
	Timber::render('single-password.twig', $context);
} else {
	Timber::render(array('single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig'), $context);
}
