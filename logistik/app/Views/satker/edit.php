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
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url(); ?>/satker/update/<?= $satker['id_satker']; ?>" method="post"
                  enctype="multipart/form-data">
                  <?= csrf_field(); ?>


                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="nama_satker" class="col-sm-2 col-form-label">nama_satker</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_satker" name="nama_satker"
                        value="<?= $satker['nama_satker']; ?>">
                    </div>
                  </div>
                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>satker/index" class="btn btn-danger">Cancel</a>
                    </div>
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