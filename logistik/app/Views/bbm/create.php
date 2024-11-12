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
                <form action="<?= base_url(); ?>/bbm/store" method="post">
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
                    <h5>TW 1</h5>
                  </div>
                  <div class="form-group row">
                    <label for="p1" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p1" name="p1" value="<?= old('p1'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="d1" class="col-sm-2 col-form-label"> Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d1" name="d1" value="<?= old('d1'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <h5>TW 2</h5>
                  </div>
                  <div class="form-group row">
                    <label for="p2" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p2" name="p2" value="<?= old('p2'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="d2" class="col-sm-2 col-form-label"> Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d2" name="d2" value="<?= old('d2'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <h5>TW 3</h5>
                  </div>
                  <div class="form-group row">
                    <label for="p3" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p3" name="p3" value="<?= old('p3'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="d3" class="col-sm-2 col-form-label"> Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d3" name="d3" value="<?= old('d3'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <h5>TW 4</h5>
                  </div>
                  <div class="form-group row">
                    <label for="p4" class="col-sm-2 col-form-label">Pertamax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p4" name="p4" value="<?= old('p4'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="d4" class="col-sm-2 col-form-label"> Dexlite</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="d4" name="d4" value="<?= old('d4'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label"> Tahun</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tahun" name="tahun" value="<?= old('tahun'); ?>">
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="<?= base_url(); ?>bbm/index" class="btn btn-danger">Cancel</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?= $this->endSection(); ?>