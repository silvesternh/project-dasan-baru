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
                  <div class="card-title">Form Update Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url(); ?>/stok/update/<?= $stok['id_stok']; ?>" method="post"
                  enctype="multipart/form-data">
                  <?= csrf_field(); ?>


                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">kode Barang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kode" name="kode" value="<?= $stok['kode']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-2 col-form-label">uraian</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="uraian" name="uraian" value="<?= $stok['uraian']; ?>">
                    </div>
                  </div>

                  <!-- Merk -->
                  <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">jumlah</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $stok['jumlah']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="keluar" class="col-sm-2 col-form-label">Satuan keluar</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="keluar" name="keluar" value="<?= $stok['keluar']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="masuk" class="col-sm-2 col-form-label">masuk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="masuk" name="masuk" value="<?= $stok['masuk']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="sisa" class="col-sm-2 col-form-label">sisa</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="sisa" name="sisa" value="<?= $stok['sisa']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="ket" class="col-sm-2 col-form-label">ket</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ket" name="ket" value="<?= $stok['ket']; ?>">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>stok/index" class="btn btn-danger">Cancel</a>
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
</div>
<?= $this->endSection(); ?>