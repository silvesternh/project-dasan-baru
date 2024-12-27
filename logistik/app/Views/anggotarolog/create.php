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
                  <div class="card-title">Form Tambah Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url('/anggotarolog/store') ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="bag" class="col-sm-2 col-form-label">BAG</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="bag">
                        <option value="">Pilih Bag.....</option>
                        <option value="KAROLOG">KAROLOG</option>
                        <option value="SUBBAG RENMIN">SUBBAG RENMIN</option>
                        <option value="BAG FASKON">BAG FASKON</option>
                        <option value="BAG PAL">BAG PAL</option>
                        <option value="BAG INFOLOG">BAG INFOLOG</option>
                        <option value="BAG ADA">BAG ADA</option>
                        <option value="BAG BEKUM">BAG BEKUM</option>
                        <option value="URGUDANG">URGUDANG</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= old('pangkat'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">Nrp</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= old('nrp'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= old('jabatan'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tanggallahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" value="<?= old('tanggallahir'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="level" class="col-sm-2 col-form-label">level</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="level">
                        <option value="">Pilih level.....</option>
                        <option value="1">KOMBESPOL</option>
                        <option value="2">AKBP</option>
                        <option value="3">KOMPOL</option>
                        <option value="4">AKP</option>
                        <option value="5">IPTU</option>
                        <option value="6">IPDA</option>
                        <option value="7">AIPTU</option>
                        <option value="8">AIPDA</option>
                        <option value="9">BRIPKA</option>
                        <option value="10">BRIGPOL</option>
                        <option value="11">BRIPTU</option>
                        <option value="12">BRIPDA</option>
                      </select>
                    </div>
                  </div>
              </div>
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
<?= $this->endSection(); ?>