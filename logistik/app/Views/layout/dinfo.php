<?= $this->extend('layout/index'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3"><a href="<?= base_url(); ?>layout/dashboard">Dashboard</a> / Bag Infolog</h3>
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
            <div class="col-sm-10 col-md-3">
                <a href="<?= base_url(); ?>psp/tampil">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <h4 class="card-title">Data PSP (Penetapan Status Pengguna)</h4>
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