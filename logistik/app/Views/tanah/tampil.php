<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dfaskon" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data Tanah</h4>

        <!-- Data Satker -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Satker</b></h6>

            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari Satker..." onkeyup="filterTable()">
            </div>

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
                        <th>Jumlah</th>
                        <th>Ket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    use App\Models\TanahModel;

                    $tanahModel = new TanahModel();
                    $tanahWithSatker = $tanahModel->getTanahWithSatker();
                    $satkerCounts = [];
                    $totalSatker = 0;
                    $no = 1; // Serial number starts at 1

                    if (!empty($tanahWithSatker)) {
                        foreach ($tanahWithSatker as $value) {
                            $satker = $value['nama_satker'] ?? 'Tidak Diketahui';
                            $satkerCounts[$satker][] = $value; // Simpan detail data tanah berdasarkan satker
                            $totalSatker++;
                        }

                        foreach ($satkerCounts as $satker => $details) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>'; // Display serial number
                            echo '<td>' . htmlspecialchars($satker) . '</td>';
                            echo '<td>' . count($details) . '</td>';
                            echo '<td><button class="btn btn-info btn-sm" onclick="showDetail(\'' . htmlspecialchars($satker) . '\')">Detail</button></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">Data tidak ditemukan.</td></tr>';
                    }
                    ?>
                    <tr>
                        <th colspan="2"><b>Jumlah Tanah</b></th>
                        <th><b><?= $totalSatker; ?></b></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal untuk Detail -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Data Tanah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="modalSatkerName"></h6>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Luas</th>
                                    <th>Bidang</th>
                                    <th>Status</th>
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

        <script>
            const tanahData = <?= json_encode($satkerCounts); ?>; // Mengirim data tanah ke JavaScript
            function filterTable() {
                const input = document.getElementById("searchInput").value.toLowerCase();
                const rows = document.querySelectorAll("tbody tr");
                let visibleRows = 0;
                let totalFiltered = 0;

                rows.forEach(row => {
                    const satkerCell = row.querySelector("td:nth-child(2)");
                    const jumlahCell = row.querySelector("td:nth-child(3)");

                    if (satkerCell) {
                        const satkerText = satkerCell.textContent;

                        if (satkerText.toLowerCase().includes(input)) {
                            row.style.display = ""; // Show row
                            visibleRows++;
                            totalFiltered += parseInt(jumlahCell.textContent, 10) || 0; // Add to total filtered count

                            // Highlight matching search term while preserving original case
                            satkerCell.innerHTML = highlightMatch(satkerText, input);
                        } else {
                            row.style.display = "none"; // Hide row
                        }
                    }
                });

                // Show/hide total row based on visible rows
                const totalRow = document.querySelector(".total-row");
                if (visibleRows > 0) {
                    totalRow.style.display = "";
                    const totalCell = totalRow.querySelector("th:nth-child(3)");
                    totalCell.textContent = totalFiltered;
                } else {
                    totalRow.style.display = "none";
                }
            }

            // Function to highlight matching text (case-insensitive)
            function highlightMatch(text, search) {
                const regex = new RegExp(`(${search})`, 'gi');
                return text.replace(regex, '<span class="bg-warning">$1</span>');
            }

            function showDetail(satker) {
                const modalContent = document.getElementById('modalDetailContent');
                const satkerName = document.getElementById('modalSatkerName');

                modalContent.innerHTML = ''; // Bersihkan isi modal
                satkerName.textContent = '' + satker; // Tampilkan nama satker

                const details = tanahData[satker];
                if (details && details.length > 0) {
                    details.forEach((item, index) => {
                        modalContent.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.luas ?? 'Tidak Diketahui'}</td>
                                <td>${item.bidang ?? 'Tidak Diketahui'}</td>
                                <td>${item.status ?? 'Tidak Diketahui'}</td>
                            </tr>
                        `;
                    });
                } else {
                    modalContent.innerHTML = '<tr><td colspan="4">Data tidak ditemukan.</td></tr>';
                }

                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            }
        </script>
    </div>
</div>
<?= $this->endSection(); ?>