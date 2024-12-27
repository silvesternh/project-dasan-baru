<?= $this->extend('layout/tampil'); ?>
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
                  <div class="card-title">Form Update Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url(); ?>/tanah/update/<?= $tanah['id_tanah']; ?>" method="post"
                  enctype="multipart/form-data">
                  <?= csrf_field(); ?>

                  <!-- Satker Dropdown -->
                  <div class="form-group row">
                    <label for="id_satker" class="col-sm-2 col-form-label">Satker</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_satker" id="exampleFormControlSelect1">
                        <option value="">Pilih Satker/Satwil.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $satker = $db->query("SELECT * FROM satker")->getResult();
                        foreach ($satker as $s): ?>
                          <option value="<?= $s->id_satker ?>" <?= $tanah['id_satker'] == $s->id_satker ? 'selected' : '' ?>>
                            <?= $s->nama_satker ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="luas" class="col-sm-2 col-form-label">luas</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="luas" name="luas" value="<?= $tanah['luas']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="bidang" class="col-sm-2 col-form-label">bidang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="bidang" name="bidang"
                        value="<?= $tanah['bidang']; ?>">
                    </div>
                  </div>

                  <!-- status -->
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">status</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="status" id="exampleFormControlSelect1">
                        <option value="">Pilih status.....</option>
                        <option value="sudah bersertifikasi" <?= $tanah['status'] == 'sudah bersertifikasi' ? 'selected' : '' ?>>sudah bersertifikasi</option>
                        <option value="belum bersertifikasi" <?= $tanah['status'] == 'belum bersertifikasi' ? 'selected' : '' ?>>sudah bersertifikasi</option>
                        <option value="pinjam pakai" <?= $tanah['status'] == 'pinjam pakai' ? 'selected' : '' ?>>pinjam pakai</option>
                      </select>
                    </div>
                  </div>
                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>tanah/index" class="btn btn-danger">Cancel</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>