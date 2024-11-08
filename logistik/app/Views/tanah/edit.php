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
                <form action="/tanah/update/<?= $tanah['id_tanah']; ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="satker" class="col-sm-2 col-form-label">Satker/Wilayah</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="satker" name="satker" value="<?= $tanah['satker']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="luas" class="col-sm-2 col-form-label">Luas</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="luas" name="luas" value="<?= $tanah['luas']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bidang" class="col-sm-2 col-form-label">bidang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="bidang" name="bidang" value="<?= $tanah['bidang']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">status</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="status">
                        <option value="">Pilih salah satu.....</option>
                        <option value="sudah bersertifikasi">Sudah Bersertifikasi</option>
                        <option value="belum bersertifikasi">Belum Bersertifikasi</option>
                      </select>
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="/tanah/index" class="btn btn-danger">Cancel</a>
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