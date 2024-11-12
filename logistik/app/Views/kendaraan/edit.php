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
                <form action="<?= base_url(); ?>/kendaraan/update/<?= $kendaraan['id_kendaraan']; ?>" method="post"
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
                          <option value="<?= $s->id_satker ?>" <?= $kendaraan['id_satker'] == $s->id_satker ? 'selected' : '' ?>><?= $s->nama_satker ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="nopol" class="col-sm-2 col-form-label">Nopol</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nopol" name="nopol"
                        value="<?= $kendaraan['nopol']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jenis" name="jenis"
                        value="<?= $kendaraan['jenis']; ?>">
                    </div>
                  </div>

                  <!-- Merk -->
                  <div class="form-group row">
                    <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="merk" name="merk" value="<?= $kendaraan['merk']; ?>">
                    </div>
                  </div>

                  <!-- Tahun Pembuatan -->
                  <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tahun" name="tahun"
                        value="<?= $kendaraan['tahun']; ?>">
                    </div>
                  </div>

                  <!-- No Mesin -->
                  <div class="form-group row">
                    <label for="mesin" class="col-sm-2 col-form-label">No. Mesin</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mesin" name="mesin"
                        value="<?= $kendaraan['mesin']; ?>">
                    </div>
                  </div>

                  <!-- No Rangka -->
                  <div class="form-group row">
                    <label for="rangka" class="col-sm-2 col-form-label">No. Rangka</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rangka" name="rangka"
                        value="<?= $kendaraan['rangka']; ?>">
                    </div>
                  </div>

                  <!-- Kondisi -->
                  <div class="form-group row">
                    <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="kondisi" id="exampleFormControlSelect1">
                        <option value="">Pilih salah satu.....</option>
                        <option value="Baik" <?= $kendaraan['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                        <option value="Rusak Ringan" <?= $kendaraan['kondisi'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak
                          Ringan</option>
                        <option value="Rusak Berat" <?= $kendaraan['kondisi'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak
                          Berat</option>
                      </select>
                    </div>
                  </div>

                  <!-- Roda -->
                  <div class="form-group row">
                    <label for="roda" class="col-sm-2 col-form-label">Roda</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="roda" id="exampleFormControlSelect1">
                        <option value="">Pilih salah satu.....</option>
                        <option value="R2" <?= $kendaraan['roda'] == 'R2' ? 'selected' : '' ?>>R2</option>
                        <option value="R4" <?= $kendaraan['roda'] == 'R4' ? 'selected' : '' ?>>R4</option>
                        <option value="R6" <?= $kendaraan['roda'] == 'R6' ? 'selected' : '' ?>>R6</option>
                      </select>
                    </div>
                  </div>


                  <!-- Pemegang -->
                  <div class="form-group row">
                    <label for="pemegang" class="col-sm-2 col-form-label">Pemegang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pemegang" name="pemegang"
                        value="<?= $kendaraan['pemegang']; ?>">
                    </div>
                  </div>

                  <!-- Pangkat -->
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="<?= $kendaraan['pangkat']; ?>">
                    </div>
                  </div>

                  <!-- NRP -->
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $kendaraan['nrp']; ?>">
                    </div>
                  </div>

                  <!-- Jabatan -->
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jabatan" name="jabatan"
                        value="<?= $kendaraan['jabatan']; ?>">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>kendaraan/index" class="btn btn-danger">Cancel</a>
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