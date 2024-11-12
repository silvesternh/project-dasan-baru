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
                  <div class="card-title">Form Tambah Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url(); ?>/tanah/store" method="post">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="id_satker" class="col-sm-2 col-form-label">Satker</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_satker">
                        <option value="">Pilih Satker/Satwil.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $satker = $db->query("SELECT * FROM satker")->getResult();
                        foreach ($satker as $s): ?>
                          <option value="<?= $s->id_satker ?>"><?= $s->nama_satker ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="luas" class="col-sm-2 col-form-label">luas</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="luas" name="luas" value="<?= old('luas'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bidang" class="col-sm-2 col-form-label"> bidang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="bidang" name="bidang" value="<?= old('bidang'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">status</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="status">
                        <option value="">Pilih status.....</option>
                        <option value="sudah bersertifikasi">sudah bersertifikasi</option>
                        <option value="belum bersertifikasi">belum bersertifikasi</option>
                      </select>
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="<?= base_url(); ?>tanah/index" class="btn btn-danger">Cancel</a>
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