<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            <h6><b>Data BBM</b></h6>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    font-size: 12px;
                    overflow-x: auto;
                    /* Allow horizontal scrolling for wider tables */
                    display: block;
                    /* Enables scrolling on small screens */
                }

                th,
                td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    /* Increased padding for better readability */
                    text-align: left;
                }

                th {
                    background-color: #f0f0f0;
                }

                .table-header {
                    background-color: #007bff;
                    color: white;
                    font-weight: bold;
                }

                .total-row {
                    font-weight: bold;
                    background-color: #f9f9f9;
                }

                .tahun-header {
                    text-align: left;
                    font-weight: bold;
                    background-color: #e0e0e0;
                }
            </style>
            <table>
                <?php

                use App\Models\BbmModel;

                $bbmModel = new BbmModel();
                $bbmWithSatker = $bbmModel->getBbmWithSatker();
                $bbmByYear = [];

                // Group the data by year
                if ($bbmWithSatker) {
                    foreach ($bbmWithSatker as $value) {
                        if (isset($value['nama_satker'], $value['p1'], $value['d1'], $value['p2'], $value['d2'], $value['p3'], $value['d3'], $value['p4'], $value['d4'], $value['tahun'])) {
                            $tahun = $value['tahun'];
                            $bbmByYear[$tahun][] = $value;
                        }
                    }
                }

                // Iterate through each year and its corresponding data
                foreach ($bbmByYear as $tahun => $data) {
                    // Display the tahun at the top of the table for each year
                    echo '<tr>';
                    echo '<td colspan="11" class="tahun-header">' . htmlspecialchars($tahun) . '</td>';
                    echo '</tr>';

                    // Column headers
                    echo '<tr>';
                    echo '<th rowspan="2" class="bg-info" style="color: white;">No.</th>';
                    echo '<th rowspan="2" class="bg-info" style="color: white;">Nama Satker</th>';
                    echo '<th colspan="2" class="bg-info" style="text-align: center; color: white;">TW1</th>';
                    echo '<th colspan="2" class="bg-info" style="text-align: center; color: white;">TW2</th>';
                    echo '<th colspan="2" class="bg-info" style="text-align: center; color: white;">TW3</th>';
                    echo '<th colspan="2" class="bg-info" style="text-align: center; color: white;">TW4</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th class="bg-info" style="color: white;">Pertamax</th>';
                    echo '<th class="bg-info" style="color: white;">Dexlite</th>';
                    echo '<th class="bg-info" style="color: white;">Pertamax</th>';
                    echo '<th class="bg-info" style="color: white;">Dexlite</th>';
                    echo '<th class="bg-info" style="color: white;">Pertamax</th>';
                    echo '<th class="bg-info" style="color: white;">Dexlite</th>';
                    echo '<th class="bg-info" style="color: white;">Pertamax</th>';
                    echo '<th class="bg-info" style="color: white;">Dexlite</th>';
                    echo '</tr>';


                    $totalbbm = 0; // Total BBM count for this year
                    $no = 1; // Initialize row number
                    foreach ($data as $bbmData) {
                        echo '<tr>';
                        echo '<td>' . $no++ . '</td>'; // Row number
                        echo '<td>' . htmlspecialchars($bbmData['nama_satker']) . '</td>'; // Display satker name in each row
                        echo '<td>' . htmlspecialchars($bbmData['p1']) . '</td>';
                        echo '<td>' . htmlspecialchars($bbmData['d1']) . '</td>';
                        echo '<td>' . htmlspecialchars($bbmData['p2']) . '</td>';
                        echo '<td>' . htmlspecialchars($bbmData['d2']) . '</td>';
                        echo '<td>' . htmlspecialchars($bbmData['p3']) . '</td>';
                        echo '<td>' . htmlspecialchars($bbmData['d3']) . '</td>';
                        echo '<td>' . htmlspecialchars($bbmData['p4']) . '</td>';
                        echo '<td>' . htmlspecialchars($bbmData['d4']) . '</td>';
                        echo '</tr>';
                        $totalbbm++; // Increment total count
                    }

                    // Display total BBM count for this year
                    echo '<tr class="total-row">';
                    echo '</tr>';
                    echo '<tr style="height: 10px;"></tr>'; // Add spacing between year sections
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>