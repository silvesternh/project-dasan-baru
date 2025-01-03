<?= $this->extend('layout/index'); ?>
<?= $this->section('isi'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="container">
        <div class="page-inner">
          <div class="page-header">
            <h3 class="fw-bold mb-3">DATA MERK SENPI</h3>
            <ul class="breadcrumbs mb-3">
              <li class="separator">
                <i class="icon-arrow-right"></i>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <a href="<?= base_url(); ?>merk/create" class="btn btn-primary mr-2"><i class="fas fa-plus"></i>
                    Tambah Data</a>
                  <!-- <a href="<?= base_url(); ?>merk/impor" class="btn btn-danger ml-auto"><i class="fas fa-upload"></i></a> -->
                  <!-- <a href="<?= base_url(); ?>merk/export" class="btn btn-success ml-auto"><i class="fas fa-file-export"> Ekspor Data</i></a> -->
                  <a href="">.</a>
                  <!-- New Refresh Button -->
                  <a href="javascript:void(0);" class="btn btn-danger ml-3" onclick="window.location.reload();">
                    <i class="fas fa-sync-alt"></i>
                  </a>
                </div>
                <?php if (session()->getFlashdata('pesan')): ?>
                    <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                  <div class="table-responsive">
                    <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="dataTables_length" id="basic-datatables_length"><label>
                              <script>
                                $(document).ready(function () {
                                  $('#basic-datatables_length select').on('change', function () {
                                    var length = $(this).val();
                                    $('#basic-datatables').DataTable().page.len(length).draw();
                                  });
                                });
                              </script>
                              <link rel="stylesheet"
                                href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
                          </div>
                          <div class="col-sm-12 col-md-6">
                            <!-- <div id="basic-datatables_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatables"></label></div> -->
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <table id="basic-datatables" class="display table table-striped table-hover dataTable"
                              role="grid" aria-describedby="basic-datatables_info">
                              <thead>
                                <tr>
                                  <th>NO</th>
                                  <th style="width:30%">Merk Senpi</th>
                                  <th>AKSI</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($merk as $key => $value): ?>
                                    <tr>
                                      <td style="width: 10%;"><?= $key + 1 ?></td>
                                      <td style="width: 78%;"><?= $value['nama_merk'] ?></td>
                                      <td style="width: 80px;">
                                        <form action="<?= base_url('merk/edit/' . $value['id_merk']) ?>" method="post"
                                          style="display: inline-block;">
                                          <button type="submit" class="btn btn-sm btn-primary" style="padding: 8px 10px;">
                                            <i class="fas fa-edit"></i>
                                          </button>
                                        </form>
                                        <form action="<?= base_url('merk/delete/' . $value['id_merk']) ?>"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data merk ini?')"
                                          style="display: inline-block;">
                                          <button type="submit" class="btn btn-sm btn-danger" style="padding: 8px 10px;">
                                            <i class="fas fa-trash"></i>
                                          </button>
                                        </form>
                                      </td>
                                    </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-5">
                            <!-- <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div> -->
                          </div>
                          <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="basic-datatables_paginate">
                              <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                              <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                              <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
                              <script>
                                $(document).ready(function () {
                                  $('#basic-datatables').DataTable({
                                    "scrollX": true,
                                    "autoWidth": true,
                                    "language": {
                                      "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
                                    }
                                  });
                                });

                                $(document).ready(function () {
                                  $('#filter-form').submit(function (e) {
                                    e.preventDefault();
                                    var formData = $(this).serialize();
                                    $.ajax({
                                      type: 'POST',
                                      url: '<?= base_url('merk/filterData') ?>',
                                      data: formData,
                                      dataType: 'json',
                                      success: function (data) {
                                        $('#basic-datatables').DataTable().clear();
                                        $('#basic-datatables').DataTable().rows.add(data).draw();
                                      }
                                    });
                                  });
                                });
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection(); ?>