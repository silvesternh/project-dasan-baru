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
                <form action="<?= base_url(); ?>/senpi/update/<?= $senpi['id_senpi']; ?>" method="post"
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
                          <option value="<?= $s->id_satker ?>" <?= $senpi['id_satker'] == $s->id_satker ? 'selected' : '' ?>>
                            <?= $s->nama_satker ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Jenis Senpi Dropdown -->
                  <div class="form-group row">
                    <label for="id_jenis" class="col-sm-2 col-form-label">Jenis Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_jenis" id="exampleFormControlSelect1">
                        <option value="">Pilih Jenis Senpi.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $jenis = $db->query("SELECT * FROM jenis")->getResult();
                        foreach ($jenis as $s): ?>
                          <option value="<?= $s->id_jenis ?>" <?= $senpi['id_jenis'] == $s->id_jenis ? 'selected' : '' ?>>
                            <?= $s->nama_jenis ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Merk Senpi Dropdown -->
                  <div class="form-group row">
                    <label for="id_merk" class="col-sm-2 col-form-label">Merk Senpi</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_merk" id="exampleFormControlSelect1">
                        <option value="">Pilih Merk Senpi.....</option>
                        <?php
                        $db = \Config\Database::connect();
                        $merk = $db->query("SELECT * FROM merk")->getResult();
                        foreach ($merk as $s): ?>
                          <option value="<?= $s->id_merk ?>" <?= $senpi['id_merk'] == $s->id_merk ? 'selected' : '' ?>>
                            <?= $s->nama_merk ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Form Fields -->
                  <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $senpi['jumlah']; ?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="baik" class="col-sm-2 col-form-label">Baik</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="baik" name="baik" value="<?= $senpi['baik']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="rr" class="col-sm-2 col-form-label">Rusak Ringan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rr" name="rr" value="<?= $senpi['rr']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="rb" class="col-sm-2 col-form-label">Rusak Berat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rb" name="rb" value="<?= $senpi['rb']; ?>" oninput="calculateTotal()">
                    </div>
                  </div>

                  <!-- Additional Fields -->
                  <div class="form-group row">
                    <label for="polres" class="col-sm-2 col-form-label">Polres</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="polres" name="polres" value="<?= $senpi['polres']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="polsek" class="col-sm-2 col-form-label">Polsek</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="polsek" name="polsek" value="<?= $senpi['polsek']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="gudang" class="col-sm-2 col-form-label">Gudang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gudang" name="gudang" value="<?= $senpi['gudang']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <fieldset class="form-group row">
                      <legend class="col-form-label col-sm-2 float-sm-left pt-0">Keterangan</legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <!-- Check if 'ket' value is 'Laras Panjang' -->
                          <input class="form-check-input" type="radio" name="ket" id="ket1" value="Laras Panjang" <?= ($senpi['ket'] == 'Laras Panjang') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="ket1">
                            Laras Panjang
                          </label>
                        </div>
                        <div class="form-check">
                          <!-- Check if 'ket' value is 'Laras Pendek' -->
                          <input class="form-check-input" type="radio" name="ket" id="ket2" value="Laras Pendek" <?= ($senpi['ket'] == 'Laras Pendek') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="ket2">
                            Laras Pendek
                          </label>
                        </div>
                      </div>
                    </fieldset>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>senpi/index" class="btn btn-danger">Cancel</a>
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