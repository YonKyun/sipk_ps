<script>
	$(document).ready(function() {
		$('.data').DataTable();
	});
</script>
<a href="" data-toggle="modal" data-target="#modal_tambah" class="btn btn-sm btn-primary">Tambah Data</a><br /><br />
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
					<th>Kejuaraan</th>
					<th class="w-100">Nama</th>
					<th>Username</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($panitia as $row) { ?>
					<tr>
						<td><?= $no++; ?></td>
						<td nowrap><?= $row['nama_kejuaraan']; ?></td>
						<td><?= $row['nama_user']; ?></td>
						<td><?= $row['username']; ?></td>
						<td nowrap>
							<a href="" data-toggle="modal" data-target="#modal_edit<?= $row['id_user']; ?>" class="btn btn-sm btn-primary">Edit</a>
							<a href="" data-toggle="modal" data-target="#modal_hapus<?= $row['id_user']; ?>" class="btn btn-sm btn-danger">Hapus</a>
						</td>
					</tr>
					<div class="modal fade" id="modal_edit<?= $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<form action="<?= base_url('dasbor/edit_panitia/' . $row['id_user']); ?>" method="post">
									<div class="modal-body">
										<b>Kejuaraan</b> *
										<select class="form-control" name="id_kejuaraan" required>
											<option value="">-- Pilih Kejuaraan --</option>
											<?php foreach ($kejuaraan as $k) { ?>
												<option value="<?= $k['id_kejuaraan']; ?>" <?= ($row['id_kejuaraan'] == $k['id_kejuaraan']) ? 'selected' : ''; ?>><?= $k['nama_kejuaraan']; ?></option>
											<?php } ?>
										</select>
										<br />
										<b>Nama</b> *
										<input type="text" class="form-control" placeholder="Nama" name="nama_user" value="<?= $row['nama_user']; ?>" required>
										<br />
										<b>Username</b> *
										<input type="text" class="form-control" placeholder="Username" name="username" value="<?= $row['username']; ?>" required>
										<br />
										<b>Kata Sandi</b> (kosongi jika tidak ingin mengganti)
										<input type="password" class="form-control" placeholder="Kata Sandi" name="password" autoComplete="new-password">
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-primary">Perbarui</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="modal_hapus<?= $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
									<a href="<?= base_url('dasbor/hapus_panitia/' . $row['id_user']); ?>" class="btn btn-danger">Hapus</a>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="<?= base_url('dasbor/tambah_panitia'); ?>" method="post">
				<div class="modal-body">
					<b>Kejuaraan</b> *
					<select class="form-control" name="id_kejuaraan" required>
						<option value="">-- Pilih Kejuaraan --</option>
						<?php foreach ($kejuaraan as $k) { ?>
							<option value="<?= $k['id_kejuaraan']; ?>"><?= $k['nama_kejuaraan']; ?></option>
						<?php } ?>
					</select>
					<br />
					<b>Nama</b> *
					<input type="text" class="form-control" placeholder="Nama" name="nama_user" required>
					<br />
					<b>Username</b> *
					<input type="text" class="form-control" placeholder="Username" name="username" required>
					<br />
					<b>Kata Sandi</b> *
					<input type="password" class="form-control" placeholder="Kata Sandi" name="password" autoComplete="new-password" required>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>