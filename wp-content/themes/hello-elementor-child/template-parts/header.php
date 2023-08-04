<?php

/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$options = get_fields('options');
$theme_location = 'menu-1';
$locations = get_nav_menu_locations();
$menu_id   = $locations[$theme_location];
$menu_object  = wp_get_nav_menu_object($menu_id);
$menu_items = wp_get_nav_menu_items($menu_object->term_id, ['update_post_term_cache' => false]);

?>

<span class="screen-darken d-lg-none"></span>

<header>
	<div class="bootstrap-container">
		<div class="custom-header-menu">
			<div class="nav-wrapper position-relative">
				<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
					<div class="container-fluid nav-container p-0">
						<div class="w-100 d-flex nav-row-wrapper">
							<div class="nav-brand-wrapper d-flex justify-content-between w-100">
								<a class="navbar-brand" href="<?= get_bloginfo('url') ?>">
									<img class="nav-logo" src="<?= $options['site_logo']['url'] ?>" alt="<?= $options['site_logo']['alt'] ?>">
								</a>
								<div class="burger-cta-wrapper">
									<button id="hamburger-menu-icon" class="navbar-toggler" data-trigger="navbar_main" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>
									<a href="<?= $options['cta_button_link'] ?>" id="cta-btn-nav" class="main-btn cta-btn white-hover mobile-cta" style="color: <?= $options['cta_button_color'] ?>;">
										<?= $options['cta_button_text'] ?>
									</a>
								</div>
							</div>
							<div class="p-0 d-flex">
								<div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
									<ul class="navbar-nav mr-auto">
										<?php foreach ($menu_items as $item) : ?>
											<li class="nav-item">
												<a id="nav-link-<?= $item->ID ?>" data-id="<?= $item->ID ?>" class="nav-link" href="<?= $item->url ? $item->url : 'javascript:;' ?>">
													<?= $item->title ?>
													<img class="nav-arrow" src="<?= $options['nav_arrow']['url'] ?>" alt="">
												</a>
											</li>
										<?php endforeach ?>
										<li class="nav-item menu-expand hidden">
											<a href="javascript:;"><i class="fa-solid fa-angle-left"></i> MENU</a>
										</li>
										<li class="nav-item">
											<a href="<?= $options['cta_button_link'] ?>" id="cta-btn-nav" class="main-btn cta-btn white-hover" style="color: <?= $options['cta_button_color'] ?>;">
												<?= $options['cta_button_text'] ?>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div id="sub-nav-area-37860" data-id="37860" class="sub-nav-wrapper w-100 dropdown-content">
						<div class="container sub-nav-container-1075">
							<div class="w-100 my-5 sub-nav-row-3">
								<div class="">
									<span class="subnav-title">
										<?= $options['subnav_6_title_1'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_6_col_1_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="line-divider"></div>
								<div class="">
									<span class="subnav-title">
										<?= $options['subnav_6_title_2'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_6_col_2_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="d-none">
									<span class="subnav-title" style="visibility: hidden; height: 10px;">
										<?= $options['subnav_6_title_3'] ?>
									</span>
									<?php if (isset($options['subnav_6_col_3_link']) && $options['subnav_6_col_3_link']) : ?>
										<ul>
											<?php foreach ($options['subnav_6_col_3_link'] as $item) : ?>
												<a href="<?= $item['url'] ?>" class="subnav-link-a">
													<li class="subnav-li">
														<div class="link-left">
															<span class="subnav-link-title bold-smaller">
																<?= $item['title'] ?>
															</span>
															<div class="subnav-link-subtitle">
																<?= $item['subtitle'] ?>
															</div>
														</div>
													</li>
												</a>
												<div class="mb-2 pb-4"></div>
											<?php endforeach ?>
										</ul>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
					<div id="sub-nav-area-14" data-id="14" class="sub-nav-wrapper w-100 dropdown-content">
						<div class="container sub-nav-container-775">
							<div class="w-100 my-5 sub-nav-row-2">
								<div class="subnav-border-right">
									<span class="subnav-title">
										<?= $options['subnav_1_title_1'] ?>
									</span>
									<img class="subnav-1-image img-fluid" src="<?= $options['subnav_1_image']['url'] ?>" alt="<?= $options['subnav_1_image']['alt'] ?>">
									<div class="link-left">
										<span class="subnav-link-title mt-3">
											<?= $options['subnav_1_heading_1'] ?>
										</span>
										<p class="subnav-paragraph">
											<?= $options['subnav_1_paragraph_1'] ?>
										</p>
										<div class="learn-more-wrapper">
											<a href="<?= $options['subnav_1_link_url'] ?>">
												<div class="learn-more-link">
													<?= $options['subnav_1_link_text'] ?>
												</div>
											</a>
										</div>
									</div>
								</div>
								<div>
									<span class="subnav-title">
										<?= $options['subnav_1_title_2'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_1_col_2_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-icon-subnav">
														<img src="<?= $item['icon']['url'] ?>" alt="<?= $item['icon']['alt'] ?>">
													</div>
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div id="sub-nav-area-15" data-id="15" class="sub-nav-wrapper w-100 dropdown-content">
						<div class="container sub-nav-container-1075">
							<div class="w-100 my-5 sub-nav-row-3">
								<div class="">
									<span class="subnav-title">
										<?= $options['subnav_2_title_1'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_2_col_1_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="line-divider"></div>
								<div class="">
									<span class="subnav-title">
										<?= $options['subnav_2_title_2'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_2_col_2_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="d-none">
									<span class="subnav-title">
										<?= $options['subnav_2_title_3'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_2_col_3_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div id="sub-nav-area-32354" data-id="32354" class="sub-nav-wrapper w-100 dropdown-content">
						<div class="container sub-nav-container-1075">
							<div class="w-100 my-5 sub-nav-row-3">
								<div class="">
									<span class="subnav-title">
										<?= $options['subnav_5_title_1'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_5_col_1_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="line-divider"></div>
								<div class="">
									<span class="subnav-title">
										<?= $options['subnav_5_title_2'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_5_col_2_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div>
									<span class="subnav-title" style="visibility: hidden; height: 10px;">
										<?= $options['subnav_5_title_3'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_5_col_3_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
														<div class="subnav-link-subtitle">
															<?= $item['subtitle'] ?>
														</div>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-4"></div>
										<?php endforeach ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div id="sub-nav-area-16" data-id="16" class="sub-nav-wrapper w-100 dropdown-content">
						<div class="container sub-nav-container-960">
							<div class="row w-100 my-5">
								<div class="col-4">
									<span class="subnav-title">
										<?= $options['subnav_3_title_1'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_3_col_1_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-1"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="col-8">
									<?= fc_get_latest_resource() ?>
								</div>
							</div>
						</div>
					</div>
					<div id="sub-nav-area-17" data-id="17" class="sub-nav-wrapper w-100 dropdown-content">
						<div class="container sub-nav-container-960">
							<div class="row w-100 my-5">
								<div class="col-4">
									<span class="subnav-title">
										<?= $options['subnav_4_title_1'] ?>
									</span>
									<ul>
										<?php foreach ($options['subnav_4_col_1_link'] as $item) : ?>
											<a href="<?= $item['url'] ?>" class="subnav-link-a">
												<li class="subnav-li">
													<div class="link-left">
														<span class="subnav-link-title bold-smaller">
															<?= $item['title'] ?>
														</span>
													</div>
												</li>
											</a>
											<div class="mb-2 pb-1"></div>
										<?php endforeach ?>
									</ul>
								</div>
								<div class="col-8">
									<?= fc_get_latest_press() ?>
								</div>
							</div>
						</div>
					</div>
				</nav>
				<!-- ============= Mobile Nav - Level 1 ============== -->
				<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg mobile-nav d-lg-none py-0">
					<div class="w-100 mobile-nav-wrapper-flex">
						<div>
							<ul class="navbar-nav navbar-nav-moible mt-3">
								<?php foreach ($menu_items as $item) : ?>
									<li class="nav-item">
										<a id="mobile-nav-link-<?= $item->ID ?>" data-trigger="mobile_nav_submenu_<?= $item->ID ?>" class="nav-link mobile-nav-link" href="javascript:;">
											<?= $item->title ?>
											<img class="mobile-nav-link-arrow" src="<?= $options['subnav_link_arrow']['url'] ?>" alt="<?= $options['subnav_link_arrow']['alt'] ?>">
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						</div>
						<ul class="navbar-nav navbar-nav-moible">
							<li><span class="nav-link mobile-btn-close mobile-btn-close-back fc-orange">close</span></li>
						</ul>
					</div>
				</nav>
				<!-- ============= Mobile Menu Submenu (Level 2 - Link 3) // ============== -->
				<div id="mobile_nav_submenu_37860" class="mobile-offcanvas w-100 level-2 mobile-nav d-lg-none">
					<div class="w-100 pt-3">
						<div class="subnav-border-right">
							<span class="subnav-title d-none">
								<?= $options['subnav_6_title_1'] ?>
							</span>
							<ul class="mobile-subnav-ul">
								<?php foreach ($options['subnav_6_col_1_link'] as $item) : ?>
									<a href="<?= $item['url'] ?>" class="subnav-link-a">
										<li class="subnav-li">
											<div class="link-left">
												<span class="subnav-link-title bold-smaller">
													<?= $item['title'] ?>
												</span>
												<div class="subnav-link-subtitle">
													<?= $item['subtitle'] ?>
												</div>
											</div>
										</li>
									</a>
								<?php endforeach ?>
							</ul>
						</div>
						<div class="horizontal-line"></div>
						<div class="">
							<span class="subnav-title">
								<?= $options['subnav_6_title_2'] ?>
							</span>
							<ul class="mobile-subnav-ul">
								<?php foreach ($options['subnav_6_col_2_link'] as $item) : ?>
									<a href="<?= $item['url'] ?>" class="subnav-link-a">
										<li class="subnav-li">
											<div class="link-icon-subnav d-none">
												<img src="<?= $item['icon']['url'] ?>" alt="<?= $item['icon']['alt'] ?>">
											</div>
											<div class="link-left">
												<span class="subnav-link-title bold-smaller">
													<?= $item['title'] ?>
												</span>
												<div class="subnav-link-subtitle">
													<?= $item['subtitle'] ?>
												</div>
											</div>
										</li>
									</a>
								<?php endforeach ?>
							</ul>
						</div>
						<div>

							<?php if (isset($options['subnav_6_title_3']) && $options['subnav_6_title_3']) : ?>
								<span class="subnav-title">
									<?= $options['subnav_6_title_3'] ?>
								</span>
							<?php endif ?>

							<?php if (isset($options['subnav_6_col_3_link']) && $options['subnav_6_col_3_link']) : ?>
								<ul class="mobile-subnav-ul">
									<?php foreach ($options['subnav_6_col_3_link'] as $item) : ?>
										<a href="<?= $item['url'] ?>" class="subnav-link-a">
											<li class="subnav-li">
												<div class="link-icon-subnav d-none">
													<img src="<?= $item['icon']['url'] ?>" alt="<?= $item['icon']['alt'] ?>">
												</div>
												<div class="link-left">
													<span class="subnav-link-title bold-smaller">
														<?= $item['title'] ?>
													</span>
													<div class="subnav-link-subtitle">
														<?= $item['subtitle'] ?>
													</div>
												</div>
											</li>
										</a>
									<?php endforeach ?>
								</ul>
							<?php endif ?>

							<ul class="navbar-nav navbar-nav-moible">
								<li><span class="nav-link mobile-btn-close-back mobile-btn-back fc-orange py-0">back</span></li>
							</ul>
							<div class="py-5"></div>
						</div>
					</div>
				</div>
				<!-- ============= END - Mobile Menu Submenu (Level 2 - Link 3) ============== -->
				<!-- ============= Mobile Menu Submenu (Level 2 - Link 1) // ============== -->
				<div id="mobile_nav_submenu_14" class="mobile-offcanvas w-100 level-2 mobile-nav d-lg-none">
					<div class="w-100 pt-3">
						<div class="subnav-border-right">
							<span class="subnav-title">
								<?= $options['subnav_1_title_1'] ?>
							</span>
							<img class="subnav-1-image img-fluid" src="{{ options.subnav_1_image.url }}" alt="{{ options.subnav_1_image.alt }}" />
							<div class="link-left">
								<span class="subnav-link-title subnav-link-title-heading">
									{{ options.subnav_1_heading_1 }}
								</span>
								<div class="subnav-link-subtitle">
									{{ options.subnav_1_subheading_1 }}
								</div>
								<p class="subnav-paragraph">
									{{ options.subnav_1_paragraph_1 }}
								</p>
								<div class="learn-more-wrapper">
									<a href="{{ options.subnav_1_link_url }}">
										<div class="learn-more-link">
											{{ options.subnav_1_link_text }}
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="">
							<span class="subnav-title">
								{{ options.subnav_1_title_2 }}
							</span>
							<ul class="mobile-subnav-ul mb-0">
								{% for item in options.subnav_1_col_2_link %}
								<a href="{{ item.url }}" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav">
											<img src="{{ item.icon.url }}" alt="{{ item.icon.alt }}" />
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												{{ item.title }}
											</span>
											<div class="subnav-link-subtitle">
												{{ item.subtitle }}
											</div>
										</div>
									</li>
								</a>
								{# <div class="mb-3 pb-3"></div> #}
								{% endfor %}
							</ul>
						</div>
						<div class="">
							<ul class="navbar-nav navbar-nav-moible">
								<li><span class="nav-link mobile-btn-close-back mobile-btn-back fc-orange py-0">back</span></li>
							</ul>
							<div class="py-5"></div>
						</div>
					</div>
				</div>
				<!-- ============= END - Mobile Menu Submenu (Level 2) ============== -->
				<!-- ============= Mobile Menu Submenu (Level 2 - Link 2) // ============== -->
				<div id="mobile_nav_submenu_15" class="mobile-offcanvas w-100 level-2 mobile-nav d-lg-none">
					<div class="w-100 pt-3">
						<div class="subnav-border-right">
							<span class="subnav-title">
								Explore FC
							</span>
							<ul class="mobile-subnav-ul">
								<a href="/solutions/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												All Solutions
											</span>
											<div class="subnav-link-subtitle">
												Insights for all
											</div>
										</div>
									</li>
								</a>
								<a href="/customer-stories/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Customer Stories
											</span>
											<div class="subnav-link-subtitle">
												Become legendary
											</div>
										</div>
									</li>
								</a>
							</ul>
						</div>
						<div class="horizontal-line"></div>
						<div class="">
							<span class="subnav-title">
								What do you need?
							</span>
							<ul class="mobile-subnav-ul">
								<a href="/solutions/market-intelligence/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Market Intelligence
											</span>
											<div class="subnav-link-subtitle">
												Exploration
											</div>
										</div>
									</li>
								</a>
								<a href="/solutions/product-intelligence/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Product Intelligence
											</span>
											<div class="subnav-link-subtitle">
												Development &amp; validation
											</div>
										</div>
									</li>
								</a>
								<a href="/solutions/brand-intelligence/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Brand Intelligence
											</span>
											<div class="subnav-link-subtitle">
												Plan, launch, measure &amp; refine
											</div>
										</div>
									</li>
								</a>
							</ul>
						</div>
						<div class="">
							<span class="subnav-title">
							</span>
							<ul class="mobile-subnav-ul">
								<a href="" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
								<a href="" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
								<a href="" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
							</ul>
							<ul class="navbar-nav navbar-nav-moible">
								<li><span class="nav-link mobile-btn-close-back mobile-btn-back fc-orange py-0">back</span></li>
							</ul>
							<div class="py-5"></div>
						</div>
					</div>
				</div>
				<!-- ============= END - Mobile Menu Submenu (Level 2 - Link 2) ============== -->
				<!-- ============= Mobile Menu Submenu (Level 2 - Link 3) // ============== -->
				<div id="mobile_nav_submenu_32354" class="mobile-offcanvas w-100 level-2 mobile-nav d-lg-none">
					<div class="w-100 pt-3">
						<div class="subnav-border-right">
							<span class="subnav-title">
								Explore FC
							</span>
							<ul class="mobile-subnav-ul">
								<a href="/industries/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												All Industries
											</span>
											<div class="subnav-link-subtitle">
												Insights for all
											</div>
										</div>
									</li>
								</a>
								<a href="/customer-stories/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Customer Stories
											</span>
											<div class="subnav-link-subtitle">
												Become legendary
											</div>
										</div>
									</li>
								</a>
							</ul>
						</div>
						<div class="horizontal-line"></div>
						<div class="">
							<span class="subnav-title">
								Industries
							</span>
							<ul class="mobile-subnav-ul">
								<a href="/industries/cpg-retail/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												CPG &amp; Retail
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
								<a href="/industries/financial-services-insurance/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Financial Services &amp; Insurance
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
								<a href="/industries/media-entertainment/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Media &amp; Entertainment
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
							</ul>
						</div>
						<div class="">
							<span class="subnav-title">
							</span>
							<ul class="mobile-subnav-ul">
								<a href="/industries/healthcare/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Healthcare
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
								<a href="/industries/technology/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Technology
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
								<a href="/industries/gaming/" class="subnav-link-a">
									<li class="subnav-li">
										<div class="link-icon-subnav d-none">
											<img src="https://fuelcycle.com/" alt="">
										</div>
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Gaming
											</span>
											<div class="subnav-link-subtitle">
											</div>
										</div>
									</li>
								</a>
							</ul>
							<ul class="navbar-nav navbar-nav-moible">
								<li><span class="nav-link mobile-btn-close-back mobile-btn-back fc-orange py-0">back</span></li>
							</ul>
							<div class="py-5"></div>
						</div>
					</div>
				</div>
				<!-- ============= END - Mobile Menu Submenu (Level 2 - Link 3) ============== -->
				<!-- ============= Mobile Menu Submenu (Level 2 - Link 4) // ============== -->
				<div id="mobile_nav_submenu_16" class="mobile-offcanvas w-100 level-2 mobile-nav d-lg-none">
					<div class="max-width-350 pt-3">
						<span class="subnav-title">
						</span>
						<div class="col-12">
							<div class="subnav-3-right-wrapper-mobile">
								<img class="featured-post-image img-fluid lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABBIAAAQSAQAAAAA6I+RrAAAAAnRSTlMAAHaTzTgAAACcSURBVHja7cGBAAAAAMOg+VPf4ARVAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPAMGWYAAXoQAssAAAAASUVORK5CYII=" alt="research engine blog" data-src="https://epzh9qjkr840.exactdn.com/wp-content/uploads/2023/07/MicrosoftTeams-image-26.jpg?strip=all&amp;lossy=1&amp;ssl=1" decoding="async" data-eio-rwidth="1042" data-eio-rheight="1042"><noscript><img class="featured-post-image img-fluid" src="https://epzh9qjkr840.exactdn.com/wp-content/uploads/2023/07/MicrosoftTeams-image-26.jpg?strip=all&lossy=1&ssl=1" alt="research engine blog" data-eio="l" /></noscript>
								<div class="featured-post-text-area-mobile pr-1">
									<span class="d-block featured-post-category">Blog</span>
									<a href="/blog/transforming-market-research-for-the-future-unleashing-the-power-of-the-research-engine/" class="subnav-link-a">
										<span class="featured-post-title featured-post-title-mobile">
											Transforming Market Research for the Future: Unleashing the Power of the Research
											Engine
										</span>
										<p class="featured-post-paragraph featured-post-paragraph-mobile">
											In order to stay ahead, brands must not only demonstrate agility and…
										</p>
									</a>
								</div>
							</div>
						</div>
						<div class="horizontal-line mt-3 mt-md-4"></div>
						<div class="col-12">
							<span class="subnav-title">
								Resources
							</span>
							<ul class="mobile-subnav-ul">
								<a href="/resource-hub/" class="subnav-link-a">
									<li class="subnav-li mb-2 pb-1">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												All Resources
											</span>
										</div>
									</li>
								</a>
								<a href="/events-webinars/" class="subnav-link-a">
									<li class="subnav-li mb-2 pb-1">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Events &amp; Webinars
											</span>
										</div>
									</li>
								</a>
								<a href="/education/" class="subnav-link-a">
									<li class="subnav-li mb-2 pb-1">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Education
											</span>
										</div>
									</li>
								</a>
							</ul>
						</div>
						<div class="mb-4 pb-3"></div>
						<ul class="navbar-nav navbar-nav-moible">
							<li><span class="nav-link mobile-btn-close-back mobile-btn-back fc-orange py-0">back</span></li>
						</ul>
						<div class="py-5"></div>
					</div>
				</div>
				<!-- ============= END - Mobile Menu Submenu (Level 2 Link 4) ============== -->
				<!-- ============= Mobile Menu Submenu (Level 2 - Link 5) // ============== -->
				<div id="mobile_nav_submenu_17" class="mobile-offcanvas w-100 level-2 mobile-nav d-lg-none">
					<div class="max-width-350 pt-3">
						<div class="col-12">
							<span class="subnav-title">
								Company
							</span>
							<ul class="mobile-subnav-ul">
								<a href="/about-us/" class="subnav-link-a">
									<li class="subnav-li mb-2 pb-1">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												About FC
											</span>
										</div>
									</li>
								</a>
								<a href="https://careers.fuelcycle.com/" class="subnav-link-a">
									<li class="subnav-li mb-2 pb-1">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Careers
											</span>
										</div>
									</li>
								</a>
								<a href="/awards/" class="subnav-link-a">
									<li class="subnav-li mb-2 pb-1">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Awards
											</span>
										</div>
									</li>
								</a>
								<a href="/contact-us/" class="subnav-link-a">
									<li class="subnav-li mb-2 pb-1">
										<div class="link-left">
											<span class="subnav-link-title bold-smaller">
												Contact
											</span>
										</div>
									</li>
								</a>
							</ul>
						</div>
						<span class="subnav-title">
						</span>
						<div class="col-12">
							<div class="subnav-3-right-wrapper-mobile">
								<img class="featured-post-image img-fluid lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABBIAAAQSAQAAAAA6I+RrAAAAAnRSTlMAAHaTzTgAAACcSURBVHja7cGBAAAAAMOg+VPf4ARVAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPAMGWYAAXoQAssAAAAASUVORK5CYII=" alt="FC Logo" data-src="https://epzh9qjkr840.exactdn.com/wp-content/uploads/2023/07/MicrosoftTeams-image-25.png?strip=all&amp;lossy=1&amp;ssl=1" decoding="async" data-eio-rwidth="1042" data-eio-rheight="1042"><noscript><img class="featured-post-image img-fluid" src="https://epzh9qjkr840.exactdn.com/wp-content/uploads/2023/07/MicrosoftTeams-image-25.png?strip=all&lossy=1&ssl=1" alt="FC Logo" data-eio="l" /></noscript>
								<div class="featured-post-text-area-mobile pr-1">
									<span class="d-block featured-post-category">Press</span>
									<a href="/press/fuel-cycle-introduces-the-research-engine/" class="subnav-link-a">
										<span class="featured-post-title featured-post-title-mobile">
											Fuel Cycle Ignites and Revolutionizes the Future of Market Research with the
											‘Research Engine’
										</span>
										<p class="featured-post-paragraph featured-post-paragraph-mobile">
											Reimagining agile research solutions for progressive brands in…
										</p>
									</a>
								</div>
							</div>
						</div>
						<div class="mb-4 pb-3"></div>
						<ul class="navbar-nav navbar-nav-moible">
							<li><span class="nav-link mobile-btn-close-back mobile-btn-back fc-orange py-0">back</span></li>
						</ul>
						<div class="py-5"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>