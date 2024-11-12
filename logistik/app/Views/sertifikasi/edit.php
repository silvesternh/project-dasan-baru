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
                <form action="<?= base_url(); ?>/sertifikasi/update/<?= $sertifikasi['id_sertifikasi']; ?>"
                  method="post" enctype="multipart/form-data">
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
                          <option value="<?= $s->id_satker ?>" <?= $sertifikasi['id_satker'] == $s->id_satker ? 'selected' : '' ?>><?= $s->nama_satker ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Personil</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama"
                        value="<?= $sertifikasi['nama']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="<?= $sertifikasi['pangkat']; ?>">
                    </div>
                  </div>

                  <!-- Merk -->
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $sertifikasi['nrp']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jabatan" name="jabatan"
                        value="<?= $sertifikasi['jabatan']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nomor" class="col-sm-2 col-form-label">Nomor Sertifikasi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nomor" name="nomor"
                        value="<?= $sertifikasi['nomor']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="hp" class="col-sm-2 col-form-label">Nomor Hp</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="hp" name="hp" value="<?= $sertifikasi['hp']; ?>">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>sertifikasi/index" class="btn btn-danger">Cancel</a>
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