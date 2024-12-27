<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>layout/dpal" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <h4>Data Kendaraan</h4>

        <!-- Alert and Table for Data Keseluruhan -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Keseluruhan</b></h6>
            <table>
                <thead>
                    <tr>
                        <th class="bg-danger">Kondisi</th>
                        <th class="bg-danger">Jumlah</th>
                        <th class="bg-danger">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    use App\Models\KendaraanModel;

                    $kendaraanModel = new KendaraanModel();
                    $kendaraanWithSatker = $kendaraanModel->getKendaraanWithSatker();  // Fetch data including Satker information

                    $kondisiCounts = [];
                    $detailData = [];
                    $totalKondisi = 0;

                    // Loop through the kendaraan data and group by kondisi
                    foreach ($kendaraanWithSatker as $value) {
                        $kondisi = htmlspecialchars($value['kondisi']);
                        if (!isset($kondisiCounts[$kondisi])) {
                            $kondisiCounts[$kondisi] = 0;
                            $detailData[$kondisi] = [];
                        }
                        $kondisiCounts[$kondisi]++;
                        $totalKondisi++;
                        $detailData[$kondisi][] = [
                            'nama_satker' => htmlspecialchars($value['nama_satker'] ?? 'N/A'),
                            'merk' => htmlspecialchars($value['merk'] ?? 'N/A'),
                            'nopol' => htmlspecialchars($value['nopol'] ?? 'N/A')
                        ];
                    }

                    foreach ($kondisiCounts as $kondisi => $count) {
                        echo '<tr>';
                        echo '<td>' . $kondisi . '</td>';
                        echo '<td>' . $count . '</td>';
                        echo '<td><button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="loadDetails(\'' . htmlspecialchars(json_encode($detailData[$kondisi])) . '\', \'' . $kondisi . '\')">Detail</button></td>';
                        echo '</tr>';
                    }
                    ?>
                    <tr>
                        <th><b>Total Kendaraan</b></th>
                        <th colspan="2" style="text-align: left;"><b><?= $totalKondisi; ?></b></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal for Details -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Kendaraan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="modalKondisi"></h6>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Satker</th>
                                    <th>Merk</th>
                                    <th>Nopol</th>
                                </tr>
                            </thead>
                            <tbody id="detailTableBody">
                                <!-- Details will be dynamically loaded here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function loadDetails(details, kondisi) {
                const data = JSON.parse(details);
                const tableBody = document.getElementById('detailTableBody');
                const modalKondisi = document.getElementById('modalKondisi');

                // Set modal title
                modalKondisi.textContent = `Kondisi: ${kondisi}`;

                // Clear existing table rows
                tableBody.innerHTML = '';

                // Populate table with new rows
                data.forEach((item, index) => {
                    const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nama_satker}</td>
                    <td>${item.merk}</td>
                    <td>${item.nopol}</td>
                </tr>`;
                    tableBody.innerHTML += row;
                });
            }
        </script>
        <!-- Data ALL Section -->
        <div class="alert alert-danger" role="alert">
            <h6><b>Data Satker</b></h6>
            <a href="<?= base_url(); ?>kendaraan/data" class="btn btn-info">Cari Data</a><br><br>
            <input type="text" id="searchSatkerInput" onkeyup="searchSatker()" placeholder="Cari Satker..." class="form-control mb-2">

            <table id="satkerTable">
                <tr>
                    <th class="bg-danger">No</th>
                    <th class="bg-danger">Satker</th>
                    <th class="bg-danger">R2</th>
                    <th class="bg-danger">R4</th>
                    <th class="bg-danger">R6</th>
                    <th class="bg-danger">Jumlah</th>
                    <th class="bg-danger">Detail</th>
                </tr>

                <?php


                $satkerCounts = [];
                $nomor = 1; // Variabel untuk nomor urut

                if ($kendaraanWithSatker) {
                    foreach ($kendaraanWithSatker as $value) {
                        if (isset($value['nama_satker'], $value['roda'], $value['kondisi'], $value['merk'], $value['nopol'])) {
                            $satker = $value['nama_satker'];
                            $roda = $value['roda'];
                            $kondisi = $value['kondisi'];
                            $merk = $value['merk']; // Ambil merk kendaraan
                            $nopol = $value['nopol']; // Ambil nopol kendaraan

                            $satkerCounts[$satker][$roda][$kondisi][] = ['merk' => $merk, 'nopol' => $nopol, 'kondisi' => $kondisi]; // Simpan merk, nopol dan kondisi
                        }
                    }

                    foreach ($satkerCounts as $satker => $rodaData) {
                        $countR2 = isset($rodaData['R2']) ? array_sum(array_map(function ($item) {
                            return count($item);
                        }, $rodaData['R2'])) : 0;
                        $countR4 = isset($rodaData['R4']) ? array_sum(array_map(function ($item) {
                            return count($item);
                        }, $rodaData['R4'])) : 0;
                        $countR6 = isset($rodaData['R6']) ? array_sum(array_map(function ($item) {
                            return count($item);
                        }, $rodaData['R6'])) : 0;
                        $total = $countR2 + $countR4 + $countR6;

                        echo '<tr class="searchSatkerInput">';
                        echo '<td>' . $nomor++ . '</td>'; // Menampilkan nomor urut
                        echo '<td>' . htmlspecialchars($satker) . '</td>';
                        echo '<td>' . $countR2 . '</td>';
                        echo '<td>' . $countR4 . '</td>';
                        echo '<td>' . $countR6 . '</td>';
                        echo '<td>' . $total . '</td>';
                        echo '<td><button onclick="showPopup(\'' . htmlspecialchars(json_encode($satkerCounts[$satker])) . '\', \'' . htmlspecialchars($satker) . '\')" class="btn btn-info btn-sm">Detail</button></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>



<!-- Popup Container -->
<div id="popup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 1000;">
    <div style="background-color: white; padding: 20px; max-width: 800px; margin: 10% auto; border-radius: 10px; max-height: 80%; overflow: hidden;">
        <button onclick="closePopup()" style="float: right; background: none; border: none; font-size: 20px;">&times;</button>
        <div id="popupContent" style="max-height: 70vh; overflow-y: auto; overflow-x: auto;">
            <!-- Content will be dynamically inserted here -->
        </div>
    </div>
</div>

<script>
    // Function to show popup with specific satker data
    // Function to show popup with specific satker data
    function showPopup(satkerData, namaSatker) {
        var satkerDetails = JSON.parse(satkerData);
        var content = '<h3>' + namaSatker + '</h3>'; // Menambahkan nama satker di judul

        // Iterate through satkerDetails to show roda (R2, R4, R6) tables
        for (var roda in satkerDetails) {
            content += '<h4>Roda ' + roda + '</h4>'; // Display Roda type (R2, R4, R6)

            // Prepare a count of conditions (Baik, Rusak Ringan, Rusak Berat) for each roda
            var kondisiCounts = {
                'Baik': 0,
                'Rusak Ringan': 0,
                'Rusak Berat': 0
            };

            // Add table header for this roda

            content += '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
            content += '<thead><tr><th>No</th><th>Merk/Type</th><th>Nopol</th><th>Kondisi</th></tr></thead>';
            content += '<tbody>';

            // Iterate through each kondisi (Baik, Rusak Ringan, Rusak Berat) for the current roda
            var no = 1;
            for (var kondisi in satkerDetails[roda]) {
                var kendaraanList = satkerDetails[roda][kondisi];
                for (var i = 0; i < kendaraanList.length; i++) {
                    var kendaraan = kendaraanList[i];
                    content += '<tr>';
                    content += '<td>' + no++ + '</td>';
                    content += '<td>' + kendaraan.merk + '</td>'; // Display merk
                    content += '<td>' + kendaraan.nopol + '</td>'; // Display nopol
                    content += '<td>' + kendaraan.kondisi + '</td>'; // Display kondisi
                    content += '</tr>';

                    // Increment the count for each kondisi
                    if (kondisi === 'Baik') {
                        kondisiCounts['Baik']++;
                    } else if (kondisi === 'Rusak Ringan') {
                        kondisiCounts['Rusak Ringan']++;
                    } else if (kondisi === 'Rusak Berat') {
                        kondisiCounts['Rusak Berat']++;
                    }
                }
            }

            content += '</tbody></table>';

            // Add a row with the total count for each condition (Baik, Rusak Ringan, Rusak Berat)
            content += '<br>'; // Add 1 blank line
            content += '<table style="width: 100%;">';
            content += '<tr><td><b>Jumlah Baik</b></td><td>' + kondisiCounts['Baik'] + '</td></tr>';
            content += '<tr><td><b>Jumlah Rusak Ringan</b></td><td>' + kondisiCounts['Rusak Ringan'] + '</td></tr>';
            content += '<tr><td><b>Jumlah Rusak Berat</b></td><td>' + kondisiCounts['Rusak Berat'] + '</td></tr>';
            content += '</table>';

        }

        document.getElementById('popupContent').innerHTML = content;
        document.getElementById('popup').style.display = 'block';
    }


    // Function to close popup
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    // Function to filter satker based on search input
    // Function to filter satker based on search input
    function searchSatker() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('searchSatkerInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('satkerTable');
        tr = table.getElementsByTagName('tr');

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName('td')[1]; // Index 1 is for Satker column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

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



    /* CSS untuk overflow */
    .overflow {
        overflow: auto;
    }

    .overflow-x {
        overflow-x: auto;
    }

    .overflow-y {
        overflow-y: auto;
    }

    #popupContent {
        max-height: 70vh;
        /* Batas maksimal tinggi 70% dari tampilan layar */
        max-width: 100%;
        /* Pastikan konten tidak melebihi lebar 100% */
        overflow-y: auto;
        /* Scroll vertikal jika konten lebih tinggi */
        overflow-x: auto;
        /* Scroll horizontal jika konten lebih lebar */
    }
</style>


<?= $this->endSection(); ?>