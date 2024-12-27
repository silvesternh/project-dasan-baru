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
                    <a href="<?= base_url(); ?>psp/create" class="btn btn-primary">
                      <i class="fas fa-plus"></i> Tambah
                    </a>
                    <a href="">.</a>
                    <!-- Adding more space between the buttons -->
                    <a href="<?= base_url(); ?>psp/export" class="btn btn-success ml-3">
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
                      <?php foreach (array_unique(array_column($psp, 'nama_satker')) as $satker): ?>
                        <option value="<?= $satker ?>"><?= $satker ?></option>
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
                <h4>Data Psp</h4>
              </div>
              <div class="table-responsive">
                <table id="basic-datatables" class="table-bordered"
                  style="font-size: 14px; width: 450%; border: 1px solid #ddd;">
                  <thead>
                    <tr style="background-color: #0000FF; height: 35px; text-align: center; color: #FFFFFF;">
                      <th rowspan="2">No</th>
                      <th rowspan="2">Satker/Satwil</th>
                      <th colspan="3">PSP</th>
                      <th colspan="3">TANAH</th>
                      <th colspan="3">ALAT ANGKUT</th>
                      <th colspan="3">PALSIN NONTIK</th>
                      <th colspan="3">PALSIN TIK</th>
                      <th colspan="3">ALAT BESAR</th>
                      <th colspan="3">SENJATA</th>
                      <th colspan="3">GEDUNG</th>
                      <th colspan="3">RUMAH NEGARA</th>
                      <th colspan="3">JALAN JEMBATAN</th>
                      <th colspan="3">JARINGAN</th>
                      <th colspan="3">ATL</th>
                      <th colspan="3">ATB</th>
                      <th rowspan="2">Aksi</th>
                    </tr>
                    <tr style="background-color: #0000FF; height: 35px; text-align: center; color: #FFFFFF;">
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                      <th>SUDAH</th>
                      <th>BELUM</th>
                      <th>TOTAL BMN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($psp as $key => $value): ?>
                      <tr>
                        <td style="text-align: center;"><?= $key + 1 ?></td>
                        <td><?= $value['nama_satker'] ?></td>
                        <td><?= $value['psp_s'] ?></td>
                        <td><?= $value['psp_b'] ?></td>
                        <td><?= $value['psp_t'] ?></td>
                        <td><?= $value['tanah_s'] ?></td>
                        <td><?= $value['tanah_b'] ?></td>
                        <td><?= $value['tanah_t'] ?></td>
                        <td><?= $value['angkut_s'] ?></td>
                        <td><?= $value['angkut_b'] ?></td>
                        <td><?= $value['angkut_t'] ?></td>
                        <td><?= $value['nontik_s'] ?></td>
                        <td><?= $value['nontik_b'] ?></td>
                        <td><?= $value['nontik_t'] ?></td>
                        <td><?= $value['tik_s'] ?></td>
                        <td><?= $value['tik_b'] ?></td>
                        <td><?= $value['tik_t'] ?></td>
                        <td><?= $value['besar_s'] ?></td>
                        <td><?= $value['besar_b'] ?></td>
                        <td><?= $value['besar_t'] ?></td>
                        <td><?= $value['senjata_s'] ?></td>
                        <td><?= $value['senjata_b'] ?></td>
                        <td><?= $value['senjata_t'] ?></td>
                        <td><?= $value['gedung_s'] ?></td>
                        <td><?= $value['gedung_b'] ?></td>
                        <td><?= $value['gedung_t'] ?></td>
                        <td><?= $value['rumah_s'] ?></td>
                        <td><?= $value['rumah_b'] ?></td>
                        <td><?= $value['rumah_t'] ?></td>
                        <td><?= $value['jalan_s'] ?></td>
                        <td><?= $value['jalan_b'] ?></td>
                        <td><?= $value['jalan_t'] ?></td>
                        <td><?= $value['jaringan_s'] ?></td>
                        <td><?= $value['jaringan_b'] ?></td>
                        <td><?= $value['jaringan_t'] ?></td>
                        <td><?= $value['atl_s'] ?></td>
                        <td><?= $value['atl_b'] ?></td>
                        <td><?= $value['atl_t'] ?></td>
                        <td><?= $value['atb_s'] ?></td>
                        <td><?= $value['atb_b'] ?></td>
                        <td><?= $value['atb_t'] ?></td>
                        <td>
                          <form action="<?= base_url('psp/edit/' . $value['id_psp']) ?>" method="post"
                            style="display: inline-block;">
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="fas fa-edit"></i>
                            </button>
                          </form>
                          <form action="<?= base_url('psp/delete/' . $value['id_psp']) ?>"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data psp ini?')"
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
          // Initialize DataTable with scrollX and language options
          var table = $('#basic-datatables').DataTable({
            "scrollX": true,
            "autoWidth": true,
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
            }
          });

          $('#filter-satker').on('change', function() {
            table.column(1).search(this.value).draw();
            resetRowNumbers(table); // Reset row numbers after filtering
          });

          // Function to reset row numbers after filtering
          function resetRowNumbers(table) {
            table.rows().every(function(rowIdx, tableLoop, rowLoop) {
              var row = this.node();
              $('td:eq(0)', row).html(rowIdx + 1); // Set the row number (first column)
            });
          }

          // Export data based on filters
          $('.btn-success').on('click', function(e) { // Make sure the "Ekspor" button is clicked
            e.preventDefault();

            // Get current filter values
            const satker = $('#filter-satker').val();

            // Construct the export URL with query parameters
            const exportUrl = `<?= base_url(); ?>/psp/export?nama_satker=${satker}`;

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