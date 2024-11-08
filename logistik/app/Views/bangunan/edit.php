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
                <form action="/bangunan/update/<?= $bangunan['id_bangunan']; ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="gedung" class="col-sm-2 col-form-label">Nama Gedung</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gedung" name="gedung" value="<?= $bangunan['gedung']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="unit" class="col-sm-2 col-form-label">jumlah Unit</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="unit" name="unit" value="<?= $bangunan['unit']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="penghuni" class="col-sm-2 col-form-label">Jumlah penghuni</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="penghuni" name="penghuni" value="<?= $bangunan['penghuni']; ?>">
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
                    <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ket" name="ket" value="<?= $bangunan['ket']; ?>">
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="/bangunan/index" class="btn btn-danger">Cancel</a>
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