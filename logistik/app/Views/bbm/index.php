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
                    <a href="<?= base_url(); ?>bbm/create" class="btn btn-primary">
                      <i class="fas fa-plus"></i> Tambah
                    </a>
                    <a href="">.</a>
                    <!-- Adding more space between the buttons -->
                    <a href="<?= base_url(); ?>bbm/export" class="btn btn-success ml-3">
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
                      <?php foreach (array_unique(array_column($bbm, 'nama_satker')) as $satker): ?>
                        <option value="<?= $satker ?>"><?= $satker ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label for="filter-tahun">Tahun</label>
                    <select id="filter-tahun" name="tahun" class="form-control">
                      <option value="">Semua tahun</option>
                      <?php foreach (array_unique(array_column($bbm, 'tahun')) as $tahun): ?>
                        <option value="<?= $tahun ?>"><?= $tahun ?></option>
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
                <h4>Data BBM</h4>
              </div>
              <div class="table-responsive">
                <table id="basic-datatables" class="table-bordered"
                  style="font-size: 14px; width: 130%; border: 1px solid #ddd;">
                  <thead>
                    <tr style="background-color: #0000FF; height: 35px; text-align: center; color: #FFFFFF;">
                      <th>No</th>
                      <th>Satker/Satwil</th>
                      <th>Pertamax TW 1</th>
                      <th>Dexlite TW 1</th>
                      <th>Pertamax TW 2</th>
                      <th>Dexlite TW 2</th>
                      <th>Pertamax TW 3</th>
                      <th>Dexlite TW3</th>
                      <th>Pertamax TW4</th>
                      <th>Dexlite TW4</th>
                      <th>Tahun</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($bbm as $key => $value): ?>
                      <tr>
                        <td style="text-align: center;"><?= $key + 1 ?></td>
                        <td><?= $value['nama_satker'] ?></td>
                        <td><?= $value['p1'] ?></td>
                        <td><?= $value['d1'] ?></td>
                        <td><?= $value['p2'] ?></td>
                        <td><?= $value['d2'] ?></td>
                        <td><?= $value['p3'] ?></td>
                        <td><?= $value['d3'] ?></td>
                        <td><?= $value['p4'] ?></td>
                        <td><?= $value['d4'] ?></td>
                        <td><?= $value['tahun'] ?></td>
                        <td>
                          <form action="<?= base_url('bbm/edit/' . $value['id_bbm']) ?>" method="post"
                            style="display: inline-block;">
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="fas fa-edit"></i>
                            </button>
                          </form>
                          <form action="<?= base_url('bbm/delete/' . $value['id_bbm']) ?>"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data bbm ini?')"
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
        $(document).ready(function () {
          // Initialize DataTable with scrollX and language options
          var table = $('#basic-datatables').DataTable({
            "scrollX": true,
            "autoWidth": true,
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
            }
          });

          $('#filter-satker').on('change', function () {
            table.column(1).search(this.value).draw();
            resetRowNumbers(table);
          });
          $('#filter-tahun').on('change', function () {
            table.column(10).search(this.value).draw();
            resetRowNumbers(table);
          });

          // Function to reset row numbers after filtering
          function resetRowNumbers(table) {
            table.rows().every(function (rowIdx, tableLoop, rowLoop) {
              var row = this.node();
              $('td:eq(0)', row).html(rowIdx + 1); // Set the row number (first column)
            });
          }

          // Export data based on filters
          $('.btn-success').on('click', function (e) { // Make sure the "Ekspor" button is clicked
            e.preventDefault();

            // Get current filter values
            const satker = $('#filter-satker').val();
            const tahun = $('#filter-tahun').val();

            // Construct the export URL with query parameters
            const exportUrl = `<?= base_url(); ?>/bbm/export?nama_satker=${satker}&tahun=${tahun}`;

            // Trigger download by redirecting to the export URL
            window.location.href = exportUrl;
          });
        });
      </script>
    </div>
  </div>
</div>
</div>
<?= $this->endSection(); ?>