<div class="card card-body shadow-sm">
  <?php if ($this->session->flashdata('danger')) { ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <strong>Aksi Gagal!</strong>
      <br />
      <?= $this->session->flashdata('danger'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  <?php } ?>
  <?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <strong>Aksi Berhasil!</strong>
      <br />
      <?= $this->session->flashdata('success'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  <?php } ?>
  <form action="<?= base_url('dasbor/edit_profil_aksi'); ?>" method="post">
    <div class="row">
      <div class="col-12 mb-4">
        <b>Nama</b>
        <input type="text" class="form-control" name="nama_user" placeholder="Nama" value="<?= $user['nama_user']; ?>" required>
      </div>
      <div class="col-12 mb-4">
        <b>Username</b>
        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $user['username']; ?>" required>
      </div>
      <div class="col-12 mb-4" id="lupa_password">
        <b>Password</b> (kosongi jika tidak ingin mengganti)
        <input type="password" class="form-control" name="password" placeholder="Password (kosongi jika tidak ingin mengganti)" autocomplete="new-password">
      </div>
      <div class="col-12">
        <input type="submit" class="btn btn-block btn-primary" value="Perbarui">
      </div>
    </div>
  </form>
</div>