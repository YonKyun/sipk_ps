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
	<section id="blog" class="blog">
		<div class="container" data-aos="fade-up">
			<div class="row">
				<div class="col-12 entries">
					<article class="entry entry-single">
						<div class="entry-img">
							<img src="<?= base_url('assets/uploads/images/kejuaraan/' . $row['id_kejuaraan'] . '.png?t=' . time()); ?>" alt="" class="img-fluid">
						</div>
						<?php if ($this->session->flashdata('success')) { ?>
							<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
								<strong>Aksi Gagal!</strong><br /><?= $this->session->flashdata('success'); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
						<h2 class="entry-title">
							<a href=""><?= $judul; ?></a>
						</h2>
						<?php if ($login) {
							if ($sudah) {
								$pesan = 'Anda sudah mendaftar Kejuaraan ini, tidak bisa mendaftar 2&times;.';
							}
							if (!$peserta) {
								$pesan = 'Silakan Login sebagai Peserta jika ingin mendaftar Kejuaraan ini.';
							}
						} else {
							$pesan = 'Silakan Login terlebih dahulu jika ingin mendaftar Kejuaraan ini.';
						} ?>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_daftar">Daftar</button>
						<div class="modal fade" id="modal_daftar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_daftarLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5" id="modal_daftarLabel">Daftar Kejuaraan</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<?php if (isset($pesan)) { ?>
										<div class="modal-body">
											<h5 class="text-danger mb-0"><?= $pesan; ?></h5>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
										</div>
									<?php } else { ?>
										<form action="<?= base_url('kejuaraan/kejuaraan_daftar/' . $row['id_kejuaraan']); ?>" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<label for="kategori" class="small">Kategori</label>
												<select class="form-select" name="kategori" id="kategori" required>
													<option>Seni</option>
													<option>Tanding</option>
												</select>
												<label for="nama" class="small mt-2">Nama</label>
												<input type="text" class="form-control" name="nama" id="nama" placeholder="Ketik semua anggota peserta di sini" required>
												<label for="jenis_kelamin" class="small mt-2">Jenis Kelamin</label>
												<select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
													<option <?= ('Laki-laki' == $user['jenis_kelamin']) ? 'selected' : ''; ?>>Laki-laki</option>
													<option <?= ('Perempuan' == $user['jenis_kelamin']) ? 'selected' : ''; ?>>Perempuan</option>
												</select>
												<div id="div_berat_badan" style="display: none;">
													<label for="berat_badan" class="small mt-2">Berat Badan</label>
													<input type="number" class="form-control" name="berat_badan" id="berat_badan" placeholder="Berat Badan" value="<?= $user['berat_badan']; ?>">
												</div>
												<div id="div_kelas">
													<label for="kelas" class="small mt-2">Kelas</label>
													<select class="form-select" name="kelas" id="kelas" required>
														<option>Tunggal</option>
														<option>Ganda</option>
														<option>Regu</option>
													</select>
												</div>
												<label for="bukti" class="small mt-2">Bukti Pembayaran</label>
												<input type="file" class="form-control" name="bukti" id="bukti" required>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
												<button type="submit" class="btn btn-primary">Daftar</button>
											</div>
										</form>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="entry-content mt-5">
							<h5>Hasil Pertandingan (Seni Tunggal)</h5>
							<div class="row">
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putra</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $seni1['putra1']; ?></td>
												<td><?= $seni1['putra2']; ?></td>
												<td><?= $seni1['putra3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putri</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $seni1['putri1']; ?></td>
												<td><?= $seni1['putri2']; ?></td>
												<td><?= $seni1['putri3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="entry-content mt-5">
							<h5>Hasil Pertandingan (Seni Ganda)</h5>
							<div class="row">
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putra</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $seni2['putra1']; ?></td>
												<td><?= $seni2['putra2']; ?></td>
												<td><?= $seni2['putra3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putri</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $seni2['putri1']; ?></td>
												<td><?= $seni2['putri2']; ?></td>
												<td><?= $seni2['putri3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="entry-content mt-5">
							<h5>Hasil Pertandingan (Seni Regu)</h5>
							<div class="row">
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putra</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $seni3['putra1']; ?></td>
												<td><?= $seni3['putra2']; ?></td>
												<td><?= $seni3['putra3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putri</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $seni3['putri1']; ?></td>
												<td><?= $seni3['putri2']; ?></td>
												<td><?= $seni3['putri3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="entry-content mt-5">
							<h5>Hasil Pertandingan (Tanding)</h5>
							<div class="row">
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putra</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $tanding['putra1']; ?></td>
												<td><?= $tanding['putra2']; ?></td>
												<td><?= $tanding['putra3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-6">
									<table class=" table table-bordered text-center mb-0">
										<thead>
											<tr>
												<th colspan="3" class="fs-5">Putri</th>
											</tr>
											<tr>
												<th>Juara 1</th>
												<th>Juara 2</th>
												<th>Juara 3</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $tanding['putri1']; ?></td>
												<td><?= $tanding['putri2']; ?></td>
												<td><?= $tanding['putri3']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>
</main>

<script>
	$('#kategori').on('change', function() {
		if ('Seni' == this.value) {
			$('#div_berat_badan').hide();
			$('#div_kelas').show();
			$('#nama').val('');
			$('#nama').prop('placeholder', 'Ketik semua anggota peserta di sini');
			$('#kelas').prop('required', true);
			$('#berat_badan').prop('required', false);
		} else {
			$('#div_berat_badan').show();
			$('#div_kelas').hide();
			$('#nama').val('<?= $user['nama_user']; ?>');
			$('#nama').prop('placeholder', 'Nama Peserta');
			$('#kelas').prop('required', false);
			$('#berat_badan').prop('required', true);
		}
	});
</script>