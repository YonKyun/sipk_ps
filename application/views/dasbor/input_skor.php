<script>
	$(document).ready(function() {
		$('.data').DataTable();
	});
</script>
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
					<th class="w-100">Nama</th>
					<th style="min-width: 111px !important;">Jenis Kelamin</th>
					<th style="min-width: 86px !important;">Kategori</th>
					<th style="min-width: 87px !important;">Kelas</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($kejuaraan as $row) { ?>
					<tr>
						<form action="<?= base_url('dasbor/input_skor_detail/' . $row['id_kejuaraan']); ?>">
							<td><?= $no++; ?></td>
							<td><?= $row['nama_kejuaraan']; ?></td>
							<td>
								<select class="form-control" name="jenis_kelamin" id="jenis_kelamin<?= $row['id_kejuaraan']; ?>" onchange="ganti_kelas<?= $row['id_kejuaraan']; ?>();" required>
									<option>Laki-laki</option>
									<option>Perempuan</option>
								</select>
							</td>
							<td>
								<select class="form-control" name="kategori" id="kategori<?= $row['id_kejuaraan']; ?>" onchange="ganti_kelas<?= $row['id_kejuaraan']; ?>();" required>
									<option>Seni</option>
									<option>Tanding</option>
								</select>
							</td>
							<td>
								<select class="form-control" name="kelas" id="kelas<?= $row['id_kejuaraan']; ?>" required></select>
							</td>
							<td nowrap>
								<input type="submit" class="btn btn-sm btn-info" value="Detail">
							</td>
						</form>
					</tr>
					<script>
						function ganti_kelas<?= $row['id_kejuaraan']; ?>() {
							var jenis_kelamin<?= $row['id_kejuaraan']; ?> = $('#jenis_kelamin<?= $row['id_kejuaraan']; ?>').val();
							var kategori<?= $row['id_kejuaraan']; ?> = $('#kategori<?= $row['id_kejuaraan']; ?>').val();
							if ('Seni' == kategori<?= $row['id_kejuaraan']; ?>) {
								$('#kelas<?= $row['id_kejuaraan']; ?>').html('<option>Tunggal</option><option>Ganda</option><option>Regu</option>');
							} else {
								if ('Perempuan' == jenis_kelamin<?= $row['id_kejuaraan']; ?>) {
									$('#kelas<?= $row['id_kejuaraan']; ?>').html('<option>Bebas</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>Open 1</option><option>Open 2</option>');
								} else {
									$('#kelas<?= $row['id_kejuaraan']; ?>').html('<option>Bebas</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>Open 1</option><option>Open 2</option>');
								}
							}
						}
						$(document).ready(ganti_kelas<?= $row['id_kejuaraan']; ?>());
					</script>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>