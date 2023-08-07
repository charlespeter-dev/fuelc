<?php

add_action('wp_head', function () {
    wp_enqueue_style('bootstrap-container', get_stylesheet_directory_uri() . '/assets/css/bootstrap-container.css', [], HELLO_ELEMENTOR_VERSION);
    wp_enqueue_style('custom-header-menu', get_stylesheet_directory_uri() . '/assets/css/custom-header-menu.css', [], time());
}, PHP_INT_MAX);

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('custom-header-menu', get_stylesheet_directory_uri() . '/assets/js/custom-header-menu.js', [], HELLO_ELEMENTOR_VERSION, true);
});

/**
 * adjust <nav> when user logged in
 */

if (is_user_logged_in()) {
    add_action('wp_head', function () {
?>

        <style type="text/css">
            #main-navbar {
                margin-top: 32px !important;
            }

            main {
                margin-top: 85px;
            }

            @media screen and (max-width: 782px) {
                #main-navbar {
                    margin-top: 46px !important;
                }
            }

            @media screen and (max-width: 600px) {
                #wpadminbar {
                    position: fixed !important;
                }
            }

            @media screen and (max-width: 992px) {
                main {
                    margin-top: 66px;
                }
            }
        </style>

    <?php
    });
}


add_filter('wpseo_xml_sitemap_post_url', function ($url, $post) {

    $excluded = [
        'https://fuelcycle.com/blog/introducing-fuel-cycles-newest-sales-director/',
        'https://fuelcycle.com/blog/mining-patient-ecosystem-market-research-can-help-understand-patients-journey/',
        'https://fuelcycle.com/blog/reckoning-facebooks-missteps-personalize-ads-without-creeping-audience/',
        'https://fuelcycle.com/blog/mobile-banking-leading-future-finance-whats-hang/',
    ];

    $_pprredirect_url = get_post_meta($post->ID, '_pprredirect_url', true) ?? null;
    $_pprredirect_type = get_post_meta($post->ID, '_pprredirect_type', true) ?? null;

    if ($_pprredirect_url && $_pprredirect_type == 301) {

        if (strpos($_pprredirect_url, 'fuelcycle.com') !== false && strpos(get_bloginfo('url'), 'fuelcycle.com') !== false) {
            if (!in_array($_pprredirect_url, $excluded)) {
                return $_pprredirect_url;
            }
        } else {

            /**
             * debug mode in local
             * Yoast doesn't allow external URLs
             */

            $_pprredirect_url = str_replace('fuelcycle.com', 'fuelc.test', $_pprredirect_url);

            // $redirection = [
            // 	'src' => get_the_permalink($post->ID),
            // 	'dest' => $_pprredirect_url
            // ];
            // print_r($redirection);

            return $_pprredirect_url;
        }
    }

    return $url;
}, 10, 2);

/**
 * helper to echo the latest resources in the top nav
 */

function fc_get_latest_resource($mobile = false)
{
    $args = [
        'category_name' => 'ebook,webinar,white-paper,guide-book,infographic,video,case-study,industry-report,podcast',
        'order' => 'DESC',
        'orderby' => 'date',
        'posts_per_page' => 1
    ];

    $results = new WP_Query($args);
    wp_reset_postdata();

    $post = $results->post;

    /**
     * thumbnail
     */

    $attachmend_id = get_field('featured_image', $post->ID) ?? null;

    if (!$attachmend_id) {
        $attachmend_id = get_post_thumbnail_id($post->ID);
    }

    $img = wp_get_attachment_image_url($attachmend_id, '_2x-nav-featured-image');


    /**
     * categories
     */

    $cats = [];
    foreach (get_the_category($post->ID) as $c) {
        $cat = get_category($c);
        $cats[] = $cat->name;
    }

    $categories = implode(', ', $cats);

    /**
     * title
     */

    $title = get_the_title($post->ID);

    /**
     * permalink
     */

    $permalink = get_the_permalink($post->ID);

    /**
     * excerpts
     */

    $excerpts = get_the_excerpt($post->ID);

    ?>

    <?php if (!$mobile) : ?>
        <div class="subnav-3-right-wrapper">
            <div class="line-divider"></div>
            <div>
                <img class="featured-post-image" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area">
                <span class="d-block featured-post-category mt-25px">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php else : ?>
        <div class="subnav-3-right-wrapper-mobile">
            <div>
                <img class="featured-post-image img-fluid" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area-mobile pr-1">
                <span class="d-block featured-post-category">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title featured-post-title-mobile">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph featured-post-paragraph-mobile">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php endif ?>

<?php
}

/**
 * helper to echo the latest press in the top nav
 */

function fc_get_latest_press($mobile = false)
{
    $args = [
        'category_name' => 'press',
        'order' => 'DESC',
        'orderby' => 'date',
        'posts_per_page' => 1
    ];

    $results = new WP_Query($args);
    wp_reset_postdata();

    $post = $results->post;

    /**
     * thumbnail
     */

    $attachmend_id = get_field('featured_image', $post->ID) ?? null;

    if (!$attachmend_id) {
        $attachmend_id = get_post_thumbnail_id($post->ID);
    }

    $img = wp_get_attachment_image_url($attachmend_id, '_2x-nav-featured-image');


    /**
     * categories
     */

    $cats = [];
    foreach (get_the_category($post->ID) as $c) {
        $cat = get_category($c);
        $cats[] = $cat->name;
    }

    $categories = implode(', ', $cats);

    /**
     * title
     */

    $title = get_the_title($post->ID);

    /**
     * permalink
     */

    $permalink = get_the_permalink($post->ID);

    /**
     * excerpts
     */

    $excerpts = get_the_excerpt($post->ID);

?>

    <?php if (!$mobile) : ?>
        <div class="subnav-3-right-wrapper">
            <div class="line-divider"></div>
            <div>
                <img class="featured-post-image" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area">
                <span class="d-block featured-post-category mt-25px">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php else : ?>
        <div class="subnav-3-right-wrapper-mobile">
            <div>
                <img class="featured-post-image img-fluid" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area-mobile pr-1">
                <span class="d-block featured-post-category">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title featured-post-title-mobile">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph featured-post-paragraph-mobile">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php endif ?>

<?php
}

/**
 * helper to echo the ACF flexiable footer content only in pages
 */

function flexible_footer_content()
{
    if (is_page()) {
        $options = get_fields('option') ?? null;
        if ($options) {
            echo $options['flexible_footer_content'];
        }
    }
}

/**
 * register new image size for specific content
 */

add_action('after_setup_theme',  function () {
    add_theme_support('post-thumbnails');
    add_image_size('_2x-nav-featured-image', 260, 260, true);
});
