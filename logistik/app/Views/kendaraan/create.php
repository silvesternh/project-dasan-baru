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
                <form action="<?= base_url(); ?>/kendaraan/store" method="post">
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
                    <label for="nopol" class="col-sm-2 col-form-label">Nopol</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nopol" name="nopol" value="<?= old('nopol'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label"> Jenis</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jenis" name="jenis" value="<?= old('jenis'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="merk" name="merk" value="<?= old('merk'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" id="tahun" name="tahun" value="<?= old('tahun'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mesin" class="col-sm-2 col-form-label">No.mesin</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mesin" name="mesin" value="<?= old('mesin'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rangka" class="col-sm-2 col-form-label">No.rangka</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rangka" name="rangka" value="<?= old('rangka'); ?>">
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
                    <label for="roda" class="col-sm-2 col-form-label">Roda</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="roda">
                        <option value="">Pilih Jenis.....</option>
                        <option value="R2">R2</option>
                        <option value="R4">R4</option>
                        <option value="R6">R6</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pemegang" class="col-sm-2 col-form-label">pemegang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pemegang" name="pemegang"
                        value="<?= old('pemegang'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="<?= old('pangkat'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">nrp</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= old('nrp'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jabatan" name="jabatan"
                        value="<?= old('jabatan'); ?>">
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="<?= base_url(); ?>kendaraan/index" class="btn btn-danger">Cancel</a>
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