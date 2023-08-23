<?php
global $post;

$fields = get_fields($post->ID);
extract($fields);

get_header() ?>

<div class="bootstrap-container">
    <div class="timber-oldfc">
        <div class="container-1140">
            <section id="resource-hub" class="margin-top-for-nav">
                <div class="container pt-4 container-1088">
                    <div class="horizontal-line-clean mb-5"></div>
                    <div class="row">
                        <div class="col-12 col-md-7">
                            <span class="hub-featured-subtitle">
                                <?= $subtitle ?>
                            </span>
                            <h1 class="section-title">
                                <?= $section_title ?>
                            </h1>
                        </div>
                        <div class="col-12 col-md-5 d-flex align-items-center">
                            <div>
                                <?= $intro_text ?>
                            </div>
                        </div>
                    </div>
                    <div class="horizontal-line-clean my-5"></div>
                </div>
                <div class="container container-1088">
                    <div class="row">
                        <span class="hub-featured-section-title">
                            <?= $featured_section_title ?>
                        </span>
                        <div class="col-12 col-md-7">
                            <img class="img-fluid hub-featured-post-image"
                                src="<?= wp_get_attachment_image_url($featured_post_image, 'full') ?>" alt="">
                        </div>
                        <div class="col-12 col-md-5">
                            <h2 class="hub-featured-post-title">
                                <?= $featured_post_title ?>
                            </h2>
                            <p class="hub-featured-post-paragraph">
                                <?= $featured_post_paragraph ?>
                            </p>
                            <a class="hub-featured-post-link" href="<?= $featured_post_link_url ?>">
                                <?= $featured_post_link_text ?> <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <section id="pagination-anchor"></section>
                    <div class="horizontal-line-clean my-5"></div>
                </div>

            </section>
        </div>
    </div>
</div>

<?php get_footer() ?>