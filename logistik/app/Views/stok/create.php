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
                                <form action="<?= base_url(); ?>/stok/store" method="post">
                                    <?= csrf_field(); ?>

                                    <div class="form-group row">
                                        <label for="uraian" class="col-sm-2 col-form-label">uraian</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="uraian" name="uraian" value="<?= old('uraian'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="satuan" class="col-sm-2 col-form-label">satuan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-2 col-form-label">jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>">
                                        </div>
                                    </div>

                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="<?= base_url(); ?>stok/index" class="btn btn-danger">Cancel</a>
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