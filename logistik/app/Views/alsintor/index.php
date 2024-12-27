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
                                    <!-- Add "Tambah Data" button on the left side -->
                                    <div class="col-md-3 d-flex justify-content-start align-items-center">
                                        <a href="<?= base_url(); ?>alsintor/create" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah
                                        </a>
                                        <a href="">.</a>
                                        <!-- Adding more space between the buttons -->
                                        <a href="<?= base_url(); ?>alsintor/export" class="btn btn-success ml-3">
                                            <i class="fas fa-file-export"></i>
                                        </a>
                                        <a href="">.</a>
                                        <!-- New Refresh Button -->
                                        <a href="javascript:void(0);" class="btn btn-danger ml-3" onclick="window.location.reload();">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                    </div>


                                    <!-- Filter Dropdowns -->
                                    <div class="col-md-3">
                                        <label for="filter-satker">Nama Satker</label>
                                        <select id="filter-satker" name="satker" class="form-control">
                                            <option value="">Semua Satker</option>
                                            <?php foreach (array_unique(array_column($alsintor, 'nama_satker')) as $satker): ?>
                                                <option value="<?= $satker ?>"><?= $satker ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="filter-bmn">Jenis BMN</label>
                                        <select id="filter-bmn" name="bmn" class="form-control">
                                            <option value="">Semua bmn</option>
                                            <?php foreach (array_unique(array_column($alsintor, 'bmn')) as $bmn): ?>
                                                <option value="<?= $bmn ?>"><?= $bmn ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>
                            </div><br>
                            <?php if (session()->getFlashdata('pesan')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- Data Table -->
                            <div>
                                <h4>Data Alsintor</h4>
                            </div>
                            <div class="table-responsive">
                                <table id="basic-datatables" class="table-bordered"
                                    style="font-size: 14px; width: 200%; border: 1px solid #ddd;">
                                    <thead>
                                        <tr style="background-color: #0000FF; height: 35px; text-align: center; color: #FFFFFF;">
                                            <th>No</th>
                                            <th>Satker/Satwil</th>
                                            <th>Jenis BMN</th>
                                            <th>Jumlah</th>
                                            <th>Baik</th>
                                            <th>Rusak Ringan</th>
                                            <th>Rusak Berat</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($alsintor as $key => $value): ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $key + 1 ?></td>
                                                <td><?= $value['nama_satker'] ?></td>
                                                <td><?= $value['bmn'] ?></td>
                                                <td><?= $value['jumlah'] ?></td>
                                                <td><?= $value['bb'] ?></td>
                                                <td><?= $value['rr'] ?></td>
                                                <td><?= $value['rb'] ?></td>
                                                <td><?= $value['ket'] ?></td>
                                                <td>
                                                    <form action="<?= base_url('alsintor/edit/' . $value['id_alsintor']) ?>" method="post"
                                                        style="display: inline-block;">
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form action="<?= base_url('alsintor/delete/' . $value['id_alsintor']) ?>"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data alsintor ini?')"
                                                        style="display: inline-block;">
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
                    // Initialize DataTable
                    var table = $('#basic-datatables').DataTable({
                        "scrollX": true,
                        "autoWidth": true,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
                        }
                    });

                    // Apply filters
                    $('#filter-satker, #filter-bmn').on('change', function() {
                        table.column(1).search($('#filter-satker').val()).draw();
                        table.column(2).search($('#filter-bmn').val()).draw();
                        resetRowNumbers(table);
                    });

                    // Reset row numbers after filtering
                    function resetRowNumbers(table) {
                        table.rows({
                            search: 'applied'
                        }).every(function(rowIdx) {
                            $(this.node()).find('td:first').text(rowIdx + 1);
                        });
                    }

                    // Export data based on filters
                    $('.btn-success').on('click', function(e) {
                        e.preventDefault();
                        const satker = $('#filter-satker').val();
                        const bmn = $('#filter-bmn').val();
                        const exportUrl = `<?= base_url(); ?>/alsintor/export?nama_satker=${satker}&bmn=${bmn}`;
                        window.location.href = exportUrl;
                    });
                });
            </script>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>