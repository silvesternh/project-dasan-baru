<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>

        <!-- Alert for the main data -->
        <div class="alert alert-danger" role="alert">
            <h5><b>Data Personil Bersertifikasi</b></h5>
            <div class="table-container">
                <!-- Styling the table -->
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        font-size: 11px;
                    }

                    th,
                    td {
                        padding: 6px;
                        text-align: left;
                        border: 1px solid #ddd;
                    }

                    th {
                        background-color: #ff5733;
                        color: white;
                    }

                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    tr:hover {
                        background-color: #f9f9f9;
                    }

                    .table-footer {
                        font-weight: bold;
                        background-color: #e0e0e0;
                    }

                    .table-footer th,
                    .table-footer td {
                        background-color: #e0e0e0;
                        color: black;
                    }

                    .table-container {
                        overflow-x: auto;
                        margin-top: 20px;
                    }
                </style>

                <!-- Data table for Satker -->
                <table>
                    <thead>
                        <tr>
                            <th class="bg-danger">Satker</th>
                            <th class="bg-danger">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use App\Models\SertifikasiModel;

                        // Load Sertifikasi model
                        $sertifikasiModel = new SertifikasiModel();
                        // Get data sertifikasi with satker details
                        $sertifikasiWithSatker = $sertifikasiModel->getSertifikasiWithSatker();

                        $satkerCounts = [];
                        $totalsatker = 0; // Initialize total satker count
                        
                        // Loop through sertifikasiWithSatker to count satker
                        if ($sertifikasiWithSatker) {
                            foreach ($sertifikasiWithSatker as $value) {
                                $satker = $value['nama_satker'];
                                if (!isset($satkerCounts[$satker])) {
                                    $satkerCounts[$satker] = 0;
                                }
                                $satkerCounts[$satker]++;
                                $totalsatker++; // Increment total satker count
                            }
                        }

                        // Output the counts for each satker
                        foreach ($satkerCounts as $satker => $count) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($satker) . '</td>';
                            echo '<td>' . $count . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot class="table-footer">
                        <tr>
                            <th><b>Total Personil</b></th>
                            <th><b><?php echo $totalsatker; ?></b></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Alert for the data per satker -->
        <div class="alert alert-primary" role="alert">
            <h6><b>Data Persatker / Satwil</b></h6><br>
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

            <!-- Display Satker Names above the table -->
            <?php
            // Initialize variable to keep track of the last Satker displayed
            $lastSatker = '';

            // Loop through sertifikasiWithSatker to group by satker, nama, and pangkat
            if ($sertifikasiWithSatker) {
                foreach ($sertifikasiWithSatker as $value) {
                    if (isset($value['nama_satker'], $value['nama'], $value['pangkat'], $value['nrp'])) {
                        $satker = $value['nama_satker'];
                        $nama = $value['nama'];
                        $pangkat = $value['pangkat'];
                        $nrp = $value['nrp'];

                        // Check if the Satker is different from the last displayed Satker
                        if ($satker !== $lastSatker) {
                            if ($lastSatker !== '') {
                                // If it's not the first Satker, close the previous table and move to the next one
                                echo '</table><br>';
                            }

                            // Display the new Satker Name
                            echo '<h6><b>' . $satker . '</b></h6>';

                            // Start a new table for the new Satker
                            echo '<table>';
                            echo '<thead>';
                            echo '<tr class="table-header">';
                            echo '<th>Nama</th>';
                            echo '<th>Pangkat</th>';
                            echo '<th>NRP</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                        }

                        // Output the row for the person
                        echo '<tr>';
                        echo '<td>' . $nama . '</td>';
                        echo '<td>' . $pangkat . '</td>';
                        echo '<td>' . $nrp . '</td>';
                        echo '</tr>';

                        // Update the lastSatker to the current one
                        $lastSatker = $satker;
                    }
                }
            }
            ?>

            <!-- End of the last table -->
            </tbody>
            </table>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>