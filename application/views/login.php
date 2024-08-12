<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2 class="my-auto"><?= $judul; ?></h2>
				<ol>
					<li><a href="<?= base_url(); ?>">Beranda</a></li>
					<li><?= $judul; ?></li>
				</ol>
			</div>
		</div>
	</section>
	<section class="contact">
		<div class="container">
			<div class="row justify-content-center" data-aos="fade-up">
				<div class="col-md-8 col-lg-6">
					<form action="<?= base_url('login/login'); ?>" method="post" class="php-email-form">
						<?php if ($this->session->flashdata('danger')) { ?>
							<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
								<strong>Aksi Gagal!</strong><br /><?= $this->session->flashdata('danger'); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
						<input type="text" name="username" class="form-control" placeholder="Username" required>
						<input type="password" class="form-control mt-3" name="password" placeholder="Password" required>
						<div class="text-center">
							<button class="my-3" type="submit">Login</button>
							<br />
							<span>Belum punya Akun? <a href="<?= base_url('register'); ?>">Register</a></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>