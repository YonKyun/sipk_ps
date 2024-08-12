<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?= $judul . ' - ' . var_judul(); ?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="<?= base_url('assets/img/favicon.png'); ?>" rel="icon">
	<link href="<?= base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/animate.css/animate.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/aos/aos.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
	<script src="<?= base_url('assets/vendor/jquery/jquery-3.7.0.min.js'); ?>"></script>
</head>

<body>
	<header id="header" class="fixed-top">
		<div class="container d-flex align-items-center">
			<h1 class="logo me-auto"><a href="<?= base_url(); ?>"><span><?= var_judul1(); ?></span> <?= var_judul2(); ?></a></h1>
			<!-- <a href="<?= base_url(); ?>" class="logo me-auto me-lg-0"><img src="<?= base_url('assets/img/logo.png'); ?>" alt="" class="img-fluid"></a> -->
			<nav id="navbar" class="navbar order-last order-lg-0">
				<ul>
					<li><a href="<?= base_url(); ?>" class="ms-3 ps-0 fs-6<?= ('Beranda' == $judul) ? ' active' : ''; ?>">Beranda</a></li>
					<li><a href="<?= base_url('kejuaraan'); ?>" class="ms-3 ps-0 fs-6<?= ('Kejuaraan' == $judul) ? ' active' : ''; ?>">Kejuaraan</a></li>
					<?php if ($login) { ?>
						<?php if (!$peserta) { ?>
							<li>
								<a href="<?= base_url('dasbor'); ?>" class="btn btn-success ms-3 px-3 py-2 link-light">Dasbor</a>
							</li>
						<?php } ?>
						<li>
							<a href="<?= base_url('logout'); ?>" class="btn btn-danger ms-3 px-3 py-2 link-light">Logout</a>
						</li>
					<?php } else { ?>
						<li>
							<?php if ('Login' == $judul) { ?>
								<a href="<?= base_url('register'); ?>" class="btn btn-success ms-3 px-3 py-2 link-light">Register</a>
							<?php } else { ?>
								<a href="<?= base_url('login'); ?>" class="btn btn-success ms-3 px-3 py-2 link-light">Login</a>
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav>
		</div>
	</header>