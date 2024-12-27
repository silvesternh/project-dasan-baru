<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dpal" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Senpi</b></h6>
            <h6><b>Note : Sedang Dalam Perbaikan Pada Tampilan Senpi</b></h6>

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
                    background-color: #f8d7da;
                }

                .expiring-soon {
                    background-color: #fff3cd;
                }

                .modal-body {
                    max-height: 400px;
                    overflow-y: auto;
                }
            </style>

            <?php
            // Periksa apakah form telah dikirim
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $larasPanjang = isset($_POST['laras_panjang']) ? (int) $_POST['laras_panjang'] : 0;
                $larasPendek = isset($_POST['laras_pendek']) ? (int) $_POST['laras_pendek'] : 0;
            } else {
                $larasPanjang = 0;
                $larasPendek = 0;
            }

            // Data untuk tabel
            $data = [
                ['ket' => 'Laras Panjang', 'jumlah' => $larasPanjang],
                ['ket' => 'Laras Pendek', 'jumlah' => $larasPendek],
            ];

            $totalJumlah = 0;
            $no = 1;
            ?>

            <table>
                <thead>
                    <tr>
                        <th class="bg-danger" style="text-align: center;">No</th>
                        <th class="bg-danger" style="text-align: center;">Keterangan</th>
                        <th class="bg-danger" style="text-align: center;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $item) {
                        $totalJumlah += $item['jumlah'];
                        echo '<tr>';
                        echo '<td style="text-align: center;">' . $no++ . '</td>';
                        echo '<td>' . htmlspecialchars($item['ket']) . '</td>';
                        echo '<td style="text-align: center;">' . number_format($item['jumlah'], 0, ',', '.') . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold;">Total</td>
                        <td style="text-align: center; font-weight: bold;">
                            <?= number_format($totalJumlah, 0, ',', '.'); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="alert alert-danger" role="alert">
            <h6><b>Data PerSatker</b></h6>

            <div class="mb-3">
                <a href="<?= base_url(); ?>senpi/data" class="btn btn-info">Cari Data</a><br><br>
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
                    background-color: #f8d7da;
                }

                .expiring-soon {
                    background-color: #fff3cd;
                }

                .modal-body {
                    max-height: 400px;
                    overflow-y: auto;
                }
            </style>
            <table id="satkerTable">
                <thead>
                    <tr>
                        <th class="bg-danger" style="text-align: center;">No</th>
                        <th class="bg-danger" style="text-align: center;">Nama Satker</th>
                        <th class="bg-danger" style="text-align: center;">Jumlah Senpi</th>
                        <th class="bg-danger" style="text-align: center;">Ket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $senpiModel = new \App\Models\SenpiModel();
                    $senpiWithDetails = $senpiModel->getSenpiWithDetails();
                    $satkerCounts = [];
                    $totalSenpiAllSatker = 0;

                    // Group senpi by satker
                    foreach ($senpiWithDetails as $value) {
                        $satker = $value['nama_satker'] ?? 'Tidak Diketahui';
                        $satkerCounts[$satker][] = $value;  // Group senpi by satker
                    }

                    // Display each satker and the total jumlah senpi for that satker
                    $no = 1;
                    foreach ($satkerCounts as $satker => $senpis) {
                        $totalPerSatker = 0;  // Initialize total for each satker
                        // Sum the "jumlah" for all senpi items of the current satker
                        foreach ($senpis as $senpi) {
                            $totalPerSatker += (int) $senpi['jumlah'];  // Add up the jumlah field for each senpi
                        }
                        echo '<tr class="satker-row">';
                        echo '<td style="text-align: center;">' . $no++ . '</td>';
                        echo '<td>' . htmlspecialchars($satker) . '</td>';
                        echo '<td style="text-align: center;">' . number_format($totalPerSatker, 0, ',', '.') . '</td>';  // Display the total jumlah senpi for each satker
                        echo '<td style="text-align: center;">
                    <button class="btn btn-primary btn-sm" onclick="showDetail(\'' . htmlspecialchars($satker) . '\')">Detail</button>  <!-- Add btn-sm for smaller button -->
                  </td>';
                        $totalSenpiAllSatker += $totalPerSatker;  // Accumulate total for all satkers
                        echo '</tr>';
                    }
                    ?>
                    <!-- Display total count of senpi across all satkers -->
                    <tr class="total-row">
                        <td colspan="2" style="text-align: center;"><strong>Total Senpi</strong></td>
                        <td colspan="2" style="text-align: center;"><strong><?= number_format($totalSenpiAllSatker, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tbody>
            </table>

        </div>

        <!-- Modal for displaying Senpi details -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Data Senpi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="modalSatkerName" style="font-weight: bold;"></h6>
                        <div>
                            <p id="totalJumlah" style="margin-bottom: 0px; color: blue;"></p> <!-- Display total Jumlah -->
                            <p id="totalLarasPanjang" style="margin-bottom: 0px; color: blue;"></p> <!-- Display total Laras Panjang -->
                            <p id="totalLarasPendek" style="margin-bottom: 5px; color: blue;"></p> <!-- Display total Laras Pendek -->
                        </div>
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Merk Senpi</th>
                                    <th>Jenis Senpi</th>
                                    <th>Baik</th>
                                    <th>Rusak Ringan</th>
                                    <th>Rusak Berat</th>
                                    <th>Gudang</th>
                                    <th>Polres</th>
                                    <th>Polsek</th>
                                    <th>Jumlah Senpi</th>
                                    <th>Keterangan</th> <!-- Display Ket -->
                                </tr>
                            </thead>
                            <tbody id="modalDetailContent"></tbody>
                            <tfoot>
                                <tr id="totalRow">
                                    <td colspan="3" style="text-align: center; font-weight: bold;"><strong>Total</strong></td>
                                    <td id="totalBaik" style="font-weight: bold;"></td>
                                    <td id="totalRusakRingan" style="font-weight: bold;"></td>
                                    <td id="totalRusakBerat" style="font-weight: bold;"></td>
                                    <td id="totalGudang" style="font-weight: bold;"></td>
                                    <td id="totalPolres" style="font-weight: bold;"></td>
                                    <td id="totalPolsek" style="font-weight: bold;"></td>
                                    <td id="totalJumlahFooter" style="font-weight: bold;"></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const senpiData = <?= json_encode($satkerCounts); ?>;

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
                            totalFiltered += parseInt(jumlahCell.textContent.replace(/\./g, ''), 10) || 0;
                        } else {
                            row.style.display = "none";
                        }
                    }
                });

                totalRow.style.display = visibleRows > 0 ? "" : "none";

                const totalCell = totalRow.querySelector("td:nth-child(3)");
                totalCell.textContent = totalFiltered.toLocaleString('id-ID');
            }

            function showDetail(satker) {
                const modalContent = document.getElementById('modalDetailContent');
                const satkerName = document.getElementById('modalSatkerName');
                const totalJumlahElement = document.getElementById('totalJumlah');
                const totalLarasPendekElement = document.getElementById('totalLarasPendek');
                const totalLarasPanjangElement = document.getElementById('totalLarasPanjang');
                const totalJumlahFooter = document.getElementById('totalJumlahFooter');
                const totalBaik = document.getElementById('totalBaik');
                const totalRusakRingan = document.getElementById('totalRusakRingan');
                const totalRusakBerat = document.getElementById('totalRusakBerat');
                const totalGudang = document.getElementById('totalGudang');
                const totalPolres = document.getElementById('totalPolres');
                const totalPolsek = document.getElementById('totalPolsek');

                modalContent.innerHTML = '';
                satkerName.textContent = satker;

                const details = senpiData[satker];
                let totalJumlah = 0;
                let totalLarasPendek = 0;
                let totalLarasPanjang = 0;
                let totalBaikCount = 0;
                let totalRusakRinganCount = 0;
                let totalRusakBeratCount = 0;
                let totalGudangCount = 0;
                let totalPolresCount = 0;
                let totalPolsekCount = 0;

                if (details && details.length > 0) {
                    details.forEach((item, index) => {
                        const berlaku = new Date(item.berlaku);
                        const today = new Date();
                        const diffTime = berlaku - today;
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        let rowClass = '';
                        if (diffDays < 0) {
                            rowClass = 'expired';
                        } else if (diffDays <= 30) {
                            rowClass = 'expiring-soon';
                        }

                        modalContent.innerHTML += `
                <tr class="${rowClass}">
                    <td>${index + 1}</td>
                    <td>${item.nama_merk ?? 'Tidak Diketahui'}</td>
                    <td>${item.nama_jenis ?? 'Tidak Diketahui'}</td>
                    <td>${item.baik ?? 0}</td>
                    <td>${item.rr ?? 0}</td>
                    <td>${item.rb ?? 0}</td>
                    <td>${item.gudang ?? 'Tidak Diketahui'}</td>
                    <td>${item.polres ?? 'Tidak Diketahui'}</td>
                    <td>${item.polsek ?? 'Tidak Diketahui'}</td>
                    <td>${item.jumlah ?? 0}</td>
                    <td>${item.ket ?? 'Tidak Diketahui'}</td>
                </tr>
            `;

                        const jumlah = parseInt(item.jumlah ?? 0, 10);
                        totalJumlah += jumlah;

                        // Check for totals in specific columns
                        totalBaikCount += parseInt(item.baik ?? 0, 10);
                        totalRusakRinganCount += parseInt(item.rr ?? 0, 10);
                        totalRusakBeratCount += parseInt(item.rb ?? 0, 10);
                        totalGudangCount += parseInt(item.gudang ?? 0, 10);
                        totalPolresCount += parseInt(item.polres ?? 0, 10);
                        totalPolsekCount += parseInt(item.polsek ?? 0, 10);

                        // Check if the "keterangan" field contains "Laras Pendek" or "Laras Panjang"
                        if (item.ket && item.ket.toLowerCase().includes("laras pendek")) {
                            totalLarasPendek += jumlah;
                        } else if (item.ket && item.ket.toLowerCase().includes("laras panjang")) {
                            totalLarasPanjang += jumlah;
                        }
                    });

                    // Display the totals
                    totalJumlahElement.textContent = 'Total Senpi: ' + totalJumlah.toLocaleString('id-ID');
                    totalLarasPendekElement.textContent = 'Total Laras Pendek: ' + totalLarasPendek.toLocaleString('id-ID');
                    totalLarasPanjangElement.textContent = 'Total Laras Panjang: ' + totalLarasPanjang.toLocaleString('id-ID');

                    // Set the footer row totals
                    totalJumlahFooter.textContent = totalJumlah.toLocaleString('id-ID');
                    totalBaik.textContent = totalBaikCount.toLocaleString('id-ID');
                    totalRusakRingan.textContent = totalRusakRinganCount.toLocaleString('id-ID');
                    totalRusakBerat.textContent = totalRusakBeratCount.toLocaleString('id-ID');
                    totalGudang.textContent = totalGudangCount.toLocaleString('id-ID');
                    totalPolres.textContent = totalPolresCount.toLocaleString('id-ID');
                    totalPolsek.textContent = totalPolsekCount.toLocaleString('id-ID');
                } else {
                    modalContent.innerHTML = '<tr><td colspan="11">Data tidak ditemukan.</td></tr>';
                }

                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            }
        </script>
    </div>
</div>
<?= $this->endSection(); ?>