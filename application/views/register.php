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
					<form action="<?= base_url('register/register'); ?>" method="post" class="php-email-form">
						<?php if ($this->session->flashdata('danger')) { ?>
							<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
								<strong>Aksi Gagal!</strong><br /><?= $this->session->flashdata('danger'); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
						<?php if ($this->session->flashdata('success')) { ?>
							<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
								<strong>Aksi Berhasil!</strong><br /><?= $this->session->flashdata('success'); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
						<select name="role" class="form-control" onchange="ganti_role(this.value)" required>
							<option value="">-- Pilih Role --</option>
							<option value="3">Panitia</option>
							<option value="5">Peserta</option>
						</select>
						<select id="id_kejuaraan" name="id_kejuaraan" class="form-control mt-3">
							<option value="">-- Pilih Kejuaraan --</option>
							<?php foreach ($this->db->get_where('kejuaraan', ['active' => 1])->result_array() as $k) { ?>
								<option value="<?= $k['id_kejuaraan']; ?>"><?= $k['nama_kejuaraan']; ?></option>
							<?php } ?>
						</select>
						<input type="text" name="nama_user" class="form-control mt-3" placeholder="Nama" required>
						<input type="text" name="username" class="form-control mt-3" placeholder="Username" required>
						<input type="password" class="form-control mt-3" name="password" placeholder="Password" required>
						<div class="text-center">
							<button class="my-3" type="submit">Register</button>
							<br />
							<span>Sudah punya Akun? <a href="<?= base_url('login'); ?>">Login</a></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>

<script>
	ganti_role('');

	function ganti_role(role) {
		if (role == 3) {
			$('#id_kejuaraan').show().prop('required', true);
		} else {
			$('#id_kejuaraan').hide().prop('required', false);
		}
	}
</script>