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
                <form action="<?= base_url(); ?>/senpi/update/<?= $senpi['id_senpi']; ?>" method="post"
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
                          <option value="<?= $s->id_satker ?>" <?= $senpi['id_satker'] == $s->id_satker ? 'selected' : '' ?>>
                            <?= $s->nama_satker ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Penanggungjawab</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $senpi['nama']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="<?= $senpi['pangkat']; ?>">
                    </div>
                  </div>

                  <!-- Merk -->
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $senpi['nrp']; ?>">
                    </div>
                  </div>

                  <!-- Satker Dropdown -->
                  <div class="form-group row">
                    <label for="id_jenis" class="col-sm-2 col-form-label">Jenis Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_jenis" id="exampleFormControlSelect1">
                        <option value="">Pilih Penis Senpi.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $jenis = $db->query("SELECT * FROM jenis")->getResult();
                        foreach ($jenis as $s): ?>
                          <option value="<?= $s->id_jenis ?>" <?= $senpi['id_jenis'] == $s->id_jenis ? 'selected' : '' ?>>
                            <?= $s->nama_jenis ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Satker Dropdown -->
                  <div class="form-group row">
                    <label for="id_merk" class="col-sm-2 col-form-label">Merk Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_merk" id="exampleFormControlSelect1">
                        <option value="">Pilih Merk Senpi.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $merk = $db->query("SELECT * FROM merk")->getResult();
                        foreach ($merk as $s): ?>
                          <option value="<?= $s->id_merk ?>" <?= $senpi['id_merk'] == $s->id_merk ? 'selected' : '' ?>>
                            <?= $s->nama_merk ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Tahun Pembuatan -->
                  <div class="form-group row">
                    <label for="no_senpi" class="col-sm-2 col-form-label">Nomor Senpi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="no_senpi" name="no_senpi"
                        value="<?= $senpi['no_senpi']; ?>">
                    </div>
                  </div>

                  <!-- Kondisi -->
                  <div class="form-group row">
                    <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="kondisi" id="exampleFormControlSelect1">
                        <option value="">Pilih salah satu.....</option>
                        <option value="Baik" <?= $senpi['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                        <option value="Rusak Ringan" <?= $senpi['kondisi'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak
                          Ringan</option>
                        <option value="Rusak Berat" <?= $senpi['kondisi'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat
                        </option>
                      </select>
                    </div>
                  </div>

                  <!-- Pemegang -->
                  <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kode" name="kode" value="<?= $senpi['kode']; ?>">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>senpi/index" class="btn btn-danger">Cancel</a>
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