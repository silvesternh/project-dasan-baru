<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dpal" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data Pemegang Senpi</h4>

        <div class="alert alert-danger" role="alert">
            <h6><b>Data Satker</b></h6>

            <div class="mb-3">
                <a href="<?= base_url(); ?>pemegang/data" class="btn btn-info">Cari Data</a><br><br>
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

                .expired {
                    background-color: red !important;
                    color: white;
                }

                .expiring-soon {
                    background-color: #fff3cd !important;
                    color: #856404;
                }

                .modal-body {
                    max-height: 400px; /* Height with scroll */
                    overflow-y: auto;
                }
            </style>

            <table>
                <thead>
                    <tr>
                        <th class="bg-danger" style="text-align: center;">No</th>
                        <th class="bg-danger" style="text-align: center;">Nama Satker</th>
                        <th class="bg-danger" style="text-align: center;">Jumlah</th>
                        <th class="bg-danger" style="text-align: center;">Detail</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    $pemegangModel = new \App\Models\PemegangModel();
    $pemegangWithDetails = $pemegangModel->getPemegangWithDetails();
    $satkerCounts = [];

    foreach ($pemegangWithDetails as $value) {
        $satker = $value['nama_satker'] ?? 'Tidak Diketahui';
        $satkerCounts[$satker][] = $value;
    }

    $no = 1;
    foreach ($satkerCounts as $satker => $pemegangs) {
        $totalPerSatker = count($pemegangs);

        $isExpired = false;
        $isExpiringSoon = false;
        foreach ($pemegangs as $pemegang) {
            $berlaku = new DateTime($pemegang['berlaku']); // Tanggal berlaku
            $today = new DateTime(); // Tanggal hari ini

            // Mengecek apakah tanggal hari ini sama dengan tanggal berlaku
            if ($today->format('Y-m-d') == $berlaku->format('Y-m-d')) {
                $isExpired = true; // Jika sama, beri tanda expired
                break; // Tidak perlu lanjutkan pengecekan
            }

            // Mengecek apakah masa berlaku kurang dari atau sama dengan 30 hari
            $diff = $berlaku->diff($today)->days * ($berlaku < $today ? -1 : 1);
            if ($diff < 0) {
                $isExpired = true;
                break;
            } elseif ($diff <= 30) {
                $isExpiringSoon = true;
            }
        }

        // Menentukan kelas untuk baris berdasarkan status expired atau expiring soon
        $rowClass = $isExpired ? 'expired' : ($isExpiringSoon ? 'expiring-soon' : '');

        echo "<tr class='satker-row $rowClass'>";
        echo '<td style="text-align: center;">' . $no++ . '</td>';
        echo '<td>' . htmlspecialchars($satker) . '</td>';
        echo '<td style="text-align: center;">' . number_format($totalPerSatker, 0, ',', '.') . '</td>';
        echo '<td style="text-align: center;">
                <button onclick="showDetail(\'' . htmlspecialchars($satker) . '\')">
                    <i class="fas fa-eye" style="color: green;"></i>
                </button>
              </td>';
        echo '</tr>';
    }
    ?>
</tbody>

            </table>
        </div>

        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Data Pemegang Senpi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="modalSatkerName"></h6>
                        <table style="width: 350%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Pangkat</th>
                                    <th>NRP</th>
                                    <th>No.Senpi</th>
                                    <th>Merk</th>
                                    <th>Jenis</th>
                                    <th>Amunisi</th>
                                    <th>Masa Berlaku</th>
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
            const pemegangData = <?= json_encode($satkerCounts); ?>;

            function filterTable() {
                const input = document.getElementById("searchInput").value.toLowerCase();
                const rows = document.querySelectorAll(".satker-row");

                rows.forEach(row => {
                    const satkerCell = row.querySelector("td:nth-child(2)");
                    if (satkerCell) {
                        const text = satkerCell.textContent.toLowerCase();
                        row.style.display = text.includes(input) ? "" : "none";
                    }
                });
            }

            function showDetail(satker) {
                const modalContent = document.getElementById('modalDetailContent');
                const satkerName = document.getElementById('modalSatkerName');

                modalContent.innerHTML = '';
                satkerName.textContent = '' + satker;

                const details = pemegangData[satker];
                if (details && details.length > 0) {
                    details.forEach((item, index) => {
                        const berlaku = new Date(item.berlaku);
                        const today = new Date();
                        const diffTime = berlaku - today;
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        let rowClass = '';
                        if (diffDays < 1) {
                            rowClass = 'expired';
                        } else if (diffDays <= 30) {
                            rowClass = 'expiring-soon';
                        }

                        modalContent.innerHTML += ` 
                            <tr class="${rowClass}">
                                <td>${index + 1}</td>
                                <td>${item.nama ?? 'Tidak Diketahui'}</td>
                                <td>${item.pangkat ?? 'Tidak Diketahui'}</td>
                                <td>${item.nrp ?? 'Tidak Diketahui'}</td>
                                <td>${item.no_senpi ?? 'Tidak Diketahui'}</td>
                                <td>${item.nama_merk ?? 'Tidak Diketahui'}</td>
                                <td>${item.nama_jenis ?? 'Tidak Diketahui'}</td>
                                <td>${item.amu ?? 'Tidak Diketahui'}</td>
                                <td>${item.berlaku ?? 'Tidak Diketahui'}</td>
                            </tr>
                        `;
                    });
                } else {
                    modalContent.innerHTML = '<tr><td colspan="10">Data tidak ditemukan.</td></tr>';
                }

                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            }
        </script>
    </div>
</div>
<?= $this->endSection(); ?>
