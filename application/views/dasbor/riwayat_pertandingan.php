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
	<div class="table-responsive">
		<table class="data table">
			<thead>
				<tr>
					<th>No.</th>
					<th class="w-100">Judul</th>
					<th>Waktu</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($riwayat as $row) { ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $row['judul']; ?></td>
						<td nowrap><?= $row['waktu_awal']; ?><br>sampai dengan<br><?= $row['waktu_akhir']; ?></td>
						<td nowrap>
							<a href="<?= base_url('dasbor/detail_riwayat/' . $row['id_riwayat']); ?>" class="btn btn-sm btn-info">Detail</a>
							<?php if ($admin) { ?>
								<a href="" data-toggle="modal" data-target="#modal_edit<?= $row['id_riwayat']; ?>" class="btn btn-sm btn-primary">Edit</a>
							<?php } ?>
							<a href="" data-toggle="modal" data-target="#modal_hapus<?= $row['id_riwayat']; ?>" class="btn btn-sm btn-danger">Hapus</a>
						</td>
					</tr>
					<div class="modal fade" id="modal_edit<?= $row['id_riwayat']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<form action="<?= base_url('dasbor/edit_riwayat/' . $row['id_riwayat']); ?>" method="post">
									<div class="modal-body">
										<b>Judul</b> *
										<input type="text" class="form-control" placeholder="Judul" name="judul" value="<?= $row['judul']; ?>" required>
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-primary">Perbarui</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php if ($admin) { ?>
						<div class="modal fade" id="modal_hapus<?= $row['id_riwayat']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
										<a href="<?= base_url('dasbor/hapus_riwayat/' . $row['id_riwayat']); ?>" class="btn btn-danger">Hapus</a>
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