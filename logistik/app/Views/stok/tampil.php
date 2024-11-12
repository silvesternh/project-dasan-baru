<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>
        <!-- Data Keseluruhan: Counting Status -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Stock Opname</b></h6>
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
                <thead>
                    <tr>
                        <th class="bg-danger">Kode</th>
                        <th class="bg-danger">Uraian</th>
                        <th class="bg-danger">Sisa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $kodeCounts = array();
                    $totalkode = 0; // Variabel untuk menyimpan total kode
                    $totalSisa = 0; // Variabel untuk menyimpan total sisa
                    $uniqueData = []; // To store unique kode and associated data for display
                    
                    // Loop through all stok data and group by kode
                    foreach ($stok as $value) {
                        $kode = $value['kode']; // Assuming 'kode' is the field for kode
                        $uraian = $value['uraian']; // Assuming 'uraian' is the field for uraian
                        $sisa = $value['sisa']; // Assuming 'sisa' is the field for sisa
                    
                        // Accumulate total 'sisa'
                        $totalSisa += $sisa;

                        // Collect all data under the same kode
                        if (!isset($uniqueData[$kode])) {
                            $uniqueData[$kode] = ['uraian' => $uraian, 'sisa' => 0]; // Initialize if not set
                        }

                        // Add 'sisa' for this 'kode'
                        $uniqueData[$kode]['sisa'] += $sisa;

                        // Update total count of 'kode'
                        $totalkode++;
                    }

                    // Display the data for each unique 'kode'
                    foreach ($uniqueData as $kode => $data) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($kode) . '</td>';
                        echo '<td>' . htmlspecialchars($data['uraian']) . '</td>';
                        echo '<td>' . htmlspecialchars($data['sisa']) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                    <tr>
                        <th><b>Total</b></th>
                        <th><b></b></th>
                        <th><b><?php echo $totalSisa; ?></b></th> <!-- Total sum of 'sisa' -->
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>