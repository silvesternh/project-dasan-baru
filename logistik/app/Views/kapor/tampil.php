<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dbekum" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <div class="alert alert-danger" role="alert">
            <h6><b>Data Pengadaan Kapor</b></h6><br>
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

                .table-secondary {
                    background-color: #f9f9f9;
                }

                .table-header {
                    background-color: #f5f5f5;
                    text-align: center;
                }

                th {
                    background-color: #4a90e2;
                    /* Blue background for headers */
                    color: white;
                    /* White text color for headers */
                }
            </style>

            <!-- Grouped data by Tahun -->
            <?php
            // Group the data by 'tahun'
            $groupedByTahun = [];

            foreach ($kapor as $value) {
                $tahun = $value['tahun'];
                if (!isset($groupedByTahun[$tahun])) {
                    $groupedByTahun[$tahun] = [];
                }
                $groupedByTahun[$tahun][] = $value;
            }

            // Loop through each year and display the corresponding data
            foreach ($groupedByTahun as $tahun => $data) {
                // Display the Tahun
                echo '<h6><b>Tahun: ' . $tahun . '</b></h6>';

                // Start the table for this year
                echo '<div class="table-responsive">';
                echo '<table class="table-bordered table-sm">';
                echo '<thead class="bg-primary text-white">';
                echo '<tr>';
                echo '<th>No.</th>'; // Row number column
                echo '<th>Nama</th>';
                echo '<th>Satuan</th>';
                echo '<th>Jumlah</th>';
                echo '<th>Harga Satuan</th>';
                echo '<th>Total Harga</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Counter for row numbers
                $rowNumber = 1;

                // Loop through the data for this year and display each row
                foreach ($data as $value) {
                    echo '<tr>';
                    echo '<td>' . $rowNumber++ . '</td>'; // Row number
                    echo '<td>' . $value['nama'] . '</td>'; // Nama
                    echo '<td>' . $value['satuan'] . '</td>'; // Satuan
                    echo '<td>' . $value['volume'] . '</td>'; // Satuan
                    echo '<td>' . $value['harga'] . '</td>'; // Satuan
                    echo '<td>' . $value['jumlah'] . '</td>'; // Satuan
                    echo '</tr>';
                }

                // End the table for this year
                echo '</tbody>';
                echo '</table>';
                echo '</div><br>';
            }
            ?>


        </div>
    </div>
</div>
<?= $this->endSection(); ?>