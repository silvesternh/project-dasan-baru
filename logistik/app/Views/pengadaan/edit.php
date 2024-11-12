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
                <form action="<?= base_url(); ?>/pengadaan/update/<?= $pengadaan['id_pengadaan']; ?>" method="post"
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
                          <option value="<?= $s->id_satker ?>" <?= $pengadaan['id_satker'] == $s->id_satker ? 'selected' : '' ?>><?= $s->nama_satker ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="paket" class="col-sm-2 col-form-label">Paket</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="paket" name="paket"
                        value="<?= $pengadaan['paket']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="pagu" class="col-sm-2 col-form-label">Nilai Pagu</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pagu" name="pagu" value="<?= $pengadaan['pagu']; ?>">
                    </div>
                  </div>

                  <!-- Merk -->
                  <div class="form-group row">
                    <label for="kontrak" class="col-sm-2 col-form-label">Nilai Kontrak</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kontrak" name="kontrak"
                        value="<?= $pengadaan['kontrak']; ?>">
                    </div>
                  </div>

                  <!-- Tahun Pembuatan -->
                  <div class="form-group row">
                    <label for="no_kontrak" class="col-sm-2 col-form-label">Nomor Kontrak</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="no_kontrak" name="no_kontrak"
                        value="<?= $pengadaan['no_kontrak']; ?>">
                    </div>
                  </div>

                  <!-- No Mesin -->
                  <div class="form-group row">
                    <label for="mulai_kontrak" class="col-sm-2 col-form-label">Tanggal Mulai Kontrak</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="mulai_kontrak" name="mulai_kontrak"
                        value="<?= $pengadaan['mulai_kontrak']; ?>">
                    </div>
                  </div>

                  <!-- No Rangka -->
                  <div class="form-group row">
                    <label for="akhir_kontrak" class="col-sm-2 col-form-label">Tanggal Akhir Kontrak</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="akhir_kontrak" name="akhir_kontrak"
                        value="<?= $pengadaan['akhir_kontrak']; ?>">
                    </div>
                  </div>

                  <!-- Pemegang -->
                  <div class="form-group row">
                    <label for="penyedia" class="col-sm-2 col-form-label">Penyedia</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="penyedia" name="penyedia"
                        value="<?= $pengadaan['penyedia']; ?>">
                    </div>
                  </div>

                  <!-- Pangkat -->
                  <div class="form-group row">
                    <label for="metode" class="col-sm-2 col-form-label">Metode Pengadaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="metode" name="metode"
                        value="<?= $pengadaan['metode']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tahun" name="tahun"
                        value="<?= $pengadaan['tahun']; ?>">
                    </div>
                  </div>
                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>pengadaan/index" class="btn btn-danger">Cancel</a>
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