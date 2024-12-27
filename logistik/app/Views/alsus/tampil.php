<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dpal" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data Alsus</h4>

        <!-- Data Satker -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Satker</b></h6>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <a href="<?= base_url(); ?>alsus/data" class="btn btn-info">Cari Data</a><br><br>
                <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari Satker..." onkeyup="filterTable()">
            </div>

            <!-- Tabel -->
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
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Satker</th>
                        <th>BMN</th>
                        <th>Ket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    use App\Models\AlsusModel;

                    $alsusModel = new AlsusModel();
                    $alsusWithSatker = $alsusModel->getAlsusWithSatker();
                    $satkerCounts = [];
                    $totalBMN = 0;
                    $no = 1;

                    if (!empty($alsusWithSatker)) {
                        foreach ($alsusWithSatker as $value) {
                            $satker = $value['nama_satker'] ?? 'Tidak Diketahui';
                            $satkerCounts[$satker][] = $value;
                        }

                        foreach ($satkerCounts as $satker => $details) {
                            $jumlah = array_sum(array_map(function ($item) {
                                return (int) ($item['jumlah'] ?? 0); // Pastikan nilai BMN adalah angka
                            }, $details));

                            $totalBMN += $jumlah;

                            echo '<tr class="satker-row">';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td>' . htmlspecialchars($satker) . '</td>';
                            echo '<td>' . number_format($jumlah, 0, ',', '.') . '</td>'; // Menambahkan titik di angka
                            echo '<td><button class="btn btn-info btn-sm" onclick="showDetail(\'' . htmlspecialchars($satker) . '\')">Detail</button></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">Data tidak ditemukan.</td></tr>';
                    }
                    ?>
                    <tr class="total-row">
                        <th colspan="2"><b>Total BMN</b></th>
                        <th><b><?= number_format($totalBMN, 0, ',', '.'); ?></b></th> <!-- Menambahkan titik di angka total -->
                        <th></th>
                    </tr>
                </tbody>

            </table>
        </div>

        <!-- Modal for Detail -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Data Alsus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="modalSatkerName"></h6>
                        <!-- Add a div for the notification -->
                        <div id="nonSimakNotification" class="alert alert-warning" style="display:none;">
                            <strong>Not :</strong> Data Warna Kuning Tidak Masuk Simak.
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>BMN</th>
                                    <th>BB</th>
                                    <th>RR</th>
                                    <th>RB</th>
                                    <th>Jumlah</th>
                                    <!-- Removed the Ket column header -->
                                </tr>
                            </thead>
                            <tbody id="modalDetailContent"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CSS for yellow highlight -->
        <style>
            .highlight-yellow {
                background-color: yellow;
            }
        </style>

        <!-- Script -->
        <script>
            const alsusData = <?= json_encode($satkerCounts); ?>;

            function showDetail(satker) {
                const modalContent = document.getElementById('modalDetailContent');
                const satkerName = document.getElementById('modalSatkerName');
                const nonSimakNotification = document.getElementById('nonSimakNotification'); // Notification element

                modalContent.innerHTML = '';
                satkerName.textContent = '' + satker;

                const details = alsusData[satker];
                let nonSimakFound = false; // Track if "Non Simak" is found

                if (details && details.length > 0) {
                    // Sort the details by the BMN column (ascending A-Z)
                    details.sort((a, b) => {
                        const bmnA = (a.bmn || '').toLowerCase();
                        const bmnB = (b.bmn || '').toLowerCase();
                        return bmnA.localeCompare(bmnB);
                    });

                    details.forEach((item, index) => {
                        // Check if 'Ket' contains 'Non Simak' and highlight the entire row
                        const isKetNonSimak = item.ket && item.ket.toLowerCase().includes('non simak');
                        if (isKetNonSimak) {
                            nonSimakFound = true; // Set flag to true if 'Non Simak' is found
                        }

                        const rowClass = isKetNonSimak ? 'highlight-yellow' : ''; // Apply class to row

                        modalContent.innerHTML += `
                    <tr class="${rowClass}">
                        <td>${index + 1}</td>
                        <td>${item.bmn ?? 'Tidak Diketahui'}</td>
                        <td>${item.bb ?? 'Tidak Diketahui'}</td>
                        <td>${item.rr ?? 'Tidak Diketahui'}</td>
                        <td>${item.rb ?? 'Tidak Diketahui'}</td>
                        <td>${item.jumlah ?? 'Tidak Diketahui'}</td>
                        <!-- Removed the Ket column from the row -->
                    </tr>
                `;
                    });

                    // Show notification if "Non Simak" is found
                    if (nonSimakFound) {
                        nonSimakNotification.style.display = 'block'; // Show the notification
                    } else {
                        nonSimakNotification.style.display = 'none'; // Hide the notification if no "Non Simak" is found
                    }

                } else {
                    modalContent.innerHTML = '<tr><td colspan="6">Data tidak ditemukan.</td></tr>';
                }

                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            }
        </script>

    </div>
</div>
<?= $this->endSection(); ?>