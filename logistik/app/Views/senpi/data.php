<?= $this->extend('layout/tampil'); ?>
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
                  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                      <a href="<?= base_url(); ?>senpi/tampil" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                  </div>
                  <div>
                    <h4>Data Senpi</h4>
                  </div>

                  <!-- Search Input -->
                  <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
                  </div>

                  <div>
                    <div class="table-responsive">
                      <style>
                        table {
                          border-collapse: collapse;
                          width: 100%;
                          font-size: 12px;
                        }

                        th,
                        td {
                          border: 1px solid #ddd;
                          padding: 5px;
                          text-align: left;
                        }

                        th {
                          background-color: #f0f0f0;
                        }

                        .bg-danger {
                          background-color: #dc3545;
                          color: white;
                        }
                      </style>
                      <table>
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Satker/Satwil</th>
                            <th>Jenis Senpi</th>
                            <th>Merk Senpi</th>
                            <th>Jumlah</th>
                            <th>Baik</th>
                            <th>Rusak Ringan</th>
                            <th>Rusak Berat</th>
                            <th>Polres</th>
                            <th>Polsek</th>
                            <th>Gudang</th>
                            <th>ket</th>
                          </tr>

                        </thead>
                        <tbody>
                          <?php foreach ($senpi as $key => $value): ?>
                            <tr>
                              <td style="text-align: center;"><?= $key + 1 ?></td>
                              <td><?= $value['nama_satker'] ?></td>
                              <td><?= $value['nama_jenis'] ?></td>
                              <td><?= $value['nama_merk'] ?></td>
                              <td><?= $value['jumlah'] ?></td>
                              <td><?= $value['baik'] ?></td>
                              <td><?= $value['rr'] ?></td>
                              <td><?= $value['rb'] ?></td>
                              <td><?= $value['polres'] ?></td>
                              <td><?= $value['polsek'] ?></td>
                              <td><?= $value['gudang'] ?></td>
                              <td><?= $value['ket'] ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <script>
                        // Event listener untuk pencarian
                        document.getElementById('searchInput').addEventListener('keyup', function() {
                          const searchTerm = this.value.toLowerCase(); // Ambil input pencarian
                          const tableRows = document.querySelectorAll('table tbody tr'); // Ambil semua baris tabel

                          tableRows.forEach(row => {
                            const rowText = row.textContent.toLowerCase(); // Ambil teks dalam baris
                            if (rowText.includes(searchTerm)) {
                              row.style.display = ''; // Tampilkan baris jika cocok
                            } else {
                              row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                            }
                          });
                        });
                      </script>

                    </div>
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