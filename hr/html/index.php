<?php
session_start();
include 'account_verification.php';
include 'db.php';
$accountQuery = mysqli_query($db, "SELECT * FROM accounts");

$topEmployeeQuery = mysqli_query($db, "SELECT * FROM employees INNER JOIN accounts ON accounts.account_id = employees.account_id");
$countTopEmployeeQuery = mysqli_num_rows($topEmployeeQuery);

$navQuery = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $_SESSION['employee_id'] . "'");
$rowNav = mysqli_fetch_array($navQuery);

// 1 Owner
// 2 HR
// 3 Employee

$employee_type = $rowNav['type_id'];

if ($employee_type == 2) {
  header("Location: attendance_hr.php");
}
if ($employee_type == 3) {
  header("Location: attendance.php");
}

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include 'navbar.php'; ?>

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <?php include 'top-nav.php'; ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Welcome Mark Louie! 🎉</h5>
                        <p class="mb-4">
                          Lorem ipsum dolor sit amet, consectetur adipiscinsasdasdg elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>

                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                  <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Employees</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Team Leaders</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Accounts</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Deals</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- Order Statistics -->
              <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                  <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                      <h5 class="m-0 me-2">Account Statistics</h5>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="d-flex flex-column align-items-center gap-1">
                        <h2 class="mb-2">1,000</h2>
                        <span>Total Deals</span>
                      </div>
                      <div id="orderStatisticsChart"></div>
                    </div>
                    <ul class="p-0 m-0">
                      <?php while ($row = mysqli_fetch_array($accountQuery)) { ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0"><?php echo $row['name']; ?></h6>
                              <small class="text-muted"><?php echo $row['description']; ?></small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">250</small>
                            </div>
                          </div>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              <!--/ Order Statistics -->

              <!-- Transactions -->
              <div class="col-md-6 col-lg-6 order-2 mb-4">
                <div class="card h-100">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Top 6 Employees (Deals)</h5>
                  </div>
                  <div class="card-body">
                    <ul class="p-0 m-0">
                      <?php while ($row = mysqli_fetch_array($topEmployeeQuery)) {
                        $deals = mysqli_query($db, "SELECT * FROM deals WHERE employee_id = '" . $row['employee_id'] . "'");
                        $countDeals = mysqli_num_rows($deals);
                      ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1"><?php echo $row['name']; ?></small>
                              <h6 class="mb-0"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0"><?php echo $countDeals ?> Deals</h6>
                            </div>
                          </div>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              <!--/ Transactions -->
            </div>
          </div>
          <!-- / Content -->

          <?php include 'footer.php'; ?>

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <?php include 'script-tags.php'; ?>
</body>

</html>