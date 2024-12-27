<?php $user = auth()->user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Biro Logistik Polda NTB</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="<?= base_url(); ?>assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="<?= base_url(); ?>/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["<?= base_url(); ?>/assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/plugins.min.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/kaiadmin.min.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="<?= base_url(); ?>" class="logo">
            <img src="<?= base_url(); ?>assets/img/kaiadmin/log.png" alt="navbar brand" class="navbar-brand"
              height="25" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dashboard">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url('/layout/dashboard'); ?>">
                      <span class="sub-item">Polda</span>
                    </a>
                  </li>
                   <li>
                    <a href="<?= base_url('/layout/dashboard1'); ?>">
                      <span class="sub-item">Jajaran</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Components</h4>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#renmin">
                <i class="fas fa-users" style="font-size: 20px;"></i> <!-- Ikon banyak pengguna -->
                <p>SUBBAGRENMIN</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="renmin">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>anggotarolog/index">
                      <span class="sub-item">Data Anggota</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#bagpal">
                <i class="fas fa-car" style="font-size: 20px;"></i> <!-- Ikon kendaraan -->
                <p>BAG PAL</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="bagpal">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>kendaraan/index">
                      <span class="sub-item">Kendaraan</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>alsus/index">
                      <span class="sub-item">Alsus</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>alsintor/index">
                      <span class="sub-item">Alsintor</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>alkes/index">
                      <span class="sub-item">Alkes</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>senpi/index">
                      <span class="sub-item">Senpi</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>pemegang/index">
                      <span class="sub-item">Pemegang Senpi</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>jenis/index">
                      <span class="sub-item">Jenis Senpi</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>merk/index">
                      <span class="sub-item">Merk Senpi</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#bagada">
                <i class="fas fa-balance-scale" style="font-size: 20px;"></i> <!-- Ikon neraca -->
                <p>BAG ADA</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="bagada">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>sertifikasi/index">
                      <span class="sub-item">Personil Bersertifikasi</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>pengadaan/index">
                      <span class="sub-item">Pengadaan</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#bagbekum">
                <i class="fas fa-tshirt" style="font-size: 20px;"></i> <!-- Ikon baju -->
                <p>BAG BEKUM</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="bagbekum">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>kapor/index">
                      <span class="sub-item">Kapor</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>bbm/index">
                      <span class="sub-item">Bbm</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#baginfo">
                <i><i class="fas fa-laptop-code" style="font-size: 20px;"></i></i> <!-- IT Icon (Laptop) -->
                <p>BAG INFO</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="baginfo">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>psp/index">
                      <span class="sub-item">Penetapan Status Pengguna</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#bagfaskon">
                <i><i class="fas fa-building" style="font-size: 20px;"></i></i> <!-- Building Icon -->
                <p>BAG FASKON</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="bagfaskon">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>tanah/index">
                      <span class="sub-item">Tanah</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>bangunan/index">
                      <span class="sub-item">Bangunan</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#gudang">
                <i><i class="fas fa-warehouse" style="font-size: 20px;"></i></i> <!-- Warehouse Icon -->
                <p>GUDANG</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="gudang">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>stok/index">
                      <span class="sub-item">Stock Amunisi</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>stokkapor/index">
                      <span class="sub-item">Stock Kaporlap</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#satker">
                <i><i class="fas fa-cogs" style="font-size: 20px;"></i></i> <!-- Component Icon (Gears) -->
                <p>COMPONEN</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="satker">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?>anggota/index">
                      <span class="sub-item">Data Users</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?>satker/index">
                      <span class="sub-item">Satker/Satwil</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="<?= base_url(); ?>/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">

                </div>
              </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                  aria-expanded="false" aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input type="text" placeholder="Search ..." class="form-control" />
                    </div>
                  </form>
                </ul>
              </li>


              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="fas fa-layer-group"></i>
                </a>
                <div class="dropdown-menu quick-actions animated fadeIn">
                  <div class="quick-actions-header">
                    <span class="title mb-1">Quick Actions</span>
                    <span class="subtitle op-7">Shortcuts</span>
                  </div>
                  <div class="quick-actions-scroll scrollbar-outer">
                    <div class="quick-actions-items">
                      <div class="row m-0">
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-danger rounded-circle">
                              <i class="far fa-calendar-alt"></i>
                            </div>
                            <span class="text">Calendar</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-warning rounded-circle">
                              <i class="fas fa-map"></i>
                            </div>
                            <span class="text">Maps</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-info rounded-circle">
                              <i class="fas fa-file-excel"></i>
                            </div>
                            <span class="text">Reports</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-success rounded-circle">
                              <i class="fas fa-envelope"></i>
                            </div>
                            <span class="text">Emails</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-primary rounded-circle">
                              <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <span class="text">Invoice</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-secondary rounded-circle">
                              <i class="fas fa-credit-card"></i>
                            </div>
                            <span class="text">Payments</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <div class="avatar-sm">
                    <img src="<?= base_url(); ?>/assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold"><?= esc($user->username); ?></span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img src="<?= base_url(); ?>/assets/img/profile.png" alt="image profile"
                            class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <span class="fw-bold"><?= esc($user->username); ?></span>
                          <p class="text-muted"><?= esc($user->email); ?></p>
                          <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <!-- <a class="dropdown-item" href="#">My Profile</a>
                      <a class="dropdown-item" href="#">My Balance</a>
                      <a class="dropdown-item" href="#">Inbox</a> -->
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Account Setting</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?= base_url('logout'); ?>">Logout</a>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <?= $this->renderSection('isi'); ?>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">

          <div class="copyright" style="text-align: center;">
            <?= date('Y'); ?>, Biro Logistik Polda NTB
          </div>

        </div>
      </footer>
    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
              <br />
              <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Navbar Header</h4>
            <div class="btnSwitch">
              <button type="button" class="changeTopBarColor" data-color="dark"></button>
              <button type="button" class="changeTopBarColor" data-color="blue"></button>
              <button type="button" class="changeTopBarColor" data-color="purple"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
              <button type="button" class="changeTopBarColor" data-color="green"></button>
              <button type="button" class="changeTopBarColor" data-color="orange"></button>
              <button type="button" class="changeTopBarColor" data-color="red"></button>
              <button type="button" class="selected changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
              <button type="button" class="changeTopBarColor" data-color="blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="purple2"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="green2"></button>
              <button type="button" class="changeTopBarColor" data-color="orange2"></button>
              <button type="button" class="changeTopBarColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Sidebar</h4>
            <div class="btnSwitch">
              <button type="button" class="changeSideBarColor" data-color="white"></button>
              <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
              <button type="button" class="changeSideBarColor" data-color="dark2"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="custom-toggle">
        <i class="icon-settings"></i>
      </div>
    </div>
    <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script src="<?= base_url(); ?>/assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="<?= base_url(); ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="<?= base_url(); ?>/assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="<?= base_url(); ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="<?= base_url(); ?>/assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="<?= base_url(); ?>/assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="<?= base_url(); ?>/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="<?= base_url(); ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="<?= base_url(); ?>/assets/js/kaiadmin.min.js"></script>


  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
</body>

</html>