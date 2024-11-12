<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>
        <h4>Data Bangunan</h4>

        <!-- Data Keseluruhan: Counting Kondisi -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Keseluruhan</b></h6>
            <table>
                <tr>
                    <th class="bg-danger">Gedung</th>
                    <th class="bg-danger">Kondisi</th>
                    <th class="bg-danger">Jumlah</th>
                </tr>
                <?php
                // Initialize an array to store kondisi counts by gedung
                $kondisiCounts = array();
                $totalKondisi = 0; // Variable for total count of kondisi
                
                // Loop through bangunan data
                foreach ($bangunan as $value) {
                    $gedung = $value['gedung']; // 'gedung' should be the column name from your dataset
                    $kondisi = $value['kondisi']; // 'kondisi' should be the column name from your dataset
                
                    // Initialize the array for the building if not already initialized
                    if (!isset($kondisiCounts[$gedung])) {
                        $kondisiCounts[$gedung] = array();
                    }

                    // Initialize the count for the condition if not already initialized
                    if (!isset($kondisiCounts[$gedung][$kondisi])) {
                        $kondisiCounts[$gedung][$kondisi] = 0;
                    }

                    // Increment the count for the given condition
                    $kondisiCounts[$gedung][$kondisi]++;
                    $totalKondisi++; // Add 1 to the total kondisi
                }

                // Display the counts for each Gedung and Kondisi
                foreach ($kondisiCounts as $gedung => $kondisiData) {
                    foreach ($kondisiData as $kondisi => $count) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($gedung) . '</td>';
                        echo '<td>' . htmlspecialchars($kondisi) . '</td>';
                        echo '<td>' . $count . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                <tr>
                    <th><b>Total Bangunan</b></th>
                    <th><b></b></th> <!-- Empty cell for the 'Kondisi' column -->
                    <th><b><?php echo $totalKondisi; ?></b></th>
                </tr>
            </table>
        </div>

        <!-- Data Persatker / Satwil: Group by Satker, Gedung, and Kondisi -->
        <div class="alert alert-primary" role="alert">
            <h6><b>Data Persatker / Satwil</b></h6>
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
            </style>
            <table>
                <?php

                use App\Models\BangunanModel;

                $bangunanModel = new BangunanModel();
                $bangunanWithSatker = $bangunanModel->getBangunanWithSatker();
                $kondisiCounts = [];

                if ($bangunanWithSatker) {
                    foreach ($bangunanWithSatker as $value) {
                        if (isset($value['nama_satker'], $value['gedung'], $value['kondisi'])) {
                            $satker = $value['nama_satker']; // Get satker name from the join
                            $gedung = $value['gedung'];
                            $kondisi = $value['kondisi'];

                            $kondisiCounts[$satker][$gedung][$kondisi] = ($kondisiCounts[$satker][$gedung][$kondisi] ?? 0) + 1;
                        }
                    }
                }

                // Loop through the data and display the results
                foreach ($kondisiCounts as $satker => $gedungData) {
                    echo '<tr>';
                    echo '<th colspan="4" style="text-align: center;" class="bg-primary">' . htmlspecialchars($satker) . '</th>';
                    echo '</tr>';

                    // Display each gedung
                    foreach ($gedungData as $gedung => $kondisiData) {
                        echo '<tr>';
                        echo '<th colspan="2" class="table-secondary">' . htmlspecialchars($gedung) . '</th>';
                        echo '</tr>';

                        // Display kondisi for each gedung
                        $totalKondisiGedung = 0; // Variable to hold the total kondisi per gedung
                        foreach ($kondisiData as $kondisi => $count) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($kondisi) . '</td>';
                            echo '<td>' . $count . '</td>';
                            echo '</tr>';
                            $totalKondisiGedung += $count; // Add to the total for this gedung
                        }

                        // Total for each gedung
                        echo '<tr>';
                        echo '<th>Total Semua Kondisi ' . htmlspecialchars($gedung) . '</th>';
                        echo '<th>' . $totalKondisiGedung . '</th>';
                        echo '</tr>';
                        echo '<tr style="height: 10px;"></tr>'; // Space between gedungs
                    }

                    echo '<tr style="height: 10px;"></tr>'; // Space between satkers
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>