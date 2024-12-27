<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>

<div class="container">
    <div class="page-inner">
        <!-- Tombol Kembali -->
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dinfo" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data PSP (Penetapan Status Pengguna)</h4>

        <!-- Data Keseluruhan -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Keseluruhan</b></h6>
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
            <!-- Menu Pencarian -->
            <input type="text" id="searchInput" onkeyup="searchData()" placeholder="Cari..." class="form-control mb-3">

            <table id="dataTable">
                <thead>
                    <tr>
                        <th class="bg-danger">No</th>
                        <th class="bg-danger">Satker</th>
                        <th class="bg-danger">Sudah PSP</th>
                        <th class="bg-danger">Belum PSP</th>
                        <th class="bg-danger">Jumlah BMN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    use App\Models\PspModel;

                    $pspModel = new PspModel();
                    $pspWithSatker = $pspModel->getPspWithSatker();
                    $totalJumlah = 0; // Untuk menghitung total keseluruhan
                    $no = 1; // Nomor baris

                    if ($pspWithSatker) {
                        foreach ($pspWithSatker as $value) {
                            $satker = $value['nama_satker'] ?? 'Tidak Ada Data';
                            $psp_s = (int)($value['psp_s'] ?? 0);
                            $psp_b = (int)($value['psp_b'] ?? 0);
                            $jumlah = $psp_s + $psp_b;

                            $totalJumlah += $jumlah; // Tambahkan jumlah ke total keseluruhan

                            echo "<tr>";
                            echo "<td>{$no}</td>";
                            echo "<td>{$satker}</td>";
                            echo "<td>" . number_format($psp_s, 0, ',', '.') . "</td>";
                            echo "<td>" . number_format($psp_b, 0, ',', '.') . "</td>";
                            echo "<td>" . number_format($jumlah, 0, ',', '.') . "</td>";
                            echo "</tr>";

                            $no++;
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-center">Total Keseluruhan</th>
                        <th id="totalJumlahDisplay"><?= number_format($totalJumlah, 0, ',', '.'); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Script untuk Pencarian -->
        <script>
            function searchData() {
                const input = document.getElementById("searchInput").value.toLowerCase(); // Ambil input
                const table = document.getElementById("dataTable"); // Referensi tabel
                const tr = table.getElementsByTagName("tr"); // Ambil semua baris tabel

                // Iterasi setiap baris tabel (kecuali header)
                for (let i = 1; i < tr.length - 1; i++) { // Skip header (row 0) dan footer (row terakhir)
                    const row = tr[i];
                    const tds = row.getElementsByTagName("td"); // Ambil semua kolom dalam baris
                    const rowText = Array.from(tds).map(td => td.textContent.toLowerCase()).join(" "); // Gabung teks semua kolom

                    // Periksa apakah teks row mengandung input
                    row.style.display = rowText.includes(input) ? "" : "none";
                }
            }
        </script>
    </div>
</div>

<?= $this->endSection(); ?>
