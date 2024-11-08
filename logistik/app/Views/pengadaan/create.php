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
                  <div class="card-title">Form Tambah Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')) : ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="/pengadaan/store" method="post">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="satker" class="col-sm-2 col-form-label">Satker</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control <?= ($validation->hasError('satker')) ? 'is-invalid' : ''; ?>" id="satker" name="satker" value="<?= old('satker'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="paket" class="col-sm-2 col-form-label">Nama Paket</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="paket" name="paket" value="<?= old('paket'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pagu" class="col-sm-2 col-form-label">Nilai Pagu</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pagu" name="pagu" value="<?= old('pagu'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kontrak" class="col-sm-2 col-form-label">Nilai Kontrak</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kontrak" name="kontrak" value="<?= old('kontrak'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_kontrak" class="col-sm-2 col-form-label">Nomor Kontrak</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="no_kontrak" name="no_kontrak" value="<?= old('no_kontrak'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mulai_kontrak" class="col-sm-2 col-form-label">Tanggal Mulai kontrak</label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" id="mulai_kontrak" name="mulai_kontrak" value="<?= old('mulai_kontrak'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="akhir_kontrak" class="col-sm-2 col-form-label">Tanggal Akhir Kontrak</label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" id="akhir_kontrak" name="akhir_kontrak" value="<?= old('akhir_kontrak'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="penyedia" class="col-sm-2 col-form-label">Penyedia</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="penyedia" name="penyedia" value="<?= old('penyedia'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="metode" class="col-sm-2 col-form-label">Metode Pengadaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="metode" name="metode" value="<?= old('metode'); ?>">
                    </div>
                  </div>
              </div>
              <div class="card-action">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="/pengadaan/index" class="btn btn-danger">Cancel</a>
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