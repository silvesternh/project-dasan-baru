<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>

        <div class="alert alert-danger" role="alert">
            <h6><b>Data Kaporlap</b></h6><br>
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

                /* New Styles to Change Column Colors to Blue */
                th,


                /* Styling the header to have a more distinct blue shade */
                th {
                    background-color: #4a90e2;
                    /* Blue background for headers */
                    color: white;
                    /* White text color for headers */
                }
            </style>
            <!-- Grouped data by Tahun -->
            <?php
            // Group the data by tahun (year)
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
                echo '<div class="table-responsive">'; // Make table scrollable
                echo '<table class=" border: 1px">'; // Add table-bordered and table-sm classes
                echo '<thead class="bg-primary text-white">'; // Apply blue background with white text
                echo '<tr>';
                echo '<th class="bg-info">No.</th>'; // Add a column for row number
                echo '<th class="bg-info">Nama</th>';  // Add blue color to the "Nama" column
                echo '<th class="bg-info">Satuan</th>';  // Add yellow color to the "Satuan" column
                echo '<th class="bg-info">Volume</th>';  // Add green color to the "Volume" column
                echo '<th class="bg-info">Jumlah</th>';  // Add red color to the "Jumlah" column
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Counter for row numbers
                $rowNumber = 1;

                // Now loop through the data for this year
                $namaSums = array(); // To sum the 'jumlah' for each 'nama'
            
                foreach ($data as $value) {
                    $nama = $value['nama'];
                    $satuan = $value['satuan'];
                    $jumlah = $value['jumlah'];

                    // Sum the 'jumlah' for each 'nama'
                    if (!isset($namaSums[$nama])) {
                        $namaSums[$nama] = 0;
                    }
                    $namaSums[$nama] += $jumlah; // Sum the jumlah for this 'nama'
                }

                // Display the data for each 'nama' along with the sum of 'jumlah'
                foreach ($namaSums as $nama => $totalJumlah) {
                    // Find a representative row for each unique 'nama'
                    $firstRow = null;
                    foreach ($data as $value) {
                        if ($value['nama'] == $nama) {
                            $firstRow = $value; // Take the first matching row for 'nama'
                            break;
                        }
                    }

                    // Display the row data
                    if ($firstRow) {
                        echo '<trclass="table-header">';
                        echo '<td>' . $rowNumber++ . '</td>'; // Display row number
                        echo '<td>' . $nama . '</td>'; // Add blue background to "Nama" column
                        echo '<td>' . $firstRow['satuan'] . '</td>'; // Add yellow background to "Satuan" column
                        echo '<td>' . $firstRow['jumlah'] . '</td>'; // Add green background to "Volume" column
                        echo '<td>' . $totalJumlah . '</td>'; // Add red background to "Jumlah" column
                        echo '</tr>';
                    }
                }

                // End the table for this year
                echo '</tbody>';
                echo '</table>';
                echo '</div><br>'; // End the table-responsive div for scrolling
            }
            ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>