<?php
echo $this->extend('layout/index');
echo $this->section('isi');
helper('form');
?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="container">
        <div class="page-inner">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Form Tambah Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url('/anggota/store') ?>" method="post">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="<?= old('pangkat'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">Nrp</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= old('nrp'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <?php
                      $options = [
                        'sipil' => 'Sipil',
                        'admin' => 'Admin',
                        'karolog' => 'Karolog',
                        'pal' => 'Ropal',
                        'renmin' => 'Bagrenmin',
                        'faskon' => 'Rofaskon',
                        'ada' => 'Roada',
                        'bekum' => 'Robekum',
                        'gudang' => 'Gudang',
                      ];
                      echo form_dropdown(
                        'jabatan',
                        $options,
                        old('nrp'),
                        'id="jabatan" class="form-control"'
                      );
                      ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="foto" name="foto" value="<?= old('foto'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" name="username"
                        value="<?= old('username'); ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>"
                        required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password_confirm" class="col-sm-2 col-form-label">Ulangi Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                        required>
                    </div>
                  </div>
              </div>
              <div class="card-action">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="<?= base_url(); ?>anggota/index" class="btn btn-danger">Cancel</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>