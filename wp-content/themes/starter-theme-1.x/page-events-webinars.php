<?php

/**
 * Template Name: Events / Webinars
 * Description: A Page Template with a darker design.
 */

// $context          = Timber::context();
// $context['tccposts'] = Timber::get_posts( ['post_type' => 'posts', 'posts_per_page' => 10] );
// $templates        = array( 'page-resource-hub.twig' );
// Timber::render($templates, $context);

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$args['search_filter_id'] = 740;
$context['filter_id'] = "[searchandfilter id='740']";
$context['ttcposts'] = new Timber\PostQuery($args);
$context['pagination'] = Timber::get_pagination();
wp_enqueue_style( 'page-site', get_template_directory_uri() . '/assets/css/'.'resource-hub' .'.css', array(), '1.9992', 'all');	 
wp_enqueue_script( 'page-script', get_template_directory_uri() . '/assets/js/'.$timber_post->post_name.'.js', array ( 'jquery' ), 1.9992, true);
Timber::render( array( 'page-' . $timber_post->post_name . '.twig',  'page.twig' ), $context );
