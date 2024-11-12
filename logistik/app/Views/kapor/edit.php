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
                <form action="<?= base_url(); ?>/kapor/update/<?= $kapor['id_kapor']; ?>" method="post"
                  enctype="multipart/form-data">
                  <?= csrf_field(); ?>


                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $kapor['nama']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="satuan" class="col-sm-2 col-form-label">satuan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="satuan" name="satuan"
                        value="<?= $kapor['satuan']; ?>">
                    </div>
                  </div>

                  <!-- Merk -->
                  <div class="form-group row">
                    <label for="volume" class="col-sm-2 col-form-label">volume</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="volume" name="volume"
                        value="<?= $kapor['volume']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Satuan Harga</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="harga" name="harga" value="<?= $kapor['harga']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jumlah" name="jumlah"
                        value="<?= $kapor['jumlah']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $kapor['tahun']; ?>">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>kapor/index" class="btn btn-danger">Cancel</a>
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