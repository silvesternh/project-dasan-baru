<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dada" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data Personel Bersertifikasi</h4>

        <!-- Data Satker -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Satker</b></h6>

            <!-- Input Pencarian -->
            <div class="mb-3">
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

                /* Enable scrolling in the modal body */
                .modal-body {
                    max-height: 400px; /* Adjust this value as necessary */
                    overflow-y: auto;  /* Enable vertical scrolling */
                }
            </style>
            <table>
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Satker</th>
                        <th>Jumlah</th>
                        <th>Ket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    use App\Models\SertifikasiModel;

                    $sertifikasiModel = new SertifikasiModel();
                    $sertifikasiWithSatker = $sertifikasiModel->getSertifikasiWithSatker();
                    $satkerCounts = [];
                    $totalBMN = 0;
                    $no = 1;

                    if (!empty($sertifikasiWithSatker)) {
                        // Grouping by Satker
                        foreach ($sertifikasiWithSatker as $value) {
                            $satker = $value['nama_satker'] ?? 'Tidak Diketahui';
                            $satkerCounts[$satker][] = $value;
                        }

                        // Sorting each Satker's personnel by NRP in ascending order
                        foreach ($satkerCounts as $satker => &$details) {
                            usort($details, function($a, $b) {
                                return (int)$a['nrp'] - (int)$b['nrp']; // Sorting by NRP in ascending order
                            });
                        }

                        // Render each satker row
                        foreach ($satkerCounts as $satker => $details) {
                            $jumlah = count($details);
                            $totalBMN += $jumlah;

                            echo '<tr class="satker-row">';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td>' . htmlspecialchars($satker) . '</td>';
                            echo '<td>' . number_format($jumlah, 0, ',', '.') . '</td>';
                            echo '<td><button class="btn btn-info btn-sm" onclick="showDetail(\'' . htmlspecialchars($satker) . '\')">Detail</button></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">Data tidak ditemukan.</td></tr>';
                    }
                    ?>
                    <tr class="total-row">
                        <th colspan="2"><b>Total Personel</b></th>
                        <th><b><?= number_format($totalBMN, 0, ',', '.'); ?></b></th>
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
                        <h5 class="modal-title" id="detailModalLabel">Data Personel Bersertifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="modalSatkerName"></h6>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Pangkat</th>
                                    <th>NRP</th>
                                    <th>Jabatan</th>
                                    <th>Nomor Sertifikasi</th>
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

        <!-- Script -->
        <script>
            const sertifikasiData = <?= json_encode($satkerCounts); ?>;

            // Filter Table based on the input value
            function filterTable() {
                const input = document.getElementById("searchInput").value.toLowerCase();
                const rows = document.querySelectorAll(".satker-row");
                const totalRow = document.querySelector(".total-row");
                let visibleRows = 0;
                let totalFiltered = 0;

                rows.forEach(row => {
                    const satkerCell = row.querySelector("td:nth-child(2)");
                    const jumlahCell = row.querySelector("td:nth-child(3)");

                    if (satkerCell) {
                        const text = satkerCell.textContent.toLowerCase();
                        if (text.includes(input)) {
                            row.style.display = "";
                            visibleRows++;
                            totalFiltered += parseInt(jumlahCell.textContent, 10) || 0;
                        } else {
                            row.style.display = "none";
                        }
                    }
                });

                totalRow.style.display = visibleRows > 0 ? "" : "none";

                // Update the total based on filtered data
                const totalCell = totalRow.querySelector("th:nth-child(3)");
                totalCell.textContent = totalFiltered;
            }

            // Show modal with details for a specific Satker
            function showDetail(satker) {
                const modalContent = document.getElementById('modalDetailContent');
                const satkerName = document.getElementById('modalSatkerName');

                modalContent.innerHTML = '';
                satkerName.textContent = '' + satker;

                const details = sertifikasiData[satker];
                if (details && details.length > 0) {
                    details.forEach((item, index) => {
                        modalContent.innerHTML += ` 
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nama ?? 'Tidak Diketahui'}</td>
                                <td>${item.pangkat ?? 'Tidak Diketahui'}</td>
                                <td>${item.nrp ?? 'Tidak Diketahui'}</td>
                                <td>${item.jabatan ?? 'Tidak Diketahui'}</td>
                                <td>${item.nomor ?? 'Tidak Diketahui'}</td>
                            </tr>
                        `;
                    });
                } else {
                    modalContent.innerHTML = '<tr><td colspan="7">Data tidak ditemukan.</td></tr>';
                }

                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            }
        </script>

    </div>
</div>
<?= $this->endSection(); ?>
