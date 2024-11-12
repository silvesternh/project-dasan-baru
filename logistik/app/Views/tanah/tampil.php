<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>
        <h4>Data Tanah</h4>

        <!-- Data Keseluruhan: Counting Status -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Keseluruhan</b></h6>
            <table>
                <tr>
                    <th class="bg-danger">Status</th>
                    <th class="bg-danger">Jumlah</th>
                </tr>
                <?php
                $statusCounts = array();
                $totalstatus = 0; // Variabel untuk menyimpan total status
                foreach ($tanah as $value) {
                    $status = $value['status']; // Assuming 'status' is the field for status
                    if (!isset($statusCounts[$status])) {
                        $statusCounts[$status] = 0;
                    }
                    $statusCounts[$status]++;
                    $totalstatus += 1; // Tambahkan 1 ke total status
                }
                foreach ($statusCounts as $status => $count) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($status) . '</td>';
                    echo '<td>' . $count . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <th><b>Total Tanah</b></th>
                    <th><b><?php echo $totalstatus; ?></b></th>
                </tr>
            </table>
        </div>

        <!-- Data Persatker / Satwil: Group by Satker and Status -->
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

                use App\Models\TanahModel;

                $tanahModel = new TanahModel();
                $tanahWithSatker = $tanahModel->getTanahWithSatker();
                $statusCounts = [];

                // Process data if it exists
                if ($tanahWithSatker) {
                    foreach ($tanahWithSatker as $value) {
                        if (isset($value['nama_satker'], $value['status'])) {
                            $satker = $value['nama_satker']; // Get satker name from the join
                            $status = $value['status']; // Get status
                
                            $statusCounts[$satker][$status] = ($statusCounts[$satker][$status] ?? 0) + 1;
                        }
                    }
                }

                // Iterate through the satker data and display it
                foreach ($statusCounts as $satker => $statusData) {
                    echo '<tr>';
                    echo '<th colspan="2" style="text-align: center;" class="bg-primary">' . htmlspecialchars($satker) . '</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th class="bg-warning">Status</th>';
                    echo '<th class="bg-warning">Jumlah</th>';
                    echo '</tr>';

                    $totalStatusSatker = 0; // Reset the total for each satker
                    foreach ($statusData as $status => $count) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($status) . '</td>';
                        echo '<td>' . $count . '</td>';
                        echo '</tr>';
                        $totalStatusSatker += $count; // Add to the total for this satker
                    }
                    echo '<tr>';
                    echo '<th>Total Tanah ' . htmlspecialchars($satker) . '</th>';
                    echo '<th>' . $totalStatusSatker . '</th>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>