<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
       <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dgudang" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <!-- Data Keseluruhan: Counting Status -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Stock Kaporlap</b></h6>
            <!-- Search input field -->
            <input type="text" id="searchInput" onkeyup="searchData()" placeholder="Cari..." class="form-control"><br>
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

                /* Make the table container scrollable */
                .table-container {
                    max-height: 400px;
                    /* Adjust the height as needed */
                    overflow-y: auto;
                    border: 1px solid #ddd;
                    /* Optional: border around the scrollable area */
                }
            </style>

            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th class="bg-danger">No</th>
                            <th class="bg-danger">Uraian</th>
                            <th class="bg-danger">Satuan</th>
                            <th class="bg-danger">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totaljumlah = 0;
                        $uniqueData = [];
                        $no = 1;

                        foreach ($stokkapor as $value) {
                            $uraian = $value['uraian'];
                            $satuan = $value['satuan'];
                            $jumlah = $value['jumlah'];
                            $totaljumlah += $jumlah;

                            if (!isset($uniqueData[$uraian])) {
                                $uniqueData[$uraian] = ['satuan' => $satuan, 'jumlah' => 0];
                            }

                            $uniqueData[$uraian]['jumlah'] += $jumlah;
                        }

                        foreach ($uniqueData as $uraian => $data) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td>' . htmlspecialchars($uraian) . '</td>';
                            echo '<td>' . htmlspecialchars($data['satuan']) . '</td>';
                            echo '<td class="jumlah-cell" style="text-align: right;">' . number_format($data['jumlah'], 0, ',', '.') . '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <th colspan="3" style="text-align: left;"><b>Total</b></th>
                            <th id="totalJumlah" style="text-align: right;"><b><?= number_format($totaljumlah, 0, ',', '.'); ?></b></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function searchData() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        var totalFilteredJumlah = 0; // Initialize filtered total

        for (i = 1; i < tr.length - 1; i++) { // Skip header and total rows
            tr[i].style.display = "none"; // Hide row by default
            td = tr[i].getElementsByTagName("td");
            var rowVisible = false;

            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = ""; // Show row if match is found
                        rowVisible = true;
                        break;
                    }
                }
            }

            // Add jumlah value to total if row is visible
            if (rowVisible) {
                var jumlahCell = tr[i].getElementsByClassName("jumlah-cell")[0];
                if (jumlahCell) {
                    totalFilteredJumlah += parseFloat(jumlahCell.textContent.replace(/\./g, '')) || 0;
                }
            }
        }

        // Update the displayed total jumlah
        document.getElementById("totalJumlah").innerHTML = "<b>" + totalFilteredJumlah.toLocaleString('id-ID') + "</b>";
    }
</script>
<?= $this->endSection(); ?>
