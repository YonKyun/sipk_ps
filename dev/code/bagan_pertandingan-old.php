<script type="text/javascript" src="<?= base_url('assets/dasbor/vendor/jquery/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/dasbor/vendor/jquery-bracket/jquery.bracket.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/dasbor/vendor/jquery-bracket/jquery.bracket.min.css'); ?>" />

<style>
	.label {
		color: black;
		width: 100px;
	}

	.score {
		width: 0;
	}

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

<div class="card card-body shadow-sm">
	<div class="row">
		<div class="col-12 col-md-4">
			<small>Kejuaraan</small>
			<select class="form-control" id="id_kejuaraan" onchange="generate_bagan();">
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
			<select class="form-control" id="kelas" onchange="generate_bagan();"></select>
		</div>
		<div class="col-12 col-md-2">
			<small class="text-light">Cetak</small>
			<button type="button" class="btn btn-block btn-primary" onclick="window.print();">Cetak</button>
		</div>
	</div>
</div>

<div class="card card-body shadow-sm mt-4" style="overflow-x: scroll;" id="cetak">
	<h4 class="text-center text-dark">Bagan Pertandingan</h4>
	<div id="pertandingan">
		<div class="demo">
		</div>
	</div>
</div>

<script>
	function edit_fn(container, data, doneCb) {}

	function render_fn(container, data, score, state) {
		switch (state) {
			case 'empty-tbd':
				container.append('<span class="text-light">Mendatang</span>');
				return;
			case 'entry-no-score':
			case 'entry-complete':
				container.append(data);
				return;
		}
	}

	function generate_bagan() {
		$.ajax({
			url: '<?= base_url('dasbor/bagan_generate'); ?>',
			data: {
				'id_kejuaraan': $('#id_kejuaraan').val(),
				'jenis_kelamin': $('#jenis_kelamin').val(),
				'kelas': $('#kelas').val()
			},
			dataType: 'json',
			success: function(result) {
				var result_array = [];

				for (var i in result) {
					result_array.push([i, result[i]]);
				}

				var peserta = {
					teams: result_array[1][1]
				}

				$(function() {
					$('#pertandingan .demo').bracket({
						centerConnectors: true,
						disableHighlight: true,
						init: peserta,
						decorator: {
							edit: edit_fn,
							render: render_fn
						}
					});
					$('.label').css('width', '100px');
					$('.score').css('width', 0);
					$('.score').html('&nbsp;')
					var jumlah_baris = result_array[0][1];
					if (jumlah_baris > 3) {
						$('.round:last-child>.match:last-child').hide();
						// } else if (jumlah_baris > 1) {
						// $('.round:last-child').hide();
						// $('.round>.match:last-child').hide();
						// $('.round>.match>.teamContainer>.connector').hide();
					}
				});
			}
		});
	}

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
		generate_bagan();
	}

	$(document).ready(ganti_kelas());
</script>