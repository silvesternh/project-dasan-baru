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
                  <div class="card-title">Form Tambah Data</div>
                </div>
                <?php if (session()->getFlashdata('validation')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                  </div>
                <?php endif; ?>
                <form action="<?= base_url(); ?>/pemegang/store" method="post">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
                    <label for="id_satker" class="col-sm-2 col-form-label">Satker</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_satker">
                        <option value="">Pilih Satker/Satwil.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $satker = $db->query("SELECT * FROM satker")->getResult();
                        foreach ($satker as $s): ?>
                          <option value="<?= $s->id_satker ?>"><?= $s->nama_satker ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= old('pangkat'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrp" name="nrp" value="<?= old('nrp'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_senpi" class="col-sm-2 col-form-label">Nomor Senpi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="no_senpi" name="no_senpi" value="<?= old('no_senpi'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="id_merk" class="col-sm-2 col-form-label">Merk Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_merk">
                        <option value="">Pilih Merk pemegang.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $merk = $db->query("SELECT * FROM merk")->getResult();
                        foreach ($merk as $s): ?>
                          <option value="<?= $s->id_merk ?>"><?= $s->nama_merk ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="id_jenis" class="col-sm-2 col-form-label">Jenis Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_jenis">
                        <option value="">Pilih Jenis pemegang.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $jenis = $db->query("SELECT * FROM jenis")->getResult();
                        foreach ($jenis as $s): ?>
                          <option value="<?= $s->id_jenis ?>"><?= $s->nama_jenis ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="amu" class="col-sm-2 col-form-label">Amunisi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="amu" name="amu" value="<?= old('amu'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="berlaku" class="col-sm-2 col-form-label">Masa Berlaku</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="berlaku" name="berlaku" value="<?= old('berlaku'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="<?= base_url(); ?>pemegang/index" class="btn btn-danger">Cancel</a>
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

<script>
  // Function to calculate total
  function calculateTotal() {
    // Get the values of baik, rusak ringan, and rusak berat
    let baik = parseInt(document.getElementById('baik').value) || 0;
    let rr = parseInt(document.getElementById('rr').value) || 0;
    let rb = parseInt(document.getElementById('rb').value) || 0;

    // Calculate the total
    let total = baik + rr + rb;

    // Display the total in the 'jumlah' input field
    document.getElementById('jumlah').value = total;
  }
</script>

<?= $this->endSection(); ?>