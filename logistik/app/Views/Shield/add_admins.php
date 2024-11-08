<?= $this->extend('layout/index'); ?>
<?= $this->section('isi'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="container">
        <div class="page-inner">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Form Tambah Admins</div>
                </div>
                <?= session()->getFlashdata('error') ?>
                <?= validation_list_errors() ?>
                <form action="<?= base_url('/admins/') ?>" method="post">
                  <?= csrf_field(); ?>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="pangkat">Pangkat</label>
                    <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= old('pangkat'); ?>"
                      required>
                  </div>
                  <div class="form-group">
                    <label for="nrp">Nrp</label>
                    <input type="text" class="form-control" id="nrp" name="nrp" value="<?= old('nrp'); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= old('jabatan'); ?>"
                      required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('jabatan'); ?>"
                      required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <div class="form-group">
                    <label for="password_confirm">Ulangi Password</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection(); ?>