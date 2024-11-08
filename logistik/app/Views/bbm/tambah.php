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
                <form action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">No</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            placeholder="No" />
                        </div>
                        <div class="form-group">
                          <label for="largeSelect">Triwulan</label>
                          <select
                            class="form-select form-control-lg"
                            id="largeSelect">
                            <option>Triwulan 1</option>
                            <option>Triwulan 2</option>
                            <option>Triwulan 3</option>
                            <option>Triwulan 4</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="largeSelect">Jenis BBM</label>
                          <select
                            class="form-select form-control-lg"
                            id="largeSelect">
                            <option>Pertamax</option>
                            <option>Dexlite</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="email2">Jumlah</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            placeholder="Jumlah" />
                        </div>
                        <div class="form-group">
                          <label for="email2">Keterangan</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            placeholder="Keterangan" />
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              </form>
              <div class="card-action">
                <button class="btn btn-success">Submit</button>
                <a href="/kendaraan/index" class="btn btn-danger">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?= $this->endSection(); ?>