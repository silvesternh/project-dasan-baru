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
                <form action="<?= base_url(); ?>/psp/store" method="post">
                  <?= csrf_field(); ?>
                  <div class="form-group row">
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

                  <div class="row">
                    <!-- PSP Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="psp">Data PSP</label>
                        <input type="text" class="form-control" id="psp_s" name="psp_s" value="<?= old('psp_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="psp_b" name="psp_b" value="<?= old('psp_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="psp_t" name="psp_t" value="<?= old('psp_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Tanah Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="tanah">TANAH</label>
                        <input type="text" class="form-control" id="tanah_s" name="tanah_s" value="<?= old('tanah_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="tanah_b" name="tanah_b" value="<?= old('tanah_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="tanah_t" name="tanah_t" value="<?= old('tanah_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Alat Angkutan Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="angkut">ALAT ANGKUTAN</label>
                        <input type="text" class="form-control" id="angkut_s" name="angkut_s" value="<?= old('angkut_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="angkut_b" name="angkut_b" value="<?= old('angkut_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="angkut_t" name="angkut_t" value="<?= old('angkut_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Palsin Nontik Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="nontik">PALSIN NONTIK</label>
                        <input type="text" class="form-control" id="nontik_s" name="nontik_s" value="<?= old('nontik_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="nontik_b" name="nontik_b" value="<?= old('nontik_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="nontik_t" name="nontik_t" value="<?= old('nontik_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Palsin Tik Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="tik">PALSIN TIK</label>
                        <input type="text" class="form-control" id="tik_s" name="tik_s" value="<?= old('tik_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="tik_b" name="tik_b" value="<?= old('tik_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="tik_t" name="tik_t" value="<?= old('tik_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Alat Besar Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="besar">ALAT BESAR</label>
                        <input type="text" class="form-control" id="besar_s" name="besar_s" value="<?= old('besar_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="besar_b" name="besar_b" value="<?= old('besar_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="besar_t" name="besar_t" value="<?= old('besar_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Senjata Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="senjata">SENJATA</label>
                        <input type="text" class="form-control" id="senjata_s" name="senjata_s" value="<?= old('senjata_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="senjata_b" name="senjata_b" value="<?= old('senjata_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="senjata_t" name="senjata_t" value="<?= old('senjata_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Gedung Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="gedung">GEDUNG</label>
                        <input type="text" class="form-control" id="gedung_s" name="gedung_s" value="<?= old('gedung_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="gedung_b" name="gedung_b" value="<?= old('gedung_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="gedung_t" name="gedung_t" value="<?= old('gedung_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <!-- Rumah Negara Section -->
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="rumah">RUMAH NEGARA</label>
                        <input type="text" class="form-control" id="rumah_s" name="rumah_s" value="<?= old('rumah_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="rumah_b" name="rumah_b" value="<?= old('rumah_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="rumah_t" name="rumah_t" value="<?= old('rumah_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="jalan">JALAN JEMBATAN</label>
                        <input type="text" class="form-control" id="jalan_s" name="jalan_s" value="<?= old('jalan_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="jalan_b" name="jalan_b" value="<?= old('jalan_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="jalan_t" name="jalan_t" value="<?= old('jalan_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="jaringan">JARINGAN</label>
                        <input type="text" class="form-control" id="jaringan_s" name="jaringan_s" value="<?= old('jaringan_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="jaringan_b" name="jaringan_b" value="<?= old('jaringan_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="jaringan_t" name="jaringan_t" value="<?= old('jaringan_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="atl">ATL</label>
                        <input type="text" class="form-control" id="atl_s" name="atl_s" value="<?= old('atl_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="atl_b" name="atl_b" value="<?= old('atl_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="atl_t" name="atl_t" value="<?= old('atl_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="atb">ATB</label>
                        <input type="text" class="form-control" id="atb_s" name="atb_s" value="<?= old('atb_s'); ?>" placeholder="Sudah Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="atb_b" name="atb_b" value="<?= old('atb_b'); ?>" placeholder="Belum Psp" oninput="calculateTotal()" /><br>
                        <input type="text" class="form-control" id="atb_t" name="atb_t" value="<?= old('atb_t'); ?>" placeholder="Jumlah" readonly /><br>
                      </div>
                    </div>
                  </div>

                  <div class="card-action">
                    <button class="btn btn-success">Submit</button>
                    <a href="<?= base_url(); ?>psp/index" class="btn btn-danger">Cancel</a>
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
  function calculateTotal() {
    var psp_s = parseFloat(document.getElementById('psp_s').value) || 0;
    var psp_b = parseFloat(document.getElementById('psp_b').value) || 0;
    var tanah_s = parseFloat(document.getElementById('tanah_s').value) || 0;
    var tanah_b = parseFloat(document.getElementById('tanah_b').value) || 0;
    var angkut_s = parseFloat(document.getElementById('angkut_s').value) || 0;
    var angkut_b = parseFloat(document.getElementById('angkut_b').value) || 0;
    var nontik_s = parseFloat(document.getElementById('nontik_s').value) || 0;
    var nontik_b = parseFloat(document.getElementById('nontik_b').value) || 0;
    var tik_s = parseFloat(document.getElementById('tik_s').value) || 0;
    var tik_b = parseFloat(document.getElementById('tik_b').value) || 0;
    var besar_s = parseFloat(document.getElementById('besar_s').value) || 0;
    var besar_b = parseFloat(document.getElementById('besar_b').value) || 0;
    var senjata_s = parseFloat(document.getElementById('senjata_s').value) || 0;
    var senjata_b = parseFloat(document.getElementById('senjata_b').value) || 0;
    var gedung_s = parseFloat(document.getElementById('gedung_s').value) || 0;
    var gedung_b = parseFloat(document.getElementById('gedung_b').value) || 0;
    var rumah_s = parseFloat(document.getElementById('rumah_s').value) || 0;
    var rumah_b = parseFloat(document.getElementById('rumah_b').value) || 0;
    var jalan_s = parseFloat(document.getElementById('jalan_s').value) || 0;
    var jalan_b = parseFloat(document.getElementById('jalan_b').value) || 0;
    var jaringan_s = parseFloat(document.getElementById('jaringan_s').value) || 0;
    var jaringan_b = parseFloat(document.getElementById('jaringan_b').value) || 0;
    var atl_s = parseFloat(document.getElementById('atl_s').value) || 0;
    var atl_b = parseFloat(document.getElementById('atl_b').value) || 0;
    var atb_s = parseFloat(document.getElementById('atb_s').value) || 0;
    var atb_b = parseFloat(document.getElementById('atb_b').value) || 0;

    document.getElementById('psp_t').value = psp_s + psp_b;
    document.getElementById('tanah_t').value = tanah_s + tanah_b;
    document.getElementById('angkut_t').value = angkut_s + angkut_b;
    document.getElementById('nontik_t').value = nontik_s + nontik_b;
    document.getElementById('tik_t').value = tik_s + tik_b;
    document.getElementById('besar_t').value = besar_s + besar_b;
    document.getElementById('senjata_t').value = senjata_s + senjata_b;
    document.getElementById('gedung_t').value = gedung_s + gedung_b;
    document.getElementById('rumah_t').value = rumah_s + rumah_b;
    document.getElementById('jalan_t').value = jalan_s + jalan_b;
    document.getElementById('jaringan_t').value = jaringan_s + jaringan_b;
    document.getElementById('atl_t').value = atl_s + atl_b;
    document.getElementById('atb_t').value = atb_s + atb_b;
  }
</script>

<?= $this->endSection(); ?>