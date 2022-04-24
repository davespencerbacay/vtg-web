<?php include 'db.php';
session_start();
include 'account_verification.php';
$dealsQuery = mysqli_query($db, "SELECT deals.account_id, accounts.name, employees.firstname, employees.lastname, employees.extension_number, deals.status, deals.id, deals.remarks
FROM deals
INNER JOIN accounts on accounts.account_id = deals.account_id
INNER JOIN employees on employees.employee_id = deals.employee_id
GROUP BY deals.deal_id ORDER BY deals.id DESC");
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <title>Employees | VTG</title>
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
                        <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employees /</span> Basic Tables</h4> -->
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Deals </span> </h4>
                        <ul class="nav nav-pills d-flex justify-content-center mb-3">
                            <li class="nav-item">
                                <a class="nav-link " href="account_information.php"><i class="bx bx-user me-1"></i> Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="deals.php"> Deals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="payslip.php"> Payslip</a>
                            </li>
                        </ul>
                        <div class="mb-2 text-right">
                            <a class="btn btn-primary" href="deal-form.php">Add</a>
                        </div>
                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th>Name</th>
                                            <th>Extension Number</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php while ($row = mysqli_fetch_array($dealsQuery)) {
                                        ?>
                                            <tr>
                                                <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong><?php echo $row['name']; ?></strong></td>
                                                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                                <td><?php echo $row['extension_number']; ?></td>
                                                <td>
                                                    <?php if ($row['status'] == "0") {
                                                        echo '<span class="badge bg-label-warning me-1">Pending</span>';;
                                                    } elseif ($row['status'] == "2") {
                                                        echo '<span class="badge bg-label-danger me-1">Declined</span>';;
                                                    } else {
                                                        echo '<span class="badge bg-label-success me-1">Approved</span>';;
                                                    } ?>
                                                </td>
                                                <td><?php echo $row['remarks']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" onclick="editDeal(<?php echo $row['id']; ?>, 1)">Approve</a>
                                                            <a class="dropdown-item" onclick="editDeal(<?php echo $row['id']; ?>, 2)"> Decline</a>
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
        function editDeal(id, status) {
            $.ajax({
                url: "servers/deal-server.php",
                method: "POST",
                data: {
                    id,
                    status,
                    operation: "Edit"
                },
                success: function(data) {
                    if (data === "Success") {
                        window.location.replace("deals.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>
</body>

</html>