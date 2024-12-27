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
                                <form action="<?= base_url(); ?>/alsus/update/<?= $alsus['id_alsus']; ?>" method="post"
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
                                                    <option value="<?= $s->id_satker ?>" <?= $alsus['id_satker'] == $s->id_satker ? 'selected' : '' ?>><?= $s->nama_satker ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Nopol -->
                                    <div class="form-group row">
                                        <label for="bmn" class="col-sm-2 col-form-label">Jenis BMN</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bmn" name="bmn"
                                                value="<?= $alsus['bmn']; ?>">
                                        </div>
                                    </div>

                                    <!-- Jenis -->
                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $alsus['jumlah']; ?>">
                                        </div>
                                    </div>

                                    <!-- Merk -->
                                    <div class="form-group row">
                                        <label for="bb" class="col-sm-2 col-form-label">Baik</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bb" name="bb"
                                                value="<?= $alsus['bb']; ?>">
                                        </div>
                                    </div>

                                    <!-- Tahun Pembuatan -->
                                    <div class="form-group row">
                                        <label for="rr" class="col-sm-2 col-form-label">Rusak Ringan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="rr" name="rr"
                                                value="<?= $alsus['rr']; ?>">
                                        </div>
                                    </div>

                                    <!-- Pemegang -->
                                    <div class="form-group row">
                                        <label for="rb" class="col-sm-2 col-form-label">Rusak Berat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="rb" name="rb"
                                                value="<?= $alsus['rb']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="ket" id="exampleFormControlSelect1">
                                                <option value="">Keterangan.....</option>
                                                <option value="Simak" <?= $alsus['ket'] == 'Simak' ? 'selected' : '' ?>>Simak</option>
                                                <option value="Non Simak" <?= $alsus['ket'] == 'Non Simak' ? 'selected' : '' ?>>Non Simak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Submit and Cancel -->
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a href="<?= base_url(); ?>alsus/index" class="btn btn-danger">Cancel</a>
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