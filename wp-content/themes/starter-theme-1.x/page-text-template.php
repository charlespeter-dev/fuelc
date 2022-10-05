<?php
/**
 * Template Name: Text Template
 * Description: A Page Template with a darker design.
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
wp_enqueue_style( 'page-site', get_template_directory_uri() . '/assets/css/text-template.css', array(), '1.9992', 'all');	 
wp_enqueue_script( 'page-script', get_template_directory_uri() . '/assets/js/'.$timber_post->post_name.'.js', array ( 'jquery' ), 1.9992, true);

Timber::render( array( 'page-text-template.twig', 'page.twig' ), $context );
