<?php include 'db.php';
session_start();
$accountQuery = mysqli_query($db, "SELECT * FROM accounts");
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
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Cutoff</th>
                                            <th>Work Days</th>
                                            <th>Absents</th>
                                            <th>Total Hours</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php while ($row = mysqli_fetch_array($accountQuery)) {
                                            $employeeQuery = mysqli_query($db, "SELECT * FROM employees WHERE account_id = '" . $row['account_id'] . "' ORDER BY id DESC LIMIT 4");
                                        ?>
                                            <tr>
                                                <td><strong><?php echo date("Y-m-d"); ?></strong></td>
                                                <td><?php echo date("M d, Y"); ?> — <?php echo date("M d, Y"); ?></td>
                                                <td>20 days</td>
                                                <td>0 days</td>
                                                <td>20 Hours</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="account-form.php?mode=edit&account_id=<?php echo $row['account_id']; ?>"><i class="bx bx-edit-alt me-1"></i> View</a>
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

    <script>
        function deleteDeal(id) {
            $.ajax({
                url: "servers/account-server.php",
                method: "POST",
                data: {
                    id,
                    operation: "Delete"
                },
                success: function(data) {
                    if (data === "Success") {
                        window.location.replace("accounts.php");
                    } else {
                        swal("INVALID!", "Error", "error");
                    }
                }
            })
        }
    </script>
</body>

</html>