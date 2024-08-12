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

<div class="card card-body shadow-sm mt-4">
	<div class="table-responsive">
		<table class="data table">
			<thead>
				<tr>
					<th>No.</th>
					<th class="w-100">Nama Panitia</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($user as $row) {
					$sudah = (file_exists('assets/uploads/images/bukti_panitia/' . $row['id_user'] . '.png')) ? true : false; ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $row['nama_user']; ?></td>
						<td nowrap>
							<button data-toggle="modal" data-target="#modal_terima<?= $row['id_user']; ?>" class="btn btn-sm btn-success" <?= (!$sudah) ? 'disabled' : ''; ?>>Terima</button>
							<button data-toggle="modal" data-target="#modal_detail<?= $row['id_user']; ?>" class="btn btn-sm btn-info" <?= (!$sudah) ? 'disabled' : ''; ?>>Detail</button>
							<button data-toggle="modal" data-target="#modal_hapus<?= $row['id_user']; ?>" class="btn btn-sm btn-danger" <?= (!$sudah) ? 'disabled' : ''; ?>>Hapus</button>
						</td>
					</tr>
					<?php if ($sudah) { ?>
						<div class="modal fade" id="modal_terima<?= $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Terima Bukti Pembayaran</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<b>Apakah Anda yakin ingin menerima bukti ini?<br /></b>
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
										<a href="<?= base_url('dasbor/terima_panitia/' . $row['id_user']); ?>" class="btn btn-success">Terima</a>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="modal_detail<?= $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<img src="<?= base_url('assets/uploads/images/bukti_panitia/' . $row['id_user'] . '.png'); ?>" class="w-100">
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="modal_hapus<?= $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Hapus Bukti Pendaftaran</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<b>Apakah Anda yakin ingin menghapus bukti ini?<br /></b>
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
										<a href="<?= base_url('dasbor/hapus_bukti/' . $row['id_user']); ?>" class="btn btn-danger">Hapus</a>
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