<?php

/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

/**
 * specific css/js
 */

$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), '404');
$js_absolute_path  = sprintf('%s/assets/js/%s.js', get_stylesheet_directory(), '404');

$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), '404');
$js_url = sprintf('%s/assets/js/%s.js', get_stylesheet_directory_uri(), '404');

if (file_exists($css_absolute_path)) {
    wp_enqueue_style('page-site', $css_url, [], false, 'screen');
}

if (file_exists($js_absolute_path)) {
    wp_enqueue_script('page-script', $js_url, ['jquery'], false, true);
}

/**
 * render
 */

Timber::render('404.twig', $context);
