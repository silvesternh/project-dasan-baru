<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dbekum" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data Alsintor</h4>

        <!-- Data Satker -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Satker</b></h6>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <a href="<?= base_url(); ?>alsintor/data" class="btn btn-info">Cari Data</a><br><br>
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

                    use App\Models\AlsintorModel;

                    $alsintorModel = new AlsintorModel();
                    $alsintorWithSatker = $alsintorModel->getAlsintorWithSatker();
                    $satkerCounts = [];
                    $totalBMN = 0;
                    $no = 1;

                    if (!empty($alsintorWithSatker)) {
                        foreach ($alsintorWithSatker as $value) {
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
                <h5 class="modal-title" id="detailModalLabel">Data Alsintor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 id="modalSatkerName"></h6>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>BMN</th>
                            <th>BB</th>
                            <th>RR</th>
                            <th>RB</th>
                            <th>Jumlah</th>
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
    // Data Satker
    const alsintorData = <?= json_encode($satkerCounts); ?>;

    // Filter Table Function
    function filterTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            const satkerCell = row.querySelector("td:nth-child(2)");
            if (satkerCell) {
                const text = satkerCell.textContent.toLowerCase();
                if (text.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        });
    }

    // Show Detail in Modal
    function showDetail(satker) {
        const modalContent = document.getElementById('modalDetailContent');
        const satkerName = document.getElementById('modalSatkerName');

        modalContent.innerHTML = ''; // Clear modal content
        satkerName.textContent = '' + satker;

        const details = alsintorData[satker];
        if (details && details.length > 0) {
            // Sort the details by the BMN column (A-Z)
            details.sort((a, b) => {
                const bmnA = (a.bmn || '').toLowerCase();
                const bmnB = (b.bmn || '').toLowerCase();
                return bmnA.localeCompare(bmnB); // Sort alphabetically
            });

            details.forEach((item, index) => {
                modalContent.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.bmn ?? 'Tidak Diketahui'}</td>
                        <td>${item.bb ?? 'Tidak Diketahui'}</td>
                        <td>${item.rr ?? 'Tidak Diketahui'}</td>
                        <td>${item.rb ?? 'Tidak Diketahui'}</td>
                        <td>${item.jumlah ?? 'Tidak Diketahui'}</td>
                    </tr>
                `;
            });
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