<?php include 'db.php';
session_start();
$accountQuery = mysqli_query($db, "SELECT * FROM accounts");
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <title>Accounts | VTG</title>
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts </span> </h4>

                        <div class="mb-2 text-right">
                            <a class="btn btn-primary" href="account-form.php?mode=add">Add</a>
                        </div>
                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th>Descriptions</th>
                                            <th>Employees</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php while ($row = mysqli_fetch_array($accountQuery)) {
                                            $employeeQuery = mysqli_query($db, "SELECT * FROM employees WHERE account_id = '" . $row['account_id'] . "' ORDER BY id DESC LIMIT 4");
                                        ?>
                                            <tr>
                                                <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong><?php echo $row['name']; ?></strong></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td>
                                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                        <?php while ($row1 = mysqli_fetch_array($employeeQuery)) { ?>
                                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="<?php echo $row1['firstname'] . " " . $row1['lastname']; ?>">
                                                                <img src="../assets/img/avatars/<?php echo $row1['avatar']; ?>" alt="Avatar" class="rounded-circle" />
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['status'] == 1) {
                                                        echo '<span class="badge bg-label-success me-1">Active</span>';
                                                    } else {
                                                        echo '<span class="badge bg-label-danger me-1">Inactive</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="account-form.php?mode=edit&account_id=<?php echo $row['account_id']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="deleteDeal(<?php echo $row['id']; ?>)"><i class="bx bx-trash me-1"></i> Delete</a>
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