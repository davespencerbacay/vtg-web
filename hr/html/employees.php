<?php include 'db.php';
session_start();
include 'account_verification.php';
$employeeQuery = mysqli_query($db, "SELECT * FROM employees INNER JOIN accounts ON accounts.account_id = employees.account_id");
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employees </span> </h4>

                        <div class="mb-2 text-right">
                            <a class="btn btn-primary" href="employees-form.php?mode=add">Add</a>
                        </div>
                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Extension Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php while ($row = mysqli_fetch_array($employeeQuery)) {
                                        ?>
                                            <tr>
                                                <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong><?php echo $row['name']; ?></strong></td>
                                                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['contact_number']; ?></td>
                                                <td><?php echo $row['extension_number']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="employees-form.php?mode=edit&employee_id=<?php echo $row['employee_id']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                            <button class="dropdown-item" onclick="delete_employee(<?php echo $row['extension_number']; ?>)"><i class="bx bx-trash me-1"></i> Delete</button>
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
        function delete_employee(id) {
            var employee_id = id;
            $.ajax({
                url: "servers/employee-server.php",
                method: "POST",
                data: {
                    id,
                    operation: "Delete"
                },
                success: function(data) {
                    if (data === "Success") {
                        alert("Employee Deleted");
                        window.location.replace("employees.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>
</body>

</html>