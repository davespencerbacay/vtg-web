<?php include 'db.php';
session_start();
$accountQuery = mysqli_query($db, "SELECT * FROM accounts");
$payrollQuery = mysqli_query($db, "SELECT employees.*, payslip.pay_run, payslip.start_pay_period, payslip.end_pay_period, payslip.payslip_id, payslip.id FROM payslip INNER JOIN employees ON payslip.employee_id = employees.employee_id where employees.employee_id = '" . $_SESSION['employee_id'] . "'");
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <title>Payslip | VTG</title>
    <?php include 'title-tags.php'; ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include 'navbar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'top-nav.php'; ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> Basic Tables</h4> -->
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Payslip </span> </h4>

                        <ul class="nav nav-pills d-flex justify-content-center mb-3">
                            <li class="nav-item">
                                <a class="nav-link " href="account_information.php">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="deals.php"> Deals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="payslip.php"> Payslip</a>
                            </li>
                        </ul>
                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <div class="table-responsive text-nowrap" style="overflow: inherit !important;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Extension Number</th>
                                            <th>Account</th>
                                            <th>Pay Run</th>
                                            <th>Pay Period</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php while ($row = mysqli_fetch_array($payrollQuery)) {
                                        ?>
                                            <tr>
                                                <td><strong><?php echo $row['extension_number']; ?></strong></td>
                                                <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                                                <td><?php echo $row['pay_run']; ?></td>
                                                <td><?php echo date("F d, Y", strtotime($row['start_pay_period'])); ?> - <?php echo date("F d, Y", strtotime($row['end_pay_period'])); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="view_payslip.php?id=<?php echo $row['payslip_id'] ?>"> View Payslip</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/ Hoverable Table rows -->
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