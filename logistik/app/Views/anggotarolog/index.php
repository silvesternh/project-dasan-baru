<?= $this->extend('layout/index'); ?>
<?= $this->section('isi'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <!-- Add "Tambah Data" button -->
                                    <div class="col-md-3 d-flex justify-content-start align-items-center">
                                        <a href="<?= base_url(); ?>anggotarolog/create" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah
                                        </a>
                                        <a href="<?= base_url(); ?>anggotarolog/export" class="btn btn-success ml-3">
                                            <i class="fas fa-file-export"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger ml-3" onclick="window.location.reload();">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                    </div>
                                    <!-- Filter -->
                                    <div class="col-md-3">
                                        <label for="filter-nama">Nama Personel</label>
                                        <select id="filter-nama" name="nama" class="form-control">
                                            <option value="">Semua...</option>
                                            <?php foreach (array_unique(array_column($anggotarolog, 'nama')) as $nama): ?>
                                                <option value="<?= $nama ?>"><?= $nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- Flash Message -->
                            <?php if (session()->getFlashdata('pesan')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- Data Table -->
                            <div>
                                <h4>Data Personel</h4>
                            </div>
                            <div class="table-responsive">
                                <table id="basic-datatables" class="table-bordered"
                                    style="font-size: 14px; width: 100%; border: 1px solid #ddd;">
                                    <thead>
                                        <tr style="background-color: #0000FF; height: 35px; text-align: center; color: #FFFFFF;">
                                            <th>No</th>
                                            <th>Bag</th>
                                            <th>Nama</th>
                                            <th>Pangkat/NRP</th>
                                            <th>Jabatan</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>LEVEL</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($anggotarolog as $key => $value): ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $key + 1 ?></td>
                                                <td><?= $value['bag'] ?></td>
                                                <td><?= $value['nama'] ?></td>
                                                <td><?= $value['pangkat'] ?> / <?= $value['nrp'] ?></td>
                                                <td><?= $value['jabatan'] ?></td>
                                                <td><?= $value['tanggallahir'] ?></td>
                                                <td><?= $value['alamat'] ?></td>
                                                <td>
                                                    <!-- Menampilkan Foto -->
                                                    <?php if ($value['foto']): ?>
                                                        <img src="<?= base_url('uploads/' . $value['foto']); ?>" alt="Foto" width="40">

                                                    <?php else: ?>
                                                        <img src="<?= base_url('uploads/default.jpg') ?>" alt="Foto Tidak Tersedia" width="40">
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $value['level'] ?></td>
                                                <td>
                                                    <form action="<?= base_url('anggotarolog/edit/' . $value['id_anggotarolog']) ?>" method="post" style="display: inline-block;">
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form action="<?= base_url('anggotarolog/delete/' . $value['id_anggotarolog']) ?>" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggotarolog ini?')" style="display: inline-block;">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Scripts -->
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
            <script>
                $(document).ready(function() {
                    var table = $('#basic-datatables').DataTable({
                        "scrollX": true,
                        "autoWidth": true,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
                        },
                        "order": [
                            [8, "asc"]
                        ],
                        "columnDefs": [{
                                "orderable": false,
                                "targets": 0
                            },
                            {
                                "targets": 8,
                                "visible": false
                            }
                        ],
                        "drawCallback": function(settings) {
                            var api = this.api();
                            var start = api.page.info().start;
                            api.column(0, {
                                search: 'applied',
                                order: 'applied'
                            }).nodes().each(function(cell, i) {
                                cell.innerHTML = start + i + 1;
                            });
                        }
                    });

                    // Nama Filter
                    $('#filter-nama').on('change', function() {
                        const selectedNama = this.value;
                        if (selectedNama) {
                            table.column(2).search(selectedNama).draw();
                        } else {
                            table.column(2).search('').draw();
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>