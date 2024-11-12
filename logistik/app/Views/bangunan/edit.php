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
                <form action="<?= base_url(); ?>/bangunan/update/<?= $bangunan['id_bangunan']; ?>" method="post"
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
                          <option value="<?= $s->id_satker ?>" <?= $bangunan['id_satker'] == $s->id_satker ? 'selected' : '' ?>><?= $s->nama_satker ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="gedung" class="col-sm-2 col-form-label">gedung</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gedung" name="gedung"
                        value="<?= $bangunan['gedung']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="unit" class="col-sm-2 col-form-label">unit</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="unit" name="unit" value="<?= $bangunan['unit']; ?>">
                    </div>
                  </div>

                  <!-- Merk -->
                  <div class="form-group row">
                    <label for="penghuni" class="col-sm-2 col-form-label">penghuni</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="penghuni" name="penghuni"
                        value="<?= $bangunan['penghuni']; ?>">
                    </div>
                  </div>

                  <!-- Kondisi -->
                  <div class="form-group row">
                    <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="kondisi" id="exampleFormControlSelect1">
                        <option value="">Pilih salah satu.....</option>
                        <option value="Baik" <?= $bangunan['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                        <option value="Rusak Ringan" <?= $bangunan['kondisi'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak
                          Ringan</option>
                        <option value="Rusak Berat" <?= $bangunan['kondisi'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak
                          Berat</option>
                      </select>
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="ket" class="col-sm-2 col-form-label">ket</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ket" name="ket" value="<?= $bangunan['ket']; ?>">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>bangunan/index" class="btn btn-danger">Cancel</a>
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