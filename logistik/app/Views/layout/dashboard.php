<?= $this->extend('layout/index'); ?>
<?= $this->section('isi'); ?>
<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
      </div>
    </div>
    <?php if (session()->getFlashdata('error')): ?>
      <div>
        <div class="alert alert-danger" role="alert">
          <?= session()->getFlashdata('error') ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>anggota/index">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-primary bubble-shadow-small">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Personil</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>pengadaan/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-info bubble-shadow-small">
                    <i class="fas fa-book"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">PBJ</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>sertifikasi/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-success bubble-shadow-small">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Personil Bersertifikasi</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>senpi/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-primary bubble-shadow-small">
                    <i class="fas fa-circle"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Senpi</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>kendaraan/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-danger bubble-shadow-small">
                    <i class="fas fa-car"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Ranmor</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>tanah/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-success bubble-shadow-small">
                    <i class="fas fa-map"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4>Tanah</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>bangunan/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-warning bubble-shadow-small">
                    <i class="fas fa-building"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Bangunan</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>kapor/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-info bubble-shadow-small">
                    <i class="fas fa-tshirt"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Kapor</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>bbm/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-warning bubble-shadow-small">
                    <i class="fas fa-gas-pump"></i>

                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">BBM</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a href="<?= base_url(); ?>stok/tampil">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-info bubble-shadow-small text-gray">
                    <i class="fas fa-book"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Stock Opname</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>