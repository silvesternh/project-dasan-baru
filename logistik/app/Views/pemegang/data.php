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
                      <a href="<?= base_url(); ?>pemegang/tampil" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                  </div>
                  <div>
                    <h4>Data Pemegang Senpi</h4>
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
                          width: 300%;
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

                        .expired-row {
                          background-color: red !important;
                          color: white;
                        }

                        .warning-row {
                          background-color: yellow !important;
                          color: black;
                        }
                      </style>
                      <table>
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Satker/Satwil</th>
                            <th>Nama</th>
                            <th>Pangkat/NRP</th>
                            <th>No Senpi</th>
                            <th>Merk</th>
                            <th>Jenis</th>
                            <th>Amunisi</th>
                            <th>Masa Berlaku</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($pemegang as $key => $value): ?>
                            <?php
                            // Check if 'berlaku' is in the past (expired) or within 30 days (warning)
                            $currentDate = new DateTime();
                            $masaBerlaku = new DateTime($value['berlaku']);
                            $interval = $currentDate->diff($masaBerlaku);
                            $isExpired = $masaBerlaku < $currentDate; // If expired
                            $isWarning = $interval->days <= 30 && !$isExpired; // If within 30 days and not expired
                            ?>
                            <tr class="<?= $isExpired ? 'expired-row' : ($isWarning ? 'warning-row' : ''); ?>">
                              <td style="text-align: center;"><?= $key + 1 ?></td>
                              <td><?= $value['nama_satker'] ?></td>
                              <td><?= $value['nama'] ?></td>
                              <td><?= $value['pangkat'] ?>/<?= $value['nrp'] ?></td>
                              <td><?= $value['no_senpi'] ?></td>
                              <td><?= $value['nama_merk'] ?></td>
                              <td><?= $value['nama_jenis'] ?></td>
                              <td><?= $value['amu'] ?></td>
                              <td><?= $value['berlaku'] ?></td>
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