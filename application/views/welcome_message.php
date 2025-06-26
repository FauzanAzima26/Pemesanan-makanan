<!doctype html>
<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/') ?>" data-template="front-pages" data-style="light">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>Go Rasa - Restaurant Management System</title>

	<meta name="description" content="Restaurant management system for modern businesses" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />

	<!-- Fonts -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/tabler-icons.css') ?>" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

	<!-- Core CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/core.css') ?>" class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/theme-default.css') ?>" class="template-customizer-theme-css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/front-page.css') ?>" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/node-waves/node-waves.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/nouislider/nouislider.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/swiper/swiper.css') ?>" />

	<!-- Page CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/front-page-landing.css') ?>" />

	<!-- Helpers -->
	<script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>

	<!-- Template customizer -->
	<script src="<?= base_url('assets/vendor/js/template-customizer.js') ?>"></script>

	<!-- Config -->
	<script src="<?= base_url('assets/js/front-config.js') ?>"></script>
</head>

<body>
	<!-- Navbar: Start -->
	<nav class="layout-navbar shadow-none py-0">
		<div class="container">
			<div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">
				<!-- Logo -->
				<div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4 me-xl-8">
					<button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="ti ti-menu-2 ti-lg align-middle text-heading fw-medium"></i>
					</button>
					<a href="<?= site_url('/') ?>" class="app-brand-link">
						<span class="app-brand-logo demo">
							<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
								<path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
								<path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
								<path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
							</svg>
						</span>
						<span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">Go Rasa</span>
					</a>
				</div>

				<!-- Menu Items -->
				<div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
					<button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="ti ti-x ti-lg"></i>
					</button>
					<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<a class="nav-link fw-medium" aria-current="page" href="#landingHero">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-medium" href="#landingFeatures">Features</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-medium" href="#landingTeam">Team</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-medium" href="#landingFAQ">FAQ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-medium" href="#landingContact">Contact us</a>
						</li>
					</ul>

					<ul class="navbar-nav flex-row align-items-center ms-auto">
						<?php if ($this->session->userdata('logged_in')): ?>
							<!-- Avatar Dropdown -->
							<li class="nav-item navbar-dropdown dropdown-user dropdown">
								<a class="nav-link dropdown-toggle hide-arrow p-0" href="#" data-bs-toggle="dropdown">
									<div class="avatar avatar-online">
										<img src="<?= base_url('assets/img/avatars/1.png') ?>" alt class="rounded-circle" />
									</div>
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li>
										<a class="dropdown-item mt-0" href="#">
											<div class="d-flex align-items-center">
												<div class="flex-shrink-0 me-2">
													<div class="avatar avatar-online">
														<img src="<?= base_url('assets/img/avatars/1.png') ?>" alt class="rounded-circle" />
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="mb-0"><?= $this->session->userdata('nama') ?></h6>
													<small class="text-muted"><?= $this->session->userdata('role') ?></small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<div class="dropdown-divider my-1 mx-n2"></div>
									</li>
									<li>
										<a class="dropdown-item" href="#"><i class="ti ti-user me-3 ti-md"></i> My Profile</a>
									</li>
									<li>
										<a class="dropdown-item" href="#"><i class="ti ti-settings me-3 ti-md"></i> Settings</a>
									</li>
									<li>
										<div class="dropdown-divider my-1 mx-n2"></div>
									</li>
									<li>
										<div class="d-grid px-2 pt-2 pb-1">
											<a class="btn btn-sm btn-danger d-flex" href="<?= site_url('logout') ?>">
												<small class="align-middle">Logout</small>
												<i class="ti ti-logout ms-2 ti-14px"></i>
											</a>
										</div>
									</li>
								</ul>
							</li>
						<?php else: ?>
							<!-- Login Button -->
							<li>
								<a href="<?= site_url('login') ?>" class="btn btn-primary">
									<span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
									<span class="d-none d-md-block">Login/Register</span>
								</a>
							</li>
						<?php endif; ?>
					</ul>

				</div>
			</div>
		</div>
	</nav>
	<!-- Navbar: End -->

	<!-- Hero Section -->
	<section id="landingHero" class="section-py landing-hero position-relative">
		<img src="<?= base_url('assets/img/front-pages/backgrounds/hero-bg.png') ?>" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100" data-speed="1" />
		<div class="container">
			<div class="hero-text-box text-center position-relative">
				<h1 class="text-primary hero-title display-6 fw-extrabold">Go Rasa</h1>
				<h2 class="hero-sub-title h6 mb-6">
					Modern Restaurant Management System<br class="d-none d-lg-block" />
					for Reliability and Efficiency.
				</h2>
				<div class="landing-hero-btn d-inline-block position-relative">
					<a href="#landingFeatures" class="btn btn-primary btn-lg">Explore Features</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Section Daftar Menu -->
	<section class="section-py">
		<div class="container">
			<h4 class="text-center mb-4">Daftar Menu Restoran</h4>
			<div class="row justify-content-center">
				<?php if (!empty($menus)): ?>
					<?php foreach ($menus as $menu): ?>
						<div class="col-md-6 mt-8 col-lg-4">
							<div class="card">
								<img class="card-img-top" src="<?= base_url($menu->image ?: 'assets/img/no-image.png') ?>" alt="Card image cap" />
								<div class="card-body">
									<h5 class="card-title"><?= $menu->name ?></h5>
									<p class="card-text"><?= $menu->description ?></p>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item">Rp<?= number_format($menu->price, 0, ',', '.') ?></li>
								</ul>
								<div class="card-body">
									<?php if ($this->session->userdata('logged_in')): ?>
										<a href="<?= site_url('customer/cart/store/' . $menu->id) ?>" class="btn btn-sm btn-primary">
											Tambah Keranjang
										</a>
									<?php else: ?>
										<a href="<?= base_url('auth/login') ?>" class="btn btn-sm btn-primary">
											Login untuk Pesan
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p class="text-center">Belum ada menu tersedia.</p>
				<?php endif; ?>
			</div>
		</div>
	</section>


	<!-- Footer -->
	<footer class="landing-footer bg-body footer-text">
		<div class="container">
			<div class="row gx-0 gy-6 g-lg-10">
				<div class="col-lg-5">
					<a href="<?= site_url('/') ?>" class="app-brand-link mb-6">
						<span class="app-brand-logo demo">
							<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
								<path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
								<path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
								<path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
							</svg>
						</span>
						<span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">Go Rasa</span>
					</a>
					<p class="footer-text footer-logo-description mb-6">
						Comprehensive restaurant management solution for modern businesses.
					</p>
				</div>

				<div class="col-lg-2 col-md-4 col-sm-6">
					<h6 class="footer-title mb-6">Quick Links</h6>
					<ul class="list-unstyled">
						<li class="mb-4">
							<a href="#landingHero" class="footer-link">Home</a>
						</li>
						<li class="mb-4">
							<a href="#landingFeatures" class="footer-link">Features</a>
						</li>
						<li class="mb-4">
							<a href="#landingFAQ" class="footer-link">FAQ</a>
						</li>
					</ul>
				</div>

				<div class="col-lg-2 col-md-4 col-sm-6">
					<h6 class="footer-title mb-6">Account</h6>
					<ul class="list-unstyled">
						<li class="mb-4">
							<a href="<?= site_url('auth/login') ?>" class="footer-link">Login</a>
						</li>
						<li class="mb-4">
							<a href="<?= site_url('auth/register') ?>" class="footer-link">Register</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer-bottom py-3 py-md-5">
			<div class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
				<div class="mb-2 mb-md-0">
					<span class="footer-bottom-text">© <script>
							document.write(new Date().getFullYear());
						</script> Go Rasa. All rights reserved.</span>
				</div>
			</div>
		</div>
	</footer>

	<!-- Core JS -->
	<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/node-waves/node-waves.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

	<!-- Vendors JS -->
	<script src="<?= base_url('assets/vendor/libs/nouislider/nouislider.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/swiper/swiper.js') ?>"></script>

	<!-- Main JS -->
	<script src="<?= base_url('assets/js/front-main.js') ?>"></script>

	<!-- Page JS -->
	<script src="<?= base_url('assets/js/front-page-landing.js') ?>"></script>

	<!-- Smooth Scroll -->
	<script>
		$(document).ready(function() {
			// Smooth scrolling for all links
			$("a").on('click', function(event) {
				if (this.hash !== "") {
					event.preventDefault();
					var hash = this.hash;
					$('html, body').animate({
						scrollTop: $(hash).offset().top
					}, 800, function() {
						window.location.hash = hash;
					});
				}
			});
		});
	</script>
</body>

</html>