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
                <form action="<?= base_url(); ?>/pemegang/update/<?= $pemegang['id_pemegang']; ?>" method="post"
                  enctype="multipart/form-data">
                  <?= csrf_field(); ?>

                  <!-- Satker Dropdown -->
                  <div class="form-group row">
                    <label for="id_satker" class="col-sm-2 col-form-label">Satker</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_satker" id="exampleFormControlSelect1">
                        <option value="">Pilih Satker/Satwil.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $satker = $db->query("SELECT * FROM satker")->getResult();
                        foreach ($satker as $s): ?>
                          <option value="<?= $s->id_satker ?>" <?= $pemegang['id_satker'] == $s->id_satker ? 'selected' : '' ?>>
                            <?= $s->nama_satker ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $pemegang['nama']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= $pemegang['pangkat']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $pemegang['nrp']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="no_senpi" class="col-sm-2 col-form-label">Nomor Senpi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="no_senpi" name="no_senpi" value="<?= $pemegang['no_senpi']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <!-- Merk pemegang Dropdown -->
                  <div class="form-group row">
                    <label for="id_merk" class="col-sm-2 col-form-label">Merk Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_merk" id="exampleFormControlSelect1">
                        <option value="">Pilih Merk pemegang.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $merk = $db->query("SELECT * FROM merk")->getResult();
                        foreach ($merk as $s): ?>
                          <option value="<?= $s->id_merk ?>" <?= $pemegang['id_merk'] == $s->id_merk ? 'selected' : '' ?>>
                            <?= $s->nama_merk ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Jenis pemegang Dropdown -->
                  <div class="form-group row">
                    <label for="id_jenis" class="col-sm-2 col-form-label">Jenis Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_jenis" id="exampleFormControlSelect1">
                        <option value="">Pilih Jenis pemegang.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $jenis = $db->query("SELECT * FROM jenis")->getResult();
                        foreach ($jenis as $s): ?>
                          <option value="<?= $s->id_jenis ?>" <?= $pemegang['id_jenis'] == $s->id_jenis ? 'selected' : '' ?>>
                            <?= $s->nama_jenis ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="amu" class="col-sm-2 col-form-label">Amunisi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="amu" name="amu" value="<?= $pemegang['amu']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="berlaku" class="col-sm-2 col-form-label">Masa Berlaku</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="berlaku" name="berlaku" value="<?= $pemegang['berlaku']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>pemegang/index" class="btn btn-danger">Cancel</a>
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

<!-- JavaScript for Total Calculation -->
<script>
  function calculateTotal() {
    let baik = parseInt(document.getElementById('baik').value) || 0;
    let rr = parseInt(document.getElementById('rr').value) || 0;
    let rb = parseInt(document.getElementById('rb').value) || 0;

    let total = baik + rr + rb;
    document.getElementById('jumlah').value = total;
  }
</script>

<?= $this->endSection(); ?>