<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="<?= base_url('assets/dasbor/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="<?= base_url('assets/dasbor/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
	<script src="<?= base_url('assets/dasbor/vendor/jquery/jquery.min.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/dasbor/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
	<script src="<?= base_url('assets/dasbor/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?= base_url('assets/dasbor/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
	<title><?= $judul; ?></title>
</head>

<body id="page-top">
	<div id="wrapper">
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
				<div class="sidebar-brand-icon"><i class="fas fa-yin-yang"></i></div>
				<div class="sidebar-brand-text pl-2"><?= var_inisial(); ?></div>
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item<?= ('Dashboard' == $judul) ? ' active' : ''; ?>">
				<a class="nav-link" href="<?= base_url('dasbor'); ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<?php if ($admin) { ?>
				<?php $cek_data = (false !== strpos($judul, 'Data ')) ? true : false;
				?>
				<li class="nav-item<?= $cek_data ? ' active' : ''; ?>">
					<a class="nav-link<?= $cek_data ? '' : ' collapsed'; ?>" href="#" data-toggle="collapse" data-target="#data" aria-expanded="true" aria-controls="data">
						<i class="fas fa-fw fa-database"></i>
						<span>Data</span>
					</a>
					<div id="data" class="collapse<?= $cek_data ? ' show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item<?= ('Data Admin' == $judul) ? ' active' : ''; ?>" href="<?= base_url('dasbor/data_admin'); ?>">
								<i class="fas fa-fw fa-clipboard-list"></i>
								<span>Data Admin</span>
							</a>
							<a class="collapse-item<?= ('Data Bendahara' == $judul) ? ' active' : ''; ?>" href="<?= base_url('dasbor/data_bendahara'); ?>">
								<i class="fas fa-fw fa-clipboard-list"></i>
								<span>Data Bendahara</span>
							</a>
							<a class="collapse-item<?= ('Data Panitia' == $judul) ? ' active' : ''; ?>" href="<?= base_url('dasbor/data_panitia'); ?>">
								<i class="fas fa-fw fa-clipboard-list"></i>
								<span>Data Panitia</span>
							</a>
							<a class="collapse-item<?= ('Data Juri' == $judul) ? ' active' : ''; ?>" href="<?= base_url('dasbor/data_juri'); ?>">
								<i class="fas fa-fw fa-clipboard-list"></i>
								<span>Data Juri</span>
							</a>
							<a class="collapse-item<?= ('Data Peserta' == $judul) ? ' active' : ''; ?>" href="<?= base_url('dasbor/data_peserta'); ?>">
								<i class="fas fa-fw fa-clipboard-list"></i>
								<span>Data Peserta</span>
							</a>
							<a class="collapse-item<?= ('Data Kejuaraan' == $judul) ? ' active' : ''; ?>" href="<?= base_url('dasbor/data_kejuaraan'); ?>">
								<i class="fas fa-fw fa-clipboard-list"></i>
								<span>Data Kejuaraan</span>
							</a>
						</div>
					</div>
				</li>
			<?php } ?>
			<?php if ($bendahara) { ?>
				<li class="nav-item<?= (false !== strpos($judul, 'Approve Panitia')) ? ' active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('dasbor/approve_panitia'); ?>">
						<i class="fas fa-fw fa-check"></i>
						<span>Approve Panitia</span>
					</a>
				</li>
			<?php } ?>
			<?php if ($panitia_belum) { ?>
				<li class="nav-item<?= (false !== strpos($judul, 'Upload Bukti Pembayaran')) ? ' active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('dasbor/upload_bukti'); ?>">
						<i class="fas fa-fw fa-upload"></i>
						<span>Upload Bukti</span>
					</a>
				</li>
			<?php } ?>
			<?php if ($panitia_sudah) { ?>
				<li class="nav-item<?= ('Data Kejuaraan' == $judul) ? ' active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('dasbor/data_kejuaraan'); ?>">
						<i class="fas fa-fw fa-clipboard-list"></i>
						<span>Data Kejuaraan</span>
					</a>
				</li>
				<li class="nav-item<?= (false !== strpos($judul, 'Pendaftaran')) ? ' active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('dasbor/pendaftaran'); ?>">
						<i class="fas fa-fw fa-users"></i>
						<span>Pendaftaran</span>
					</a>
				</li>
			<?php } ?>
			<?php if (!$bendahara and !$panitia_belum) { ?>
				<li class="nav-item<?= ('Bagan Pertandingan' == $judul) ? ' active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('dasbor/bagan_pertandingan'); ?>">
						<i class="fas fa-fw fa-table"></i>
						<span>Bagan Pertandingan</span>
					</a>
				</li>
				<li class="nav-item<?= ('Riwayat Pertandingan' == $judul) ? ' active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('dasbor/riwayat_pertandingan'); ?>">
						<i class="fas fa-fw fa-history"></i>
						<span>Riwayat Pertandingan</span>
					</a>
				</li>
			<?php } ?>
			<?php if ($juri) { ?>
				<li class="nav-item<?= (false !== strpos($judul, 'Input Skor')) ? ' active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('dasbor/input_skor'); ?>">
						<i class="fas fa-fw fa-pencil-alt"></i>
						<span>Input Skor</span>
					</a>
				</li>
			<?php } ?>
			<li class="nav-item<?= ('Edit Profil' == $judul) ? ' active' : ''; ?>">
				<a class="nav-link" href="<?= base_url('dasbor/edit_profil'); ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Edit Profil</span>
				</a>
			</li>
			<hr class="sidebar-divider my-0">
		</ul>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
					<h4 class="text-dark font-weight-bold mb-0"><?= $judul; ?></h4>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $saya['nama_user']; ?></span>
								<img class="img-profile rounded-circle" src="<?= base_url(); ?>assets/dasbor/img/undraw_profile.svg">
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
							</div>
						</li>
					</ul>
				</nav>
				<div class="container-fluid">