<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>
        <h4>Data Pengadaan</h4>

        <div class="alert alert-danger" role="alert">
            <h6><b>Data Keseluruhan</b></h6>
            <table>
                <tr>
                    <th class="bg-danger">Tahun</th>
                    <th class="bg-danger">Jumlah Paket</th>
                </tr>

                <?php
                $tahunCounts = array();
                $totaltahun = 0; // Variable for storing total tahun (year)
                
                // Loop through the data to count the packages per year
                foreach ($pengadaan as $value) {
                    if (isset($value['tahun'], $value['paket'])) {
                        $tahun = $value['tahun']; // Get the year
                        $paket = $value['paket']; // Get the package
                
                        // Ensure the year is properly counted
                        if (!isset($tahunCounts[$tahun])) {
                            $tahunCounts[$tahun] = array(); // Initialize an array for each year
                        }

                        // Add the package to the year (counting unique packages)
                        if (!in_array($paket, $tahunCounts[$tahun])) {
                            $tahunCounts[$tahun][] = $paket; // Add the unique package
                        }

                        $totaltahun++; // Increment the total year count (can be used for overall total)
                    }
                }

                // Display the count of packages for each year
                foreach ($tahunCounts as $tahun => $paketArray) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($tahun) . '</td>';
                    echo '<td>' . count($paketArray) . '</td>'; // Count the unique packages for the year
                    echo '</tr>';
                }
                ?>
            </table>
        </div>

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
            </style>

            <table>
                <tbody>
                    <?php

                    use App\Models\PengadaanModel;

                    // Create the instance of the PengadaanModel
                    $pengadaanModel = new PengadaanModel();
                    $pengadaanWithSatker = $pengadaanModel->getPengadaanWithSatker();
                    $paketCounts = [];

                    // Check if the data is present
                    if ($pengadaanWithSatker) {
                        foreach ($pengadaanWithSatker as $value) {
                            if (isset($value['nama_satker'], $value['penyedia'], $value['paket'])) {
                                $satker = $value['nama_satker'];
                                $penyedia = $value['penyedia'];
                                $paket = $value['paket'];

                                // Group data by satker, penyedia, and paket
                                $paketCounts[$satker][$penyedia][$paket] = ($paketCounts[$satker][$penyedia][$paket] ?? 0) + 1;
                            }
                        }
                    }

                    // Loop through the satker and its data
                    foreach ($paketCounts as $satker => $penyediaData) {
                        // Display each Satker in its own table
                        echo '<h6>' . htmlspecialchars($satker) . '</h6>'; // Display Satker as a heading for the group
                    
                        // Initialize the serial number for each satker's table
                        $nomor = 1;

                        // Begin a new table for each satker
                        echo '<table border="1">
                    <thead>
                        <tr>
                            <th class="bg-warning">Nomor</th>
                            <th class="bg-warning">Nama Paket</th>
                            <th class="bg-warning">Penyedia</th>
                        </tr>
                    </thead>
                    <tbody>';

                        // Loop through each penyedia under the current satker
                        foreach ($penyediaData as $penyedia => $paketData) {
                            // Loop through the paket data for the current penyedia
                            foreach ($paketData as $paket => $count) {
                                echo '<tr>';
                                echo '<td>' . $nomor++ . '</td>'; // Display the serial number for each satker group
                                echo '<td>' . htmlspecialchars($paket) . '</td>'; // Display the Paket
                                echo '<td>' . htmlspecialchars($penyedia) . '</td>'; // Display the Penyedia
                                echo '</tr>';
                            }
                        }

                        // End the table for the current satker
                        echo '</tbody></table>';
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>