<?php

require_once(__DIR__ . '/vendor/autoload.php');
Timber\Timber::init();


$context = Timber::context();
$timber_post = Timber::get_post();
$context['post'] = $timber_post;
$args['search_filter_id'] = 27220;
$context['filter_id'] = "[searchandfilter id='27220']";
$context['ttcposts'] = Timber::get_posts($args);
$context['pagination'] = Timber::get_pagination();

get_header();

Timber::render(["template-parts/twigs/content-hub-template.twig"], $context);

get_footer();
