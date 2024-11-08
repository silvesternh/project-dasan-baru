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
                <form action="/anggota/update/<?= $anggota['id_anggota']; ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $anggota['nama']; ?>" value="<?= old('pangkat'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="pangkat">Pangkat</label>
                    <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= $anggota['pangkat']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="nrp">Nrp</label>
                    <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $anggota['nrp']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $anggota['jabatan']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="text" class="form-control" id="foto" name="foto" value="<?= $anggota['foto']; ?>">
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection(); ?>