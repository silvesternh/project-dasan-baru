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
                  <div class="card-title">Form Update Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <!-- Form to update data -->
                <form action="<?= base_url(); ?>/anggotarolog/update/<?= $anggotarolog['id_anggotarolog']; ?>" method="post"
                  enctype="multipart/form-data">
                  <?= csrf_field(); ?>

                  <div class="form-group row">
                    <label for="bag" class="col-sm-2 col-form-label">BAG</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="bag" id="exampleFormControlSelect1">
                        <option value="">Pilih salah satu.....</option>
                        <option value="KAROLOG" <?= $anggotarolog['bag'] == 'KAROLOG' ? 'selected' : '' ?>>KAROLOG</option>
                        <option value="SUBBAG RENMIN" <?= $anggotarolog['bag'] == 'SUBBAG RENMIN' ? 'selected' : '' ?>>SUBBAG RENMIN</option>
                        <option value="BAG FASKON" <?= $anggotarolog['bag'] == 'BAG FASKON' ? 'selected' : '' ?>>BAG FASKON</option>
                        <option value="BAG PAL" <?= $anggotarolog['bag'] == 'BAG PAL' ? 'selected' : '' ?>>BAG PAL</option>
                        <option value="BAG INFOLOG" <?= $anggotarolog['bag'] == 'BAG INFOLOG' ? 'selected' : '' ?>>BAG INFOLOG</option>
                        <option value="BAG ADA" <?= $anggotarolog['bag'] == 'BAG ADA' ? 'selected' : '' ?>>BAG ADA</option>
                        <option value="BAG BEKUM" <?= $anggotarolog['bag'] == 'BAG BEKUM' ? 'selected' : '' ?>>BAG BEKUM</option>
                        <option value="URGUDANG" <?= $anggotarolog['bag'] == 'URGUDANG' ? 'selected' : '' ?>>URGUDANG</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Personel</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama"
                        value="<?= $anggotarolog['nama']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="<?= $anggotarolog['pangkat']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp"
                        value="<?= $anggotarolog['nrp']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jabatan" name="jabatan"
                        value="<?= $anggotarolog['jabatan']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tanggallahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="tanggallahir" name="tanggallahir"
                        value="<?= $anggotarolog['tanggallahir']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="alamat" name="alamat"
                        value="<?= $anggotarolog['alamat']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <!-- Menampilkan Foto yang Ada -->
                      <?php if ($anggotarolog['foto']): ?>
                        <div class="mb-3">
                          <img src="<?= base_url('uploads/' . $anggotarolog['foto']); ?>" alt="Foto Personel" width="100">
                        </div>
                      <?php else: ?>
                        <div class="mb-3">
                          <img src="<?= base_url('uploads/default.jpg'); ?>" alt="Foto Tidak Tersedia" width="100">
                        </div>
                      <?php endif; ?>

                      <!-- Input untuk mengganti foto -->
                      <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="level" class="col-sm-2 col-form-label">level</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="level" id="exampleFormControlSelect1">
                        <option value="">Pilih salah satu.....</option>
                        <option value="1" <?= $anggotarolog['level'] == '1' ? 'selected' : '' ?>>KOMBESPOL</option>
                        <option value="2" <?= $anggotarolog['level'] == '2' ? 'selected' : '' ?>>AKBP</option>
                        <option value="3" <?= $anggotarolog['level'] == '3' ? 'selected' : '' ?>>KOMPOL</option>
                        <option value="4" <?= $anggotarolog['level'] == '4' ? 'selected' : '' ?>>AKP</option>
                        <option value="5" <?= $anggotarolog['level'] == '5' ? 'selected' : '' ?>>IPTU</option>
                        <option value="6" <?= $anggotarolog['level'] == '6' ? 'selected' : '' ?>>IPDA</option>
                        <option value="7" <?= $anggotarolog['level'] == '7' ? 'selected' : '' ?>>AIPTU</option>
                        <option value="8" <?= $anggotarolog['level'] == '8' ? 'selected' : '' ?>>AIPDA</option>
                        <option value="9" <?= $anggotarolog['level'] == '9' ? 'selected' : '' ?>>BRIPKA</option>
                        <option value="10" <?= $anggotarolog['level'] == '10' ? 'selected' : '' ?>>BRIGPOL</option>
                        <option value="11" <?= $anggotarolog['level'] == '11' ? 'selected' : '' ?>>BRIPTU</option>
                        <option value="12" <?= $anggotarolog['level'] == '12' ? 'selected' : '' ?>>BRIPDA</option>
                      </select>
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="<?= base_url(); ?>anggotarolog/index" class="btn btn-danger">Cancel</a>
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