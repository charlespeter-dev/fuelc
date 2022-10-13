<?php

/**
 * Template Name: Events / Webinars
 * Description: A Page Template with a darker design.
 */

$context = Timber::context();
$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$args['search_filter_id'] = 740;
$context['filter_id'] = "[searchandfilter id='740']";
$context['ttcposts'] = new Timber\PostQuery($args);
$context['pagination'] = Timber::get_pagination();

/**
 * specific css/js
 */

$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), 'resource-hub');
$js_absolute_path  = sprintf('%s/assets/js/%s.js', get_stylesheet_directory(), $timber_post->post_name);

$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'resource-hub');
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

Timber::render(array('page-' . $timber_post->post_name . '.twig', 'page.twig'), $context);
