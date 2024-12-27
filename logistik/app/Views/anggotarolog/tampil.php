<?= $this->extend('layout/tampil'); ?>
<?= $this->section('isi'); ?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="<?= base_url(); ?>" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="alert alert-danger" role="alert">
            <h4><b>Data Personel</b></h4><br>
            <h6><b>Jumlah Anggota Biro Logistik: <?= count($anggotarolog); ?></b></h6><br>

            <style>
               table {
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
    table-layout: auto; /* Auto layout based on content width */
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    white-space: nowrap; /* Prevent text wrapping to the next line */
    overflow: hidden;
    text-overflow: ellipsis; /* Truncate overflowing text */
}

/* Adjust specific column widths (optional) */
th:nth-child(1), td:nth-child(1) {
    width: 5%; /* Adjust column width for "No." */
}

th:nth-child(2), td:nth-child(2) {
    width: 30%; /* Adjust column width for "Nama" */
}

th:nth-child(3), td:nth-child(3) {
    width: 20%; /* Adjust column width for "Pangkat/NRP" */
}

th:nth-child(4), td:nth-child(4) {
    width: 30%; /* Adjust column width for "Jabatan" */
}

th:nth-child(5), td:nth-child(5) {
    width: 15%; /* Adjust column width for "Detail" */
}

th {
    background-color: #f0f0f0;
}

/* Optional: styling for bg-danger, expired, etc. */
.bg-danger {
    background-color: #dc3545;
    color: white;
}

.expired {
    background-color: red !important;
    color: white;
}

.expiring-soon {
    background-color: #fff3cd !important;
    color: #856404;
}

.modal-body {
    max-height: 400px;
    overflow-y: auto;
}

/* Table responsiveness */
.table-responsive {
    -webkit-overflow-scrolling: touch;
    overflow-x: auto; /* Horizontal scrolling for small screens */
    -ms-overflow-style: scrollbar;
}

/* Media query for smaller devices */
@media (max-width: 767px) {
    table {
        font-size: 10px; /* Adjust font size for smaller screens */
    }

    th, td {
        padding: 6px; /* Reduce padding for smaller screens */
    }

    /* Adjust column widths on smaller screens */
    th:nth-child(1), td:nth-child(1) {
        width: 10%; /* No. column adjusts for small screens */
    }
    
    th:nth-child(2), td:nth-child(2) {
        width: 30%; /* Nama column adjusts for small screens */
    }

    th:nth-child(3), td:nth-child(3) {
        width: 20%; /* Pangkat/NRP column adjusts for small screens */
    }

    th:nth-child(4), td:nth-child(4) {
        width: 30%; /* Jabatan column adjusts for small screens */
    }

    th:nth-child(5), td:nth-child(5) {
        width: 20%; /* Detail column adjusts for small screens */
    }
}


            </style>

            <?php
            // Custom order for bags (optional sorting based on your specific needs)
            $customOrder = [
                'KAROLOG' => 1,
                'SUBBAG RENMIN' => 2,
                'BAG FASKON' => 3,
                'BAG PAL' => 4,
                'BAG INFOLOG' => 5,
                'BAG ADA' => 6,
                'BAG BEKUM' => 7,
                'URGUDANG' => 8
            ];

            // Sort the $anggotarolog array by 'level' in ascending order
            usort($anggotarolog, function($a, $b) {
                $levelA = (int) ($a['level'] ?? 0);
                $levelB = (int) ($b['level'] ?? 0);
                return $levelA - $levelB;
            });

            // Grouping data by 'bag'
            $groupedByBag = [];
            foreach ($anggotarolog as $value) {
                $bag = $value['bag'] ?? 'Tidak Diketahui';
                $groupedByBag[$bag][] = $value;
            }

            // Sorting the groups based on custom order
            uksort($groupedByBag, function($a, $b) use ($customOrder) {
                return ($customOrder[$a] ?? PHP_INT_MAX) - ($customOrder[$b] ?? PHP_INT_MAX);
            });

            // Display grouped data
            foreach ($groupedByBag as $bag => $data) : ?>
                <h6><b><?= htmlspecialchars($bag); ?></b></h6>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Pangkat/NRP</th>
                                <th>Jabatan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $index => $value) : ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= htmlspecialchars($value['nama'] ?? 'Tidak Diketahui'); ?></td>
                                    <td><?= htmlspecialchars(($value['pangkat'] ?? 'Tidak Diketahui') . ' / ' . ($value['nrp'] ?? 'Tidak Diketahui')); ?></td>
                                    <td><?= htmlspecialchars($value['jabatan'] ?? 'Tidak Diketahui'); ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($value)); ?>)">Detail</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><br>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Personel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                        <!-- Photo Section -->
                        <img id="fotoPreview" src="" alt="Foto Personel" class="img-fluid" style="width: 50%; height: 95%; object-fit: cover; border-radius: 15px;" />
                    </div>
                    <div class="col-12 col-md-8">
                        <!-- Information Section -->
                        <table style="width: 100%; table-layout: fixed;">
                            <tbody>
                                <tr>
                                    <th style="word-wrap: break-word; width: 10%;">Nama</th>
                                    <td id="detailNama" style="word-wrap: break-word;">Tidak Diketahui</td>
                                </tr>
                                <tr>
                                    <th style="word-wrap: break-word;">Pangkat/NRP</th>
                                    <td id="detailPangkat" style="word-wrap: break-word;">Tidak Diketahui</td>
                                </tr>
                                <tr>
                                    <th style="word-wrap: break-word;">Jabatan</th>
                                    <td id="detailJabatan" style="word-wrap: break-word;">Tidak Diketahui</td>
                                </tr>
                                <tr>
                                    <th style="word-wrap: break-word;">Tanggal Lahir</th>
                                    <td id="detailTanggallahir" style="word-wrap: break-word;">Tidak Diketahui</td>
                                </tr>
                               <tr>
                                    <th style="word-wrap: break-word; white-space: normal;">Alamat</th>
                                    <td id="detailAlamat" style="word-wrap: break-word; white-space: normal;">Tidak Diketahui</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(data) {
        // Display personnel details in the modal
        document.getElementById('detailNama').innerText = data.nama ?? 'Tidak Diketahui';
        document.getElementById('detailPangkat').innerText = (data.pangkat ?? 'Tidak Diketahui') + ' / ' + (data.nrp ?? 'Tidak Diketahui');
        document.getElementById('detailJabatan').innerText = data.jabatan ?? 'Tidak Diketahui';

        // Format birth date
        let tanggalLahir = data.tanggallahir ?? 'Tidak Diketahui';
        if (tanggalLahir !== 'Tidak Diketahui') {
            let date = new Date(tanggalLahir);
            let options = { year: 'numeric', month: 'long', day: 'numeric' };
            tanggalLahir = date.toLocaleDateString('id-ID', options);  // Format for Indonesian
        }

        document.getElementById('detailTanggallahir').innerText = tanggalLahir;
        document.getElementById('detailAlamat').innerText = data.alamat ?? 'Tidak Diketahui';

        // Display photo
        const fotoPreview = document.getElementById('fotoPreview');
        const fotoPath = data.foto && data.foto !== ''
            ? '<?= base_url('uploads/'); ?>' + data.foto
            : '<?= base_url('uploads/default.jpg'); ?>'; // fallback to default if no photo

        fotoPreview.src = fotoPath;
        fotoPreview.style.display = 'block';

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('detailModal'));
        modal.show();
    }
</script>



<?= $this->endSection(); ?>
