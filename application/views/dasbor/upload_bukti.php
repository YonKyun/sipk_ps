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
	<form action="<?= base_url('dasbor/upload_bukti_aksi'); ?>" method="post" enctype="multipart/form-data">
		<b>Bukti Pembayaran</b> *
		<input type="file" class="form-control p-1" name="bukti_panitia" required>
		<br />
		<button type="submit" class="btn btn-primary">Upload</button>
	</form>
</div>
<?php if (file_exists('assets/uploads/images/bukti_panitia/' . $this->session->userdata('id_user') . '.png')) { ?>
	<div class="card card-body shadow-sm mt-4">
		<h4>Bukti Pembayaran Anda</h4>
		<img src="<?= base_url('assets/uploads/images/bukti_panitia/' . $this->session->userdata('id_user') . '.png?t=' . time()); ?>" class="w-100">
	</div>
<?php } ?>