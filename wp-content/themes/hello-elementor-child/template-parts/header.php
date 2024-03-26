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

<header style="display: none;">
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
									<a href="<?= $options['cta_button_link'] ?>" id="cta-btn-nav"
										class="main-btn cta-btn white-hover mobile-cta"
										style="color: <?= $options['cta_button_color'] ?>;">
										<?= $options['cta_button_text'] ?>
									</a>
								</div>
							</div>
							<div class="p-0 d-flex">
								<div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
									<ul class="navbar-nav mr-auto">

										<?php foreach ($navs as $nav): ?>

											<li class="nav-item position-relative">

												<a id="nav-link-<?= $nav['parent_id'] ?>" data-id="<?= $nav['parent_id'] ?>"
													class="nav-link" href="javascript:;">
													<?= $nav['parent_name'] ?>
												</a>


												<div id="sub-nav-area-<?= $nav['parent_id'] ?>"
													data-id="<?= $nav['parent_id'] ?>"
													class="sub-nav-wrapper w-100 align-items-center justify-content-center">

													<div class="sub-nav-wrapper-inner">

														<div class="row w-100 flex-nowrap m-0">

															<div class="col-lg-6 border-end left-submenus">

																<?php if (isset($nav['children']['left_submenus']) && $nav['children']['left_submenus']): ?>

																	<?php foreach ($nav['children']['left_submenus'] as $groups): ?>

																		<div class="list-group mb-3">

																			<?php foreach ($groups['group_links'] as $i => $group_link): ?>

																				<a href="<?= $group_link['link']['url'] ?>"
																					class="list-group-item list-group-item-action border-0 <?= (!$i) ? 'text-uppercase pb-2 subtitle' : '' ?>">
																					<?= $group_link['link']['title'] ?>

																					<?php if (isset($group_link['link_subtitle']) && $group_link['link_subtitle']): ?>
																						<small>
																							<?= $group_link['link_subtitle'] ?>
																						</small>
																					<?php endif ?>
																				</a>

																			<?php endforeach ?>
																		</div>

																	<?php endforeach ?>

																<?php endif ?>

															</div>

															<div
																class="col-lg-6 right-submenus <?= (isset($nav['children']['right_content']['custom_html']) && $nav['children']['right_content']['custom_html']) ? 'p-0' : '' ?>">

																<?php if (isset($nav['children']['right_submenus']) && $nav['children']['right_submenus']): ?>

																	<?php foreach ($nav['children']['right_submenus'] as $groups): ?>

																		<div class="list-group">

																			<?php foreach ($groups['group_links'] as $i => $group_link): ?>

																				<a href="<?= $group_link['link']['url'] ?>"
																					class="list-group-item list-group-item-action border-0 <?= (!$i) ? 'text-uppercase pb-3 subtitle' : '' ?>">
																					<?= $group_link['link']['title'] ?>
																				</a>

																			<?php endforeach ?>
																		</div>

																	<?php endforeach ?>

																<?php endif ?>

																<?php if (isset($nav['children']['right_content']['custom_html']) && $nav['children']['right_content']['custom_html']): ?>
																	<div class="custom-html">
																		<?= $nav['children']['right_content']['custom_html'] ?>
																	</div>
																<?php endif ?>

															</div>

														</div>
													</div>
												</div>


											</li>
										<?php endforeach ?>
										<li class="nav-item menu-expand hidden">
											<a href="javascript:;"><i class="fa-solid fa-angle-left"></i> MENU</a>
										</li>
										<li class="nav-item">
											<a href="<?= $options['cta_button_link'] ?>" id="cta-btn-nav"
												class="main-btn cta-btn white-hover"
												style="color: <?= $options['cta_button_color'] ?>; background-color: #38195b !important; border: #38195b;">
												<?= $options['cta_button_text'] ?>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>

				</nav>

				<!-- mobile/begin -->

				<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg mobile-nav d-lg-none py-0">
					<div class="w-100 mobile-nav-wrapper-flex">
						<div>
							<ul class="navbar-nav navbar-nav-moible mt-3">

								<?php foreach ($navs as $nav): ?>
									<li class="nav-item">
										<a id="mobile-nav-link-<?= $nav['parent_id'] ?>"
											data-trigger="mobile_nav_submenu_<?= $nav['parent_id'] ?>"
											class="nav-link mobile-nav-link" href="javascript:;">
											<?= $nav['parent_name'] ?>
											<img class="mobile-nav-link-arrow"
												src="<?= $options['subnav_link_arrow']['url'] ?>"
												alt="<?= $options['subnav_link_arrow']['alt'] ?>">
										</a>
									</li>
								<?php endforeach ?>

							</ul>
						</div>
						<ul class="navbar-nav navbar-nav-moible">
							<li><span class="nav-link mobile-btn-close mobile-btn-close-back fc-orange">close</span>
							</li>
						</ul>
					</div>
				</nav>

				<?php foreach ($navs as $nav): ?>

					<div id="mobile_nav_submenu_<?= $nav['parent_id'] ?>"
						class="mobile-offcanvas w-100 level-2 mobile-nav d-lg-none">
						<div class="w-100">

							<div class="left-submenus">
								<?php if (isset($nav['children']['left_submenus']) && $nav['children']['left_submenus']): ?>

									<?php foreach ($nav['children']['left_submenus'] as $groups): ?>

										<div class="list-group mb-3">

											<?php foreach ($groups['group_links'] as $i => $group_link): ?>

												<a href="<?= $group_link['link']['url'] ?>"
													class="list-group-item list-group-item-action border-0 <?= (!$i) ? 'text-uppercase pb-3 subtitle' : '' ?>">
													<?= $group_link['link']['title'] ?>

													<?php if (isset($group_link['link_subtitle']) && $group_link['link_subtitle']): ?>
														<small>
															<?= $group_link['link_subtitle'] ?>
														</small>
													<?php endif ?>
												</a>

											<?php endforeach ?>
										</div>

									<?php endforeach ?>

								<?php endif ?>
							</div>

							<div class="right-submenus">
								<?php if (isset($nav['children']['right_submenus']) && $nav['children']['right_submenus']): ?>

									<?php foreach ($nav['children']['right_submenus'] as $groups): ?>

										<div class="list-group">

											<?php foreach ($groups['group_links'] as $i => $group_link): ?>

												<a href="<?= $group_link['link']['url'] ?>"
													class="list-group-item list-group-item-action border-0 <?= (!$i) ? 'text-uppercase pb-3 subtitle' : '' ?>">
													<?= $group_link['link']['title'] ?>
												</a>

											<?php endforeach ?>
										</div>

									<?php endforeach ?>

								<?php endif ?>

								<?php if (isset($nav['children']['right_content']['custom_html']) && $nav['children']['right_content']['custom_html']): ?>
									<div class="custom-html">
										<?= $nav['children']['right_content']['custom_html'] ?>
									</div>
								<?php endif ?>
							</div>

							<div>
								<ul class="navbar-nav navbar-nav-moible">
									<li>
										<span class="nav-link mobile-btn-close-back mobile-btn-back fc-orange py-0">
											back
										</span>
									</li>
								</ul>
								<div class="py-5"></div>
							</div>
						</div>
					</div>

				<?php endforeach ?>

				<!-- mobile/end -->















			</div>
		</div>
	</div>
</header>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelector('header').style.display = 'flex';
	});
</script>