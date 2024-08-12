<script>
	$(document).ready(function() {
		$('.data').DataTable();
	});
</script>
<?php if ($admin) { ?>
	<a href="" data-toggle="modal" data-target="#modal_tambah" class="btn btn-sm btn-primary">Tambah Data</a><br /><br />
<?php } ?>
<?php if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Aksi Berhasil!</strong>
		<br />
		<?= $this->session->flashdata('success'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?php } ?>
<?php if ($this->session->flashdata('danger')) { ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<strong>Aksi Gagal!</strong>
		<br />
		<?= $this->session->flashdata('danger'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?php } ?>
<div class="card card-body shadow-sm">
	<div class="table-responsive">
		<table class="data table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Gambar</th>
					<th class="w-100">Nama</th>
					<th>Waktu</th>
					<th>Warna</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($kejuaraan as $row) {
					$seni1putra = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Seni' AND `kelas` = 'Tunggal' AND `jenis_kelamin` = 'Laki-laki'")->result_array();
					$seni1putri = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Seni' AND `kelas` = 'Tunggal' AND `jenis_kelamin` = 'Perempuan'")->result_array();
					$seni2putra = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Seni' AND `kelas` = 'Ganda' AND `jenis_kelamin` = 'Laki-laki'")->result_array();
					$seni2putri = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Seni' AND `kelas` = 'Ganda' AND `jenis_kelamin` = 'Perempuan'")->result_array();
					$seni3putra = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Seni' AND `kelas` = 'Regu' AND `jenis_kelamin` = 'Laki-laki'")->result_array();
					$seni3putri = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Seni' AND `kelas` = 'Regu' AND `jenis_kelamin` = 'Perempuan'")->result_array();
					$tanding_putra = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Tanding' AND `jenis_kelamin` = 'Laki-laki'")->result_array();
					$tanding_putri = $this->db->query("SELECT * FROM `pendaftaran` WHERE `id_kejuaraan` = $row[id_kejuaraan] AND `kategori` = 'Tanding' AND `jenis_kelamin` = 'Perempuan'")->result_array(); ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><img src="<?= base_url('assets/uploads/images/kejuaraan/' . $row['id_kejuaraan'] . '.png'); ?>" width="128"></td>
						<td><?= $row['nama_kejuaraan']; ?></td>
						<td nowrap><?= date('Y-m-d', $row['waktu_awal']); ?><br>sampai dengan<br><?= date('Y-m-d', $row['waktu_akhir']); ?></td>
						<td style="background-color: <?= $row['warna']; ?>;"></td>
						<td nowrap>
							<?php if ($panitia) { ?>
								<a href="" data-toggle="modal" data-target="#modal_upload<?= $row['id_kejuaraan']; ?>" class="btn btn-sm btn-success">Upload Proposal</a>
								<!-- <a href="" data-toggle="modal" data-target="#modal_juara<?= $row['id_kejuaraan']; ?>" class="btn btn-sm btn-info">Juara</a> -->
							<?php } ?>
							<?php if ($admin) { ?>
								<a href="" data-toggle="modal" data-target="#modal_edit<?= $row['id_kejuaraan']; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="" data-toggle="modal" data-target="#modal_hapus<?= $row['id_kejuaraan']; ?>" class="btn btn-sm btn-danger">Hapus</a>
							<?php } ?>
						</td>
					</tr>
					<?php if ($panitia) { ?>
						<div class="modal fade" id="modal_upload<?= $row['id_kejuaraan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Upload Proposal</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form action="<?= base_url('dasbor/upload_proposal/' . $row['id_kejuaraan']); ?>" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<b>Dokumen Proposal</b> (filetype: pdf, file lama akan tertimpa)
											<input type="file" class="form-control p-1" name="proposal" required>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary">Upload</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" id="modal_juara<?= $row['id_kejuaraan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form action="<?= base_url('dasbor/juara_kejuaraan/' . $row['id_kejuaraan']); ?>" method="post">
										<div class="modal-body">
											<b>Seni Tunggal (Putra)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="seni1_putra1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni1putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni1_putra1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="seni1_putra2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni1putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni1_putra2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="seni1_putra3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni1putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni1_putra3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<b>Seni Tunggal (Putri)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="seni1_putri1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni1putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni1_putri1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="seni1_putri2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni1putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni1_putri2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="seni1_putri3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni1putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni1_putri3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<b>Seni Ganda (Putra)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="seni2_putra1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni2putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni2_putra1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="seni2_putra2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni2putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni2_putra2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="seni2_putra3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni2putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni2_putra3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<b>Seni Ganda (Putri)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="seni2_putri1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni2putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni2_putri1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="seni2_putri2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni2putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni2_putri2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="seni2_putri3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni2putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni2_putri3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<b>Seni Regu (Putra)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="seni3_putra1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni3putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni3_putra1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="seni3_putra2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni3putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni3_putra2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="seni3_putra3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni3putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni3_putra3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<b>Seni Regu (Putri)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="seni3_putri1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni3putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni3_putri1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="seni3_putri2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni3putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni3_putri2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="seni3_putri3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($seni3putri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['seni3_putri3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<b>Tanding (Putra)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="tanding_putra1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($tanding_putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['tanding_putra1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="tanding_putra2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($tanding_putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['tanding_putra2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="tanding_putra3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($tanding_putra as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['tanding_putra3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<b>Tanding (Putri)</b>
											<div class="row mb-3">
												<div class="col-4">
													<small class="font-weight-bold">Juara 1</small>
													<select class="form-control" name="tanding_putri1">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($tandingputri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['tanding_putri1'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 2</small>
													<select class="form-control" name="tanding_putri2">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($tandingputri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['tanding_putri2'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<small class="font-weight-bold">Juara 3</small>
													<select class="form-control" name="tanding_putri3">
														<option value="">-- Pilih Peserta --</option>
														<?php foreach ($tandingputri as $pendaftaran) { ?>
															<option value="<?= $pendaftaran['id_pendaftaran']; ?>" <?= ($row['tanding_putri3'] == $pendaftaran['id_pendaftaran']) ? 'selected' : ''; ?>><?= $pendaftaran['nama']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary">Perbarui</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
					<?php if ($admin) { ?>
						<div class="modal fade" id="modal_edit<?= $row['id_kejuaraan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form action="<?= base_url('dasbor/edit_kejuaraan/' . $row['id_kejuaraan']); ?>" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<b>Gambar</b> (kosongkan jika tidak ingin mengganti)
											<input type="file" class="form-control p-1" name="gambar">
											<br />
											<b>Nama Kejuaraan</b> *
											<input type="text" class="form-control" placeholder="Nama Kejuaraan" name="nama_kejuaraan" value="<?= $row['nama_kejuaraan']; ?>" required>
											<br />
											<b>Warna</b> *
											<input type="color" class="form-control" name="warna" value="<?= $row['warna']; ?>" required>
											<br />
											<b>Waktu Awal</b> *
											<input type="date" class="form-control" name="waktu_awal" value="<?= date('Y-m-d', $row['waktu_awal']); ?>" required>
											<br />
											<b>Waktu Akhir</b> *
											<input type="date" class="form-control" name="waktu_akhir" value="<?= date('Y-m-d', $row['waktu_akhir']); ?>" required>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary">Perbarui</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" id="modal_hapus<?= $row['id_kejuaraan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<b>Apakah Anda yakin ingin menghapus data ini?<br /></b>
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
										<a href="<?= base_url('dasbor/hapus_kejuaraan/' . $row['id_kejuaraan']); ?>" class="btn btn-danger">Hapus</a>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php if ($admin) { ?>
	<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= base_url('dasbor/tambah_kejuaraan'); ?>" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<b>Gambar</b> *
						<input type="file" class="form-control p-1" name="gambar" required>
						<br />
						<b>Nama Kejuaraan</b> *
						<input type="text" class="form-control" placeholder="Nama Kejuaraan" name="nama_kejuaraan" required>
						<br />
						<b>Warna</b> *
						<input type="color" class="form-control" name="warna" required>
						<br />
						<b>Waktu Awal</b> *
						<input type="date" class="form-control" name="waktu_awal" required>
						<br />
						<b>Waktu Akhir</b> *
						<input type="date" class="form-control" name="waktu_akhir" required>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>