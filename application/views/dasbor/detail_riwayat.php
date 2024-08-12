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

<div class="card card-body shadow-sm mt-4">
	<table style="font-weight: bold; font-size: 16pt;">
		<tr>
			<td>Judul</td>
			<td class="px-2">:</td>
			<td class="w-100"><?= $row['judul']; ?></td>
		</tr>
		<tr>
			<td nowrap>Nama Kejuaraan</td>
			<td class="px-2">:</td>
			<td class="w-100"><?= $row['nama_kejuaraan']; ?></td>
		</tr>
		<tr>
			<td nowrap>Jenis Kelamin</td>
			<td class="px-2">:</td>
			<td class="w-100"><?= $row['jenis_kelamin']; ?></td>
		</tr>
		<tr>
			<td>Kelas</td>
			<td class="px-2">:</td>
			<td class="w-100"><?= $row['kelas']; ?></td>
		</tr>
		<tr>
			<td>Waktu Awal</td>
			<td class="px-2">:</td>
			<td class="w-100"><?= $row['waktu_awal']; ?></td>
		</tr>
		<tr>
			<td>Waktu Akhir</td>
			<td class="px-2">:</td>
			<td class="w-100"><?= $row['waktu_akhir']; ?></td>
		</tr>
	</table>
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
				container.append(data);
				container.append('<span class="score form-control">' + peserta.scores[data] + '</span>');
				return;
			case 'entry-complete':
				if (data == "") {
					container.append('<span class="text-secondary">Mendatang</span>');
				} else {
					container.append(data);
				}
				// container.append('<span class="score form-control">' + score + '</span>');
				return;
		}
	}

	function load_bagan() {
		$('#simpan_jenis_kelamin').val($('#jenis_kelamin').val());
		$('#simpan_kelas').val($('#kelas').val());

		$.ajax({
			url: '<?= base_url('dasbor/load_bagan2'); ?>',
			data: {
				'id_riwayat': '<?= $row['id_riwayat']; ?>'
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

	load_bagan();
</script>