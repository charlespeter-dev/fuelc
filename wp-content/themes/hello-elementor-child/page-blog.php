<?php

require_once(__DIR__ . '/vendor/autoload.php');
$timber = new Timber\Timber();
$timber::$dirname = ['template-parts/twigs'];
$timber::$autoescape = false;

$context = $timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$args['search_filter_id'] = 27217;
$context['ttcposts'] = new Timber\PostQuery($args);
$context['pagination'] = $timber::get_pagination();

get_header();

$timber::render(["page-{$timber_post->post_name}.twig"], $context);

get_footer();

