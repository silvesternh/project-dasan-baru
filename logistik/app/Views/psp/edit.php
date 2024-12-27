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
                <form action="<?= base_url(); ?>/psp/update/<?= $psp['id_psp']; ?>" method="post" enctype="multipart/form-data">
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
                          <option value="<?= $s->id_satker ?>" <?= $psp['id_satker'] == $s->id_satker ? 'selected' : '' ?>><?= $s->nama_satker ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <!-- PSP -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="psp">Data PSP</label>
                          <input type="number" class="form-control" id="psp_s" name="psp_s" value="<?= $psp['psp_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="psp_b" name="psp_b" value="<?= $psp['psp_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="psp_t" name="psp_t" value="<?= $psp['psp_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <!-- TANAH -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="tanah">TANAH</label>
                          <input type="number" class="form-control" id="tanah_s" name="tanah_s" value="<?= $psp['tanah_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="tanah_b" name="tanah_b" value="<?= $psp['tanah_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="tanah_t" name="tanah_t" value="<?= $psp['tanah_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <!-- ALAT ANGKUTAN -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="angkut">ALAT ANGKUTAN</label>
                          <input type="number" class="form-control" id="angkut_s" name="angkut_s" value="<?= $psp['angkut_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="angkut_b" name="angkut_b" value="<?= $psp['angkut_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="angkut_t" name="angkut_t" value="<?= $psp['angkut_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <!-- PALSIN NONTIK -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="nontik">PALSIN NONTIK</label>
                          <input type="number" class="form-control" id="nontik_s" name="nontik_s" value="<?= $psp['nontik_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="nontik_b" name="nontik_b" value="<?= $psp['nontik_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="nontik_t" name="nontik_t" value="<?= $psp['nontik_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <!-- PALSIN TIK -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="tik">PALSIN TIK</label>
                          <input type="number" class="form-control" id="tik_s" name="tik_s" value="<?= $psp['tik_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="tik_b" name="tik_b" value="<?= $psp['tik_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="tik_t" name="tik_t" value="<?= $psp['tik_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <!-- ALAT BESAR -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="besar">ALAT BESAR</label>
                          <input type="number" class="form-control" id="besar_s" name="besar_s" value="<?= $psp['besar_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="besar_b" name="besar_b" value="<?= $psp['besar_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="besar_t" name="besar_t" value="<?= $psp['besar_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="senjata">SENJATA</label>
                          <input type="number" class="form-control" id="senjata_s" name="senjata_s" value="<?= $psp['senjata_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="senjata_b" name="senjata_b" value="<?= $psp['senjata_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="senjata_t" name="senjata_t" value="<?= $psp['senjata_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="gedung">GEDUNG</label>
                          <input type="number" class="form-control" id="gedung_s" name="gedung_s" value="<?= $psp['gedung_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="gedung_b" name="gedung_b" value="<?= $psp['gedung_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="gedung_t" name="gedung_t" value="<?= $psp['gedung_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="rumah">RUMAH NEGARA</label>
                          <input type="number" class="form-control" id="rumah_s" name="rumah_s" value="<?= $psp['rumah_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="rumah_b" name="rumah_b" value="<?= $psp['rumah_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="rumah_t" name="rumah_t" value="<?= $psp['rumah_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="jalan">JALAN JEMBATAN</label>
                          <input type="number" class="form-control" id="jalan_s" name="jalan_s" value="<?= $psp['jalan_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="jalan_b" name="jalan_b" value="<?= $psp['jalan_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="jalan_t" name="jalan_t" value="<?= $psp['jalan_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="jaringan">JARINGAN</label>
                          <input type="number" class="form-control" id="jaringan_s" name="jaringan_s" value="<?= $psp['jaringan_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="jaringan_b" name="jaringan_b" value="<?= $psp['jaringan_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="jaringan_t" name="jaringan_t" value="<?= $psp['jaringan_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="atl">ATL</label>
                          <input type="number" class="form-control" id="atl_s" name="atl_s" value="<?= $psp['atl_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="atl_b" name="atl_b" value="<?= $psp['atl_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="atl_t" name="atl_t" value="<?= $psp['atl_t']; ?>" readonly><br>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="atb">ATB</label>
                          <input type="number" class="form-control" id="atb_s" name="atb_s" value="<?= $psp['atb_s']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="atb_b" name="atb_b" value="<?= $psp['atb_b']; ?>" oninput="calculateTotal()"><br>
                          <input type="number" class="form-control" id="atb_t" name="atb_t" value="<?= $psp['atb_t']; ?>" readonly><br>
                        </div>
                      </div>

                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>psp/index" class="btn btn-danger">Cancel</a>
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

<script>
  // JavaScript function to calculate total for each category
  function calculateTotal() {
    // Loop over each set of fields and calculate the total
    ['psp', 'tanah', 'angkut', 'nontik', 'tik', 'besar', 'senjata', 'gedung', 'rumah', 'jalan', 'jaringan', 'atl', 'atb'].forEach(function(field) {
      var s = parseFloat(document.getElementById(field + '_s').value) || 0;
      var b = parseFloat(document.getElementById(field + '_b').value) || 0;
      var total = s + b;
      document.getElementById(field + '_t').value = total;
    });
  }
</script>

<?= $this->endSection(); ?>