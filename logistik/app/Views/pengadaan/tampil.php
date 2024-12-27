<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dada" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data Pengadaan</h4>

        <!-- Data Semua Pengadaan Satker -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Cari Satker</b></h6>
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

            <!-- Input Pencarian -->
            <input type="text" id="searchSatkerInput" onkeyup="searchSatker()" placeholder="Cari Satker..." class="form-control mb-2">

            <!-- Tabel Data Satker -->
            <table id="satkerTable">
                <thead>
                    <tr>
                        <th class="bg-danger">No</th>
                        <th class="bg-danger">Satker</th>
                        <th class="bg-danger">Jumlah Paket</th>
                        <th class="bg-danger">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pengadaanModel = new \App\Models\PengadaanModel();
                    $pengadaanWithSatker = $pengadaanModel->getPengadaanWithSatker();
                    $paketCounts = [];
                    $nomorUrut = 1; // Inisialisasi nomor urut

                    if ($pengadaanWithSatker) {
                        foreach ($pengadaanWithSatker as $value) {
                            if (isset($value['nama_satker'], $value['paket'], $value['penyedia'])) {
                                $satker = $value['nama_satker'];
                                $paket = $value['paket'];
                                $penyedia = $value['penyedia'];

                                if (!isset($paketCounts[$satker])) {
                                    $paketCounts[$satker] = [];
                                }
                                if (!isset($paketCounts[$satker][$penyedia])) {
                                    $paketCounts[$satker][$penyedia] = [];
                                }

                                $paketCounts[$satker][$penyedia][] = $paket;
                            }
                        }

                        $totalJumlahPaket = 0; // Total jumlah paket untuk semua satker

                        foreach ($paketCounts as $satker => $penyediaData) {
                            $totalPaket = 0;
                            foreach ($penyediaData as $pakets) {
                                $totalPaket += count($pakets);
                            }

                            $totalJumlahPaket += $totalPaket; // Menambahkan total paket per satker

                            echo '<tr class="satkerRow">';
                            echo '<td>' . $nomorUrut++ . '</td>'; // Menampilkan nomor urut
                            echo '<td>' . htmlspecialchars($satker) . '</td>';
                            echo '<td class="jumlahPaket">' . $totalPaket . '</td>';
                            echo '<td><button class="btn btn-link" onclick="showPopup(\'' . htmlspecialchars(json_encode($penyediaData)) . '\', \'' . htmlspecialchars($satker) . '\')">
                                <i class="fas fa-eye" style="color: green;"></i></button></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>

            <!-- Menampilkan Total Jumlah Paket -->
            <div class="mt-3">
                <strong>Jumlah Paket : </strong><span id="totalPaket"><?= $totalJumlahPaket; ?></span>
            </div>
        </div>

        <!-- Modal Popup -->
        <div class="modal fade" id="satkerModal" tabindex="-1" role="dialog" aria-labelledby="satkerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="satkerModalLabel">Data Pengadaan</h5>
                        <!-- Close Button with Cross -->
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 id="satkerName"></h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Penyedia</th>
                                </tr>
                            </thead>
                            <tbody id="paketDetails">
                                <!-- Rows will be inserted dynamically -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Fungsi Pencarian
            function searchSatker() {
                const input = document.getElementById('searchSatkerInput').value.toLowerCase();
                const rows = document.querySelectorAll('#satkerTable tbody tr');
                let totalPaket = 0; // Variabel untuk menghitung total paket yang sesuai dengan pencarian

                rows.forEach(row => {
                    const satkerCell = row.cells[1]; // Mengakses kolom Satker
                    const satkerText = satkerCell ? satkerCell.textContent.toLowerCase() : '';
                    const jumlahPaketCell = row.cells[2]; // Mengakses kolom Jumlah Paket
                    const jumlahPaket = jumlahPaketCell ? parseInt(jumlahPaketCell.textContent) : 0;

                    // Menyembunyikan atau menampilkan baris berdasarkan pencarian
                    if (satkerText.includes(input)) {
                        row.style.display = '';
                        totalPaket += jumlahPaket; // Menambahkan jumlah paket jika Satker cocok
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Update jumlah paket yang ditampilkan berdasarkan pencarian
                document.getElementById('totalPaket').textContent = totalPaket;
            }

            // Menampilkan Modal
            function showPopup(data, satker) {
                const parsedData = JSON.parse(data);
                const modalTitle = document.getElementById('satkerName');
                const paketDetails = document.getElementById('paketDetails');

                modalTitle.textContent = `${satker}`;
                paketDetails.innerHTML = '';

                let nomor = 1;
                for (const penyedia in parsedData) {
                    for (const paket of parsedData[penyedia]) {
                        const row = paketDetails.insertRow();
                        row.insertCell(0).textContent = nomor++;
                        row.insertCell(1).textContent = paket;
                        row.insertCell(2).textContent = penyedia;
                    }
                }

                $('#satkerModal').modal('show');
            }

            // Menutup Modal
            function closeModal() {
                $('#satkerModal').modal('hide');
            }
        </script>
    </div>
</div>

<?= $this->endSection(); ?>
