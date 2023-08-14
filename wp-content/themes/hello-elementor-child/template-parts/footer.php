<?php

/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit;
}

$options = get_fields('options');

?>

<div class="bootstrap-container">
	<div class="timber-oldfc">

		<footer id="main-footer">
			<div class="footer-bg">
				<div class="container-fluid">

					<div class="row form-container">
						<div class="col-md-9 d-flex align-items-center">

							<?php if (isset($options['call_to_action_bar_title']) && $options['call_to_action_bar_title']) : ?>
								<h2>
									<?= $options['call_to_action_bar_title'] ?>
								</h2>
							<?php endif ?>

							<?php if (isset($options['call_to_action_bar_subtitle']) && $options['call_to_action_bar_subtitle']) : ?>
								<p>
									<?= $options['call_to_action_bar_subtitle'] ?>
								</p>
							<?php endif ?>

						</div>
						<div class="col-md-3 signup-button-wrapper">
							<a href="<?= $options['call_to_action_bar_button_link'] ?>" class="main-btn white-btn">
								<?= $options['call_to_action_bar_button_text'] ?>
							</a>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-6 col-md-4 address-col footer-col">
							<div class="footer-address">
								<p class="footer-title">
									<?= $options['column_1_title'] ?>
								</p>
								<ul>
									<?php foreach ($options['column_1_row'] as $item) : ?>
										<li>
											<div class="inline">
												<div class="footer-cirlce">
													<?= $item['circle_text'] ?>
												</div>
											</div>
											<div class="inline address-container">
												<div class="address">
													<a href="<?= $item['address_link'] ?>" target="_blank"><?= $item['text'] ?></a>
												</div>
											</div>
										</li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-2 footer-col">
							<p class="footer-title">
								<?= $options['column_2_title'] ?>
							</p>
							<ul>
								<?php foreach ($options['column_2_link'] as $item) : ?>
									<li><a href="<?= $item['url'] ?>"><?= $item['text'] ?></a></li>
								<?php endforeach ?>
							</ul>
							<p class="footer-title d-none d-md-block">
								<?= $options['column_2_title_bottom'] ?>
							</p>
							<ul class="d-none d-md-block">
								<?php foreach ($options['column_2_link_bottom'] as $item) : ?>
									<li><a href="<?= $item['url'] ?>"><?= $item['text'] ?></a></li>
								<?php endforeach ?>
							</ul>
						</div>
						<div class="col-12 col-sm-6 col-md-2 footer-col">
							<p class="footer-title">
								<?= $options['column_3_title'] ?>
							</p>
							<ul>
								<?php foreach ($options['column_3_link'] as $item) : ?>
									<li><a href="<?= $item['url'] ?>"><?= $item['text'] ?></a></li>
								<?php endforeach ?>
							</ul>
						</div>
						<div class="col-12 col-sm-6 col-md-2 footer-col">
							<p class="footer-title">
								<?= $options['column_4_title'] ?>
							</p>
							<ul>
								<?php foreach ($options['column_4_link'] as $item) : ?>
									<li>
										<a href="<?= $item['url'] ?>">
											<i class="fab <?= $item['icon_code'] ?>"></i><?= $item['text'] ?>
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						</div>

						<div class="col-12 col-sm-6 col-md-2 footer-col">
							<p class="footer-title">
								<?= $options['column_5_title'] ?>
							</p>
							<ul>
								<?php foreach ($options['column_5_link'] as $item) : ?>
									<li><a href="<?= $item['url'] ?>"><?= $item['text'] ?></a></li>
								<?php endforeach ?>
							</ul>
						</div>

						<div class="col-12 col-sm-6 col-md-2 footer-col d-md-none">
							<p class="footer-title">
								<?= $options['column_2_title_bottom'] ?>
							</p>
							<ul>
								<?php foreach ($options['column_2_link_bottom'] as $item) : ?>
									<li><a href="<?= $item['url'] ?>"><?= $item['text'] ?></a></li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>

				</div>
			</div>

			<div class="py-3"></div>
			<div class="back-to-top-icon-wrapper">
				<a href="javascript:;">
					<img class="back-to-top-icon" src="<?= $options['back_to_top_icon']['url'] ?>" alt="">
				</a>
			</div>
			<div class="py-5"></div>

		</footer>

	</div>
</div>