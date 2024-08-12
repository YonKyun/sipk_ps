<script>
	$(document).ready(function() {
		$('.data').DataTable();
	});
</script>

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
	<form>
		<div class="input-group">
			<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" onchange="ganti_kelas();" required>
				<option>Laki-laki</option>
				<option>Perempuan</option>
			</select>
			<select class="form-control" name="kategori" id="kategori" onchange="ganti_kelas();" required>
				<option>Seni</option>
				<option>Tanding</option>
			</select>
			<select class="form-control" name="kelas" id="kelas" required></select>
			<div class="input-group-append">
				<input type="submit" class="btn btn-sm btn-info" value="Detail">
			</div>
		</div>
	</form>
</div>

<script>
	function ganti_kelas() {
		var jenis_kelamin = $('#jenis_kelamin').val();
		var kategori = $('#kategori').val();
		if ('Seni' == kategori) {
			$('#kelas').html('<option>Tunggal</option><option>Ganda</option><option>Regu</option>');
		} else {
			if ('Perempuan' == jenis_kelamin) {
				$('#kelas').html('<option>Bebas</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>Open 1</option><option>Open 2</option>');
			} else {
				$('#kelas').html('<option>Bebas</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>Open 1</option><option>Open 2</option>');
			}
		}
	}

	$(document).ready(function() {
		const jenisKelaminValue = getParameterByName('jenis_kelamin');
		const kategoriValue = getParameterByName('kategori');
		const kelasValue = getParameterByName('kelas');

		if (jenisKelaminValue) {
			$('#jenis_kelamin').val(jenisKelaminValue);
		}

		if (kategoriValue) {
			$('#kategori').val(kategoriValue);
		}

		function getParameterByName(name, url = window.location.href) {
			name = name.replace(/[\[\]]/g, '\\$&');
			const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
				results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, ' '));
		}

		ganti_kelas();

		if (kelasValue) {
			$('#kelas').val(kelasValue);
		}
	});
</script>

<?php if ($tampil) { ?>

	<div class="card card-body shadow-sm font-weight-bold mt-4" style="font-size: 16pt;">
		<table>
			<tr>
				<td>Kejuaraan</td>
				<td class="px-2">:</td>
				<td class="w-100"><?= $kejuaraan; ?></td>
			</tr>
			<tr>
				<td nowrap>Jenis Kelamin</td>
				<td class="px-2">:</td>
				<td class="w-100"><?= $jenis_kelamin; ?></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td class="px-2">:</td>
				<td class="w-100"><?= $kategori; ?></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td class="px-2">:</td>
				<td class="w-100"><?= $kelas; ?></td>
			</tr>
		</table>
	</div>

	<div class="card card-body shadow-sm mt-4">
		<div class="table-responsive">
			<table class="data table">
				<thead>
					<tr>
						<th>No.</th>
						<th nowrap>Nama Peserta</th>
						<th nowrap>Berat Badan</th>
						<th nowrap>Waktu Pendaftaran</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($pendaftaran as $row) {
						$sudah = (1 == $row['approve']) ? true : false; ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $row['nama']; ?></td>
							<td><?= $row['berat_badan']; ?></td>
							<td><?= date('Y-m-d H.i.s', $row['waktu']); ?></td>
							<td nowrap>
								<button data-toggle="modal" data-target="#modal_terima<?= $row['id_pendaftaran']; ?>" class="btn btn-sm btn-success" <?= ($sudah) ? 'disabled' : ''; ?>>Terima</button>
								<button data-toggle="modal" data-target="#modal_detail<?= $row['id_pendaftaran']; ?>" class="btn btn-sm btn-info">Detail</button>
								<button data-toggle="modal" data-target="#modal_hapus<?= $row['id_pendaftaran']; ?>" class="btn btn-sm btn-danger">Hapus</button>
							</td>
						</tr>
						<?php if (!$sudah) { ?>
							<div class="modal fade" id="modal_terima<?= $row['id_pendaftaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Terima Pendaftaran</h5>
											<button class="close" type="button" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
										<div class="modal-body">
											<b>Apakah Anda yakin ingin menerima pendaftaran ini?<br /></b>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
											<a href="<?= base_url('dasbor/terima_pendaftaran/' . $row['id_pendaftaran'] . '?jenis_kelamin=' . $this->input->get('jenis_kelamin') . '&kategori=' . $this->input->get('kategori') . '&kelas=' . $this->input->get('kelas')); ?>" class="btn btn-success">Terima</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>

						<div class="modal fade" id="modal_detail<?= $row['id_pendaftaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Detail Pendaftaran</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="btn-group d-none d-md-flex mb-3" role="group">
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_kk.pdf'); ?>" class="btn btn-danger">Download KK</a>
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_surat.pdf'); ?>" class="btn btn-warning">Download Surat Sehat</a>
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_ktp.pdf'); ?>" class="btn btn-success">Download KTP/KTM</a>
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_formulir.pdf'); ?>" class="btn btn-primary">Download Formulir Kejuaraan</a>
										</div>
										<div class="d-md-none mb-3">
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_kk.pdf'); ?>" class="btn btn-block btn-danger">Download KK</a>
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_surat.pdf'); ?>" class="btn btn-block btn-warning">Download Surat Sehat</a>
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_ktp.pdf'); ?>" class="btn btn-block btn-success">Download KTP/KTM</a>
											<a href="<?= base_url('assets/uploads/documents/pendaftaran/' . $row['id_pendaftaran'] . '_formulir.pdf'); ?>" class="btn btn-block btn-primary">Download Formulir Kejuaraan</a>
										</div>
										<h6>Bukti Pembayaran:</h6>
										<img src="<?= base_url('assets/uploads/images/bukti/' . $row['id_kejuaraan'] . '.png'); ?>" class="img-thumbnail w-100">
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
								</div>
							</div>
						</div>

						<div class="modal fade" id="modal_hapus<?= $row['id_pendaftaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Hapus Pendaftaran</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<b>Apakah Anda yakin ingin menghapus data ini?<br /></b>
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
										<a href="<?= base_url('dasbor/hapus_pendaftaran/' . $row['id_pendaftaran'] . '?jenis_kelamin=' . $this->input->get('jenis_kelamin') . '&kategori=' . $this->input->get('kategori') . '&kelas=' . $this->input->get('kelas')); ?>" class="btn btn-danger">Hapus</a>
									</div>
								</div>
							</div>
						</div>

					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

<?php } ?>