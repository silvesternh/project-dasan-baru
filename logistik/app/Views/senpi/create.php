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
                <form action="<?= base_url(); ?>/senpi/store" method="post">
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
                    <label for="id_jenis" class="col-sm-2 col-form-label">Jenis Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_jenis">
                        <option value="">Pilih Jenis Senpi.....</option>
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
                    <label for="id_merk" class="col-sm-2 col-form-label">Merk Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="exampleFormControlSelect1" name="id_merk">
                        <option value="">Pilih Merk Senpi.....</option>
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
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="baik" class="col-sm-2 col-form-label">Baik</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="baik" name="baik" value="<?= old('baik'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rr" class="col-sm-2 col-form-label">Rusak Ringan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rr" name="rr" value="<?= old('rr'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rb" class="col-sm-2 col-form-label">Rusak Berat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rb" name="rb" value="<?= old('rb'); ?>" oninput="calculateTotal()">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="polres" class="col-sm-2 col-form-label">Polres</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="polres" name="polres" value="<?= old('polres'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="polsek" class="col-sm-2 col-form-label">Polsek</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="polsek" name="polsek" value="<?= old('polsek'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="gudang" class="col-sm-2 col-form-label">Gudang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gudang" name="gudang" value="<?= old('gudang'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <fieldset class="form-group row">
                      <legend class="col-form-label col-sm-2 float-sm-left pt-0">Keterangan</legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="ket" id="ket1" value="Laras Panjang" checked>
                          <label class="form-check-label" for="ket1">
                            Laras Panjang
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="ket" id="ket2" value="Laras Pendek">
                          <label class="form-check-label" for="ket2">
                            Laras Pendek
                          </label>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <div class="card-action">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="<?= base_url(); ?>senpi/index" class="btn btn-danger">Cancel</a>
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