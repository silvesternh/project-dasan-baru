<?= $this->extend('layout/index'); ?>
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
                <?php if (session()->getFlashdata('validation')) : ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="/kendaraan/update/<?= $kendaraan['id_kendaraan']; ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="satker" class="col-sm-2 col-form-label">Satker/Satwil</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="satker" name="satker" value="<?= $kendaraan['satker']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nopol" class="col-sm-2 col-form-label">Nopol</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nopol" name="nopol" value="<?= $kendaraan['nopol']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $kendaraan['jenis']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="merk" name="merk" value="<?= $kendaraan['merk']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $kendaraan['tahun']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mesin" class="col-sm-2 col-form-label">No.mesin</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mesin" name="mesin" value="<?= $kendaraan['mesin']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rangka" class="col-sm-2 col-form-label">No.rangka</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rangka" name="rangka" value="<?= $kendaraan['rangka']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kondisi" class="col-sm-2 col-form-label">kondisi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="kondisi">
                        <option value="">Pilih salah satu.....</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pemegang" class="col-sm-2 col-form-label">Pemegang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pemegang" name="pemegang" value="<?= $kendaraan['pemegang']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= $kendaraan['pangkat']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">nrp</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $kendaraan['nrp']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $kendaraan['jabatan']; ?>">
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="/kendaraan/index" class="btn btn-danger">Cancel</a>
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