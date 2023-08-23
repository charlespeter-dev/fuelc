<?php

global $timber;

$context = $timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$args['search_filter_id'] = 740;
$context['filter_id'] = "[searchandfilter id='740']";
$context['ttcposts'] = new Timber\PostQuery($args);
$context['pagination'] = $timber::get_pagination();

get_header();

$timber::render(["page-{$timber_post->post_name}.twig"], $context);

get_footer();

?>