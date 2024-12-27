<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dfaskon" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <h4>Data Bangunan</h4>

        <!-- Data Satker -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Satker</b></h6>
            <input type="text" id="searchSatkerInput" onkeyup="searchSatker()" placeholder="Cari Satker..." class="form-control mb-2">
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
            <table id="satkerTable">
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

                    use App\Models\BangunanModel;

                    $bangunanModel = new BangunanModel();
                    $bangunanWithSatker = $bangunanModel->getBangunanWithSatker();
                    $satkerCounts = [];
                    $totalSatker = 0;
                    $no = 1; // Serial number starts at 1

                    if (!empty($bangunanWithSatker)) {
                        foreach ($bangunanWithSatker as $value) {
                            $satker = $value['nama_satker'] ?? 'Tidak Diketahui';
                            $satkerCounts[$satker][] = $value; // Store details of buildings by satker
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
                        <th colspan="2"><b>Jumlah Bangunan</b></th>
                        <th><b><?= $totalSatker; ?></b></th>
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
                        <h5 class="modal-title" id="detailModalLabel">Data Bangunan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="modalSatkerName"></h6>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gedung</th>
                                    <th>Kondisi</th>
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
            const bangunanData = <?= json_encode($satkerCounts); ?>; // Sending building data to JavaScript

            function showDetail(satker) {
                const modalContent = document.getElementById('modalDetailContent');
                const satkerName = document.getElementById('modalSatkerName');

                modalContent.innerHTML = ''; // Clear modal content
                satkerName.textContent = satker; // Display satker name

                const details = bangunanData[satker];
                if (details && details.length > 0) {
                    details.forEach((item, index) => {
                        modalContent.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.gedung ?? 'Tidak Diketahui'}</td>
                                <td>${item.kondisi ?? 'Tidak Diketahui'}</td>
                            </tr>
                        `;
                    });
                } else {
                    modalContent.innerHTML = '<tr><td colspan="3">Data tidak ditemukan.</td></tr>';
                }

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            }

            function searchSatker() {
                const input = document.getElementById('searchSatkerInput');
                const filter = input.value.toUpperCase();
                const table = document.getElementById('satkerTable');
                const tr = table.getElementsByTagName('tr');

                for (let i = 0; i < tr.length; i++) {
                    const td = tr[i].getElementsByTagName('td')[1]; // Satker column is index 1
                    if (td) {
                        const txtValue = td.textContent || td.innerText;
                        tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
                    }
                }
            }
        </script>
    </div>
</div>
<?= $this->endSection(); ?>