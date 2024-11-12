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
                <form action="<?= base_url(); ?>/bbm/update/<?= $bbm['id_bbm']; ?>" method="post"
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
                          <option value="<?= $s->id_satker ?>" <?= $bbm['id_satker'] == $s->id_satker ? 'selected' : '' ?>>
                            <?= $s->nama_satker ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <h5>TW 1</h5>
                  </div>
                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="p1" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p1" name="p1" value="<?= $bbm['p1']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="d1" class="col-sm-2 col-form-label">Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d1" name="d1" value="<?= $bbm['d1']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <h5>TW 2</h5>
                  </div>
                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="p2" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p2" name="p2" value="<?= $bbm['p2']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="d2" class="col-sm-2 col-form-label">Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d2" name="d2" value="<?= $bbm['d2']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <h5>TW 2</h5>
                  </div>
                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="p3" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p3" name="p3" value="<?= $bbm['p3']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="d3" class="col-sm-2 col-form-label">Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d3" name="d3" value="<?= $bbm['d3']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <h5>TW 2</h5>
                  </div>
                  <!-- Nopol -->
                  <div class="form-group row">
                    <label for="p4" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p4" name="p4" value="<?= $bbm['p4']; ?>">
                    </div>
                  </div>

                  <!-- Jenis -->
                  <div class="form-group row">
                    <label for="d4" class="col-sm-2 col-form-label">Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d4" name="d4" value="<?= $bbm['d4']; ?>">
                    </div>
                  </div>

                  <!-- ket -->
                  <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">tahun</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $bbm['tahun']; ?>">
                    </div>
                  </div>

                  <!-- Submit and Cancel -->
                  <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?= base_url(); ?>bbm/index" class="btn btn-danger">Cancel</a>
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