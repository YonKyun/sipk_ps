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
<div class="card card-body shadow-sm font-weight-bold" style="font-size: 16pt;">
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
<?php if (null !== $bagan) { ?>
	<div class="card card-body shadow-sm mt-4">
		<div class="table-responsive">
			<table class="data table">
				<thead>
					<tr>
						<th>No.</th>
						<th>Babak</th>
						<th nowrap>Nama Peserta</th>
						<th>Skor</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($bagan as $row) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= format_angka($row['babak']); ?></td>
							<td><?= $row['nama']; ?></td>
							<td><?= format_angka($row['skor']); ?></td>
							<td>
								<a href="" data-toggle="modal" data-target="#modal_input<?= $row['id_bagan']; ?>" class="btn btn-sm btn-info">Input Skor</a>
							</td>
						</tr>
						<div class="modal fade" id="modal_input<?= $row['id_bagan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Input Skor</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form action="<?= base_url('dasbor/input_skor_aksi/' . $row['id_bagan']); ?>" method="post">
										<input type="hidden" name="id_kejuaraan" value="<?= $row['id_kejuaraan']; ?>">
										<input type="hidden" name="jenis_kelamin" value="<?= $jenis_kelamin; ?>">
										<input type="hidden" name="kategori" value="<?= $kategori; ?>">
										<input type="hidden" name="kelas" value="<?= $kelas; ?>">
										<div class="modal-body">
											<b>Skor</b> *
											<input type="number" class="form-control" placeholder="Skor" name="skor" value="<?= $row['skor']; ?>" required>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php } ?>
<?php if (null !== $seni) { ?>
	<div class="card card-body shadow-sm mt-4">
		<div class="table-responsive">
			<table class="data table">
				<thead>
					<tr>
						<th>No.</th>
						<th nowrap>Nama Peserta</th>
						<th>Skor</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($seni as $row) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $row['nama']; ?></td>
							<td><?= format_angka($row['skor_seni']); ?></td>
							<td>
								<a href="" data-toggle="modal" data-target="#modal_input<?= $row['id_pendaftaran']; ?>" class="btn btn-sm btn-info">Input Skor</a>
							</td>
						</tr>
						<div class="modal fade" id="modal_input<?= $row['id_pendaftaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Input Skor</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form action="<?= base_url('dasbor/input_skor_aksi/' . $row['id_pendaftaran']); ?>" method="post">
										<input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran']; ?>">
										<input type="hidden" name="id_kejuaraan" value="<?= $row['id_kejuaraan']; ?>">
										<input type="hidden" name="jenis_kelamin" value="<?= $jenis_kelamin; ?>">
										<input type="hidden" name="kategori" value="<?= $kategori; ?>">
										<input type="hidden" name="kelas" value="<?= $kelas; ?>">
										<div class="modal-body">
											<b>Skor</b> *
											<input type="number" class="form-control" placeholder="Skor" name="skor_seni" value="<?= $row['skor_seni']; ?>" required>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php } ?>