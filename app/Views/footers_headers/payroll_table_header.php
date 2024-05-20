
<!DOCTYPE html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>TAMTECH</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective."
    />
    <meta name="author" content="phoenixcoded" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= base_url('logindes/images/tamtechlogo.png') ?>" type="image/x-icon" />

    <!-- [Page specific CSS] start -->
    <!-- data tables css -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/plugins/dataTables.bootstrap5.min.css')?>">
    <!-- [Page specific CSS] end -->
    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/tabler-icons.min.css')?>" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/feather.css')?>" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/fontawesome.css')?>" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/material.css')?>" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/style.css')?>" id="main-style-link" >
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/style-preset.css')?>" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <style>
        /* Custom CSS for AlertifyJS notifications */
        .ajs-message.ajs-success {
            background-color: rgba(38, 185, 154, 0.8); /* Success color with transparency */
            font-weight: bold; /* Bold text */
        }
    </style>
  </head>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.getElementById("sidebar");

      sidebar.addEventListener("mouseenter", function() {
        sidebar.classList.remove("pc-sidebar-hide");
      });

      sidebar.addEventListener("mouseleave", function() {
        sidebar.classList.add("pc-sidebar-hide");
      });
    });
  </script>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
 <nav class="pc-sidebar pc-trigger pc-sidebar-hide" id="sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a  class="b-brand text-primary">
        <img src="<?= base_url('template/accountability_header.png') ?>" alt="logo image" class="logo-lg"  style="width: 170px; height: 40px;"/>
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Navigation</label>
          <i class="ph-duotone ph-chart-pie"></i>
        </li>
        
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-user-circle"></i>
            </span>
            <span class="pc-mtext">Agents</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
          ></a>
          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="<?= base_url('payroll/agents')?>">Active</a></li>
            <li class="pc-item"><a class="pc-link" href="<?= base_url('agents/notActive')?>">Resigned/Terminated</a></li>
          </ul>
        </li>
        <li class="pc-item">
          <a href="<?= base_url('attendance/employee')?>" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-identification-card"></i>
            </span>
            <span class="pc-mtext">Attendance</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="<?= base_url('payroll/view')?>" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-database"></i>
            </span>
            <span class="pc-mtext">Payroll</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-textbox"></i>
            </span>
            <span class="pc-mtext">Payslips</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
          ></a>
          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="<?= base_url('payslip/list')?>">Payslip</a></li>
            <li class="pc-item"><a class="pc-link" href="<?= base_url('payslip/history')?>">Payslip History</a></li>
          </ul>
        </li>
        
         <li class="pc-item">
          <a href="<?= base_url('agent/payslips')?>" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-tabs"></i>
            </span>
            <span class="pc-mtext">Agent Payslips</span></a
          >
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->
 <!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="list-unstyled">
    <!-- ======= Menu collapse Icon ===== -->
    <li class="pc-h-item pc-sidebar-collapse">
      <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup">
      <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="dropdown pc-h-item d-inline-flex d-md-none">
      <a
        class="pc-head-link dropdown-toggle arrow-none m-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <i class="ph-duotone ph-magnifying-glass"></i>
      </a>
    </li>
    
  </ul>
</div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto">
  <ul class="list-unstyled">
    <li class="dropdown pc-h-item header-user-profile">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        data-bs-auto-close="outside"
        aria-expanded="false"
      >
        <img src="<?= base_url('payroll_template/tables/assets/images/user/avatar-2.jpg')?>" alt="user-image" class="user-avtar" />
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
        <!-- <div class="dropdown-header d-flex align-items-center justify-content-between">
          <h5 class="m-0">Profile</h5>
        </div> -->
        <div class="dropdown-body">
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
            <ul class="list-group list-group-flush w-100">
              <!-- <li class="list-group-item">
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0">
                    <img src="<?= base_url('payroll_template/tables/assets/images/user/avatar-2.jpg')?>" alt="user-image" class="wid-50 rounded-circle" />
                  </div>
                  <div class="flex-grow-1 mx-3">
                    <h5 class="mb-0">Carson Darrin</h5>
                    <a class="link-primary" href="mailto:carson.darrin@company.io">carson.darrin@company.io</a>
                  </div>
                  <span class="badge bg-primary">PRO</span>
                </div>
              </li>
              
              <li class="list-group-item">
                <a href="#" class="dropdown-item">
                  <span class="d-flex align-items-center">
                    <i class="ph-duotone ph-user-circle"></i>
                    <span>Edit profile</span>
                  </span>
                </a>
                
                <a href="#" class="dropdown-item">
                  <span class="d-flex align-items-center">
                    <i class="ph-duotone ph-gear-six"></i>
                    <span>Settings</span>
                  </span>
                </a>
              </li> -->
              <li class="list-group-item">
                <a href="<?php echo base_url('logout'); ?>" class="dropdown-item">
                  <span class="d-flex align-items-center">
                    <i class="ph-duotone ph-power"></i>
                    <span>Logout</span>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
 </div>
</header>
<!-- [ Header ] end -->