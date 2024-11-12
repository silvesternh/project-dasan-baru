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
                <form action="<?= base_url(); ?>/senpi/store" method="post">
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
                    <label for="nama" class="col-sm-2 col-form-label">Nama Penanggungjawab</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label"> pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="<?= old('pangkat'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= old('nrp'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="id_jenis" class="col-sm-2 col-form-label">Jenis Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_jenis">
                        <option value="">Pilih Jenis Senpi.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $jenis = $db->query("SELECT * FROM jenis")->getResult();
                        foreach ($jenis as $s): ?>
                          <option value="<?= $s->id_jenis ?>"><?= $s->nama_jenis ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="id_merk" class="col-sm-2 col-form-label">Merk Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_merk">
                        <option value="">Pilih Merk Senpi.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $merk = $db->query("SELECT * FROM merk")->getResult();
                        foreach ($merk as $s): ?>
                          <option value="<?= $s->id_merk ?>"><?= $s->nama_merk ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_senpi" class="col-sm-2 col-form-label">Nomor Senpi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="no_senpi" name="no_senpi"
                        value="<?= old('no_senpi'); ?>">
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
                      <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode" name="kode" value="<?= old('kode'); ?>">
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-action">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="<?= base_url(); ?>senpi/index" class="btn btn-danger">Cancel</a>
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