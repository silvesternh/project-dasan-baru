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
                <form action="<?= base_url(); ?>/bangunan/store" method="post">
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
                    <label for="gedung" class="col-sm-2 col-form-label">gedung</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gedung" name="gedung" value="<?= old('gedung'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="unit" class="col-sm-2 col-form-label"> unit</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="unit" name="unit" value="<?= old('unit'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="penghuni" class="col-sm-2 col-form-label">penghuni</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="penghuni" name="penghuni"
                        value="<?= old('penghuni'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kondisi" class="col-sm-2 col-form-label">kondisi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="kondisi">
                        <option value="">Pilih Kondisi.....</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ket" class="col-sm-2 col-form-label">ket</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ket" name="ket" value="<?= old('ket'); ?>">
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="<?= base_url(); ?>bangunan/index" class="btn btn-danger">Cancel</a>
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