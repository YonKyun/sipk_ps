<script type="text/javascript" src="<?= base_url('assets/dasbor/vendor/jquery/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/dasbor/vendor/jquery-bracket/jquery.bracket.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/dasbor/vendor/jquery-bracket/jquery.bracket.min.css'); ?>" />

<style>
	@media print {
		body {
			visibility: hidden;
		}

		.teamContainer {
			border: 2px gray solid;
		}

		#cetak {
			width: 100%;
			visibility: visible;
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>

<?php if ($admin or $juri) { ?>
	<div class="card card-body shadow-sm">
		<div class="row">
			<div class="col-12 col-md-4">
				<small>Kejuaraan</small>
				<select class="form-control" id="id_kejuaraan" onchange="load_bagan();">
					<?php foreach ($kejuaraan as $row) { ?>
						<option value="<?= $row['id_kejuaraan']; ?>"><?= $row['nama_kejuaraan']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-12 col-md-3">
				<small>Jenis Kelamin</small>
				<select class="form-control" id="jenis_kelamin" onchange="ganti_kelas();">
					<option>Laki-laki</option>
					<option>Perempuan</option>
				</select>
			</div>
			<div class="col-12 col-md-3">
				<small>Kelas</small>
				<select class="form-control" id="kelas" onchange="load_bagan();"></select>
			</div>
			<div class="col-12 col-md-2">
				<small class="text-light">Action</small>
				<button type="button" class="btn btn-block btn-primary" onclick="window.print();">Cetak</button>
			</div>
		</div>
	</div>
<?php } ?>

<?php if ($panitia_sudah) { ?>
	<div class="card card-body shadow-sm">
		<div class="row">
			<div class="col-12 col-md-4">
				<small>Jenis Kelamin</small>
				<select class="form-control" id="jenis_kelamin" onchange="ganti_kelas();">
					<option>Laki-laki</option>
					<option>Perempuan</option>
				</select>
			</div>
			<div class="col-12 col-md-4">
				<small>Kelas</small>
				<select class="form-control" id="kelas" onchange="load_bagan();"></select>
			</div>
			<div class="col-12 col-md-4">
				<small class="text-light">Action</small>
				<div class="btn-group w-100" role="group">
					<button type="button" class="btn btn-primary" onclick="btn_generate();">Generate</button>
					<button type="button" class="btn btn-primary" onclick="window.print();">Cetak</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="card card-body shadow-sm mt-4" style="overflow-x: scroll;" id="cetak">
	<h4 class="text-center text-dark">Bagan Pertandingan</h4>
	<div id="pertandingan">
		<div class="demo">
		</div>
	</div>
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
		load_bagan();
	}

	function load_bagan() {
		$.ajax({
			url: '<?= base_url('dasbor/load_bagan'); ?>',
			data: {
				<?php if ($admin or $juri) { ?> 'id_kejuaraan': $('#id_kejuaraan').val(),
				<?php } ?> 'jenis_kelamin': $('#jenis_kelamin').val(),
				'kelas': $('#kelas').val()
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);

				$(function() {
					$('#pertandingan .demo').bracket({
						skipConsolationRound: true,
						init: data
					});
				});

			},
			error: function(error) {
				console.log(error);
			}
		});
	}

	<?php if ($panitia_sudah) { ?>

		function btn_generate() {
			$.ajax({
				url: '<?= base_url('dasbor/bagan_generate'); ?>',
				data: {
					'jenis_kelamin': $('#jenis_kelamin').val(),
					'kelas': $('#kelas').val()
				},
				success: function(result) {
					load_bagan();
				},
				error: function(error) {
					console.log(error);
				}
			});
		}
	<?php } ?>

	$(document).ready(ganti_kelas());
</script>