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
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url(); ?>/jenis/store" method="post">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="nama_jenis" class="col-sm-2 col-form-label">Jenis Senpi</label>
                    <div class="col-sm-10">
                      <input type="text"
                        class="form-control <?= ($validation->hasError('nama_jenis')) ? 'is-invalid' : ''; ?>"
                        id="nama_jenis" name="nama_jenis" value="<?= old('nama_jenis'); ?>">
                    </div>
                  </div>
              </div>
              <div class="card-action">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="<?= base_url(); ?>jenis/index" class="btn btn-danger">Cancel</a>
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