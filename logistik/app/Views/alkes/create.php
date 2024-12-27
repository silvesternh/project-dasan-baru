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
                                <form action="<?= base_url(); ?>/alkes/store" method="post">
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
                                        <label for="bmn" class="col-sm-2 col-form-label">Jenis BMN</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bmn" name="bmn" value="<?= old('bmn'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bb" class="col-sm-2 col-form-label">Baik</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bb" name="bb"
                                                value="<?= old('bb'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rr" class="col-sm-2 col-form-label">Rusak Ringan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="rr" name="rr"
                                                value="<?= old('rr'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rb" class="col-sm-2 col-form-label">Rusak Berat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="rb" name="rb"
                                                value="<?= old('rb'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="ket" name="ket" value="<?= old('ket'); ?>">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="<?= base_url(); ?>alkes/index" class="btn btn-danger">Cancel</a>
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