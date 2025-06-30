<!doctype html>

<html
	lang="en"
	class="light-style layout-wide customizer-hide"
	dir="ltr"
	data-theme="theme-default"
	data-assets-path="<?= base_url('assets/') ?>"
	data-template="vertical-menu-template"
	data-style="light">

<head>
	<meta charset="utf-8" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>Not Authorized - Pages | Vuexy - Bootstrap Admin Template</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
		rel="stylesheet" />

	<!-- Icons -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fontawesome.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/tabler-icons.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/flag-icons.css') ?>" />

	<!-- Core CSS -->

	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/core.css') ?>" class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/theme-default.css') ?>" class="template-customizer-theme-css" />

	<link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/node-waves/node-waves.css') ?>" />

	<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/typeahead-js/typeahead.css') ?>" />

	<!-- Page CSS -->
	<!-- Page -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-misc.css') ?>" />

	<!-- Helpers -->
	<script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>
	<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

	<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
	<script src="<?= base_url('assets/vendor/js/template-customizer.js') ?>"></script>

	<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	<script src="<?= base_url('assets/js/config.js') ?>/"></script>
</head>

<body>
	<!-- Content -->

	<?php 
	$ci =& get_instance();
	$role = $ci->session->userdata('role');
	$redirect_url = ($role === 'admin') ? site_url('admin/dashboard') : site_url('welcome');
	?>

	<!-- Not Authorized -->
	<div class="container-xxl container-p-y">
		<div class="misc-wrapper">
			<h1 class="mb-2 mx-2" style="line-height: 6rem; font-size: 6rem">401</h1>
			<h4 class="mb-2 mx-2">You are not authorized! 🔐</h4>
			<p class="mb-6 mx-2">You don’t have permission to access this page. Go Home!</p>
			<a href="<?= $redirect_url ?>" class="btn btn-primary">Back to home</a>
			<div class="mt-12">
				<img
					src="<?= base_url('assets/img/illustrations/page-misc-you-are-not-authorized.png') ?>"
					alt="page-misc-not-authorized"
					width="170"
					class="img-fluid" />
			</div>
		</div>
	</div>
	<div class="container-fluid misc-bg-wrapper">
		<img
			src="<?= base_url('assets/img/illustrations/bg-shape-image-light.png') ?>"
			height="355"
			alt="page-misc-not-authorized"
			data-app-light-img="illustrations/bg-shape-image-light.png"
			data-app-dark-img="illustrations/bg-shape-image-dark.png" />
	</div>
	<!-- /Not Authorized -->

	<!-- / Content -->

	<!-- Core JS -->
	<!-- build:js assets/vendor/js/core.js -->

	<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/node-waves/node-waves.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/hammer/hammer.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/i18n/i18n.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/typeahead-js/typeahead.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>

	<!-- endbuild -->

	<!-- Vendors JS -->

	<!-- Main JS -->
	<script src="<?= base_url('assets/js/main.js') ?>"></script>

	<!-- Page JS -->
</body>

</html>