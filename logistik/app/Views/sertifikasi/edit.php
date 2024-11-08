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
                <form action="/sertifikasi/update/<?= $sertifikasi['id_sertifikasi']; ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="satker" class="col-sm-2 col-form-label">Satker</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="satker" name="satker" value="<?= $sertifikasi['satker']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $sertifikasi['nama']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= $sertifikasi['pangkat']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP/NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $sertifikasi['nrp']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $sertifikasi['jabatan']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nomor" class="col-sm-2 col-form-label">Nomor Sertifikasi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nomor" name="nomor" value="<?= $sertifikasi['nomor']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="hp" class="col-sm-2 col-form-label">Nomor Hp</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="hp" name="hp" value="<?= $sertifikasi['hp']; ?>">
                    </div>
                  </div>
              </div>
              <div class="card-action">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="/sertifikasi/index" class="btn btn-danger">Cancel</a>
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