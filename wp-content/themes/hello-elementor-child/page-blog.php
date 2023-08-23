<?php

global $timber;

$context = $timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$args['search_filter_id'] = 27217;
$context['ttcposts'] = new Timber\PostQuery($args);
$context['pagination'] = $timber::get_pagination();

get_header();

$timber::render(['page-blog.twig'], $context);

get_footer();


?>