<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dashboard">Kembali</a>
            </div>
        </div>
        <h4>Data Kendaraan</h4>
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Keseluruhan</b></h6>
            <table>
                <tr>
                    <th class="bg-danger">Kondisi</th>
                    <th class="bg-danger">Jumlah</th>
                </tr>
                <?php
                $kondisiCounts = array();
                $totalKondisi = 0; // Variabel untuk menyimpan total kondisi
                foreach ($kendaraan as $value) {
                    $kondisi = $value['kondisi']; // Assuming 'nama_satker' is the key for the kondisi
                    if (!isset($kondisiCounts[$kondisi])) {
                        $kondisiCounts[$kondisi] = 0;
                    }
                    $kondisiCounts[$kondisi]++;
                    $totalKondisi += 1; // Tambahkan 1 ke total kondisi
                }
                foreach ($kondisiCounts as $kondisi => $count) {
                    echo '<tr>';
                    echo '<td>' . $kondisi . '</td>';
                    echo '<td>' . $count . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <th><b>Total Kendaraan</b></th>
                    <th><b><?php echo $totalKondisi; ?></b></th>
                </tr>
            </table>
        </div>
        <div class="alert alert-primary" role="alert">
            <h6><b>Data Persatker / Satwil</b></h6>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    /* Perkecil lebar tabel */
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

                use App\Models\KendaraanModel;

                $kendaraanModel = new KendaraanModel();
                $kendaraanWithSatker = $kendaraanModel->getKendaraanWithSatker();
                $kondisiCounts = [];

                if ($kendaraanWithSatker) {
                    foreach ($kendaraanWithSatker as $value) {
                        if (isset($value['nama_satker'], $value['roda'], $value['kondisi'])) {
                            $satker = $value['nama_satker'];
                            $roda = $value['roda'];
                            $kondisi = $value['kondisi'];

                            $kondisiCounts[$satker][$roda][$kondisi] = ($kondisiCounts[$satker][$roda][$kondisi] ?? 0) + 1;
                        }
                    }
                }

                // print_r($kondisiCounts);
                
                foreach ($kondisiCounts as $satker => $rodaData) {
                    echo '<tr>';
                    echo '<th colspan="4" style="text-align: center;" class="bg-primary">' . $satker . '</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th class="bg-warning">Kondisi</th>';
                    echo '<th class="bg-warning">Jumlah</th>';
                    echo '</tr>';
                    foreach ($rodaData as $roda => $kondisiData) {
                        echo '<tr>';
                        echo '<th colspan="2" class="table-secondary">' . $roda . '</th>';
                        echo '</tr>';
                        $totalKondisiRoda = 0; // Variabel untuk menyimpan total kondisi roda
                        foreach ($kondisiData as $kondisi => $count) {
                            echo '<tr>';
                            echo '<td>' . $kondisi . '</td>';
                            echo '<td>' . $count . '</td>';
                            echo '</tr>';
                            $totalKondisiRoda += $count; // Tambahkan jumlah kondisi roda
                        }
                        echo '<tr style="margin-bottom: 10px;">'; // Tambahkan jarak ke bawah
                        echo '<th>Total Semua Kondisi ' . $roda . '</th>';
                        echo '<th>' . $totalKondisiRoda . '</th>';
                        echo '</tr>';
                        echo '<tr style="height: 10px;"></tr>'; // Tambahkan jarak ke bawah
                    }
                    echo '<tr style="height: 10px;"></tr>'; // Tambahkan jarak ke bawah
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>