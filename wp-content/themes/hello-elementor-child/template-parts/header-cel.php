<?php

/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit;
}

$options = get_fields('options');

/**
 * Nav Menus IDs
 */

$query = new WP_Query([
	'post_type' => 'nav',
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'fields' => 'ids'
]);

wp_reset_postdata();

foreach ($query->posts as $id) {
	$navs[] = [
		'parent_id' => $id,
		'parent_name' => get_the_title($id),
		'children' => get_fields($id)
	];
}

?>

<span class="screen-darken d-lg-none"></span>

<header>
	<div class="bootstrap-container">
		<div class="timber-oldfc">
			<div class="nav-wrapper position-relative">

				<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top">

					<div class="container-fluid nav-container">
						<div class="w-100 d-flex nav-row-wrapper">
							<div class="nav-brand-wrapper d-flex justify-content-between w-100">
								<a class="navbar-brand" href="<?= get_bloginfo('url') ?>">
									<img class="nav-logo" src="<?= $options['site_logo']['url'] ?>"
										alt="<?= $options['site_logo']['alt'] ?>">
								</a>
								<div class="burger-cta-wrapper">
									<button id="hamburger-menu-icon" class="navbar-toggler" data-trigger="navbar_main"
										type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
										aria-controls="navbarSupportedContent" aria-expanded="false"
										aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>
									<a href="<?= $options['cta_button_link'] ?>" id="cta-btn-nav-mobile"
										class="main-btn cta-btn white-hover mobile-cta"><?= $options['cta_button_text'] ?>
									</a>
								</div>
							</div>
							<div class="p-0 d-flex">
								<div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
									<ul class="navbar-nav mr-auto">



										<li class="nav-item">
											<a href="<?= $options['cta_button_link'] ?>" id="cta-btn-nav-desktop"
												class="main-btn cta-btn white-hover"><?= $options['cta_button_text'] ?>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>

				</nav>

			</div>
		</div>
	</div>
</header>