<?php include 'db.php';
session_start();
include 'account_verification.php';
$employee_id = $_SESSION['employee_id'];
$employeeQuery = mysqli_query($db, "SELECT * FROM employees INNER JOIN accounts ON accounts.account_id = employees.account_id WHERE employee_id = '" . $employee_id . "'");
$row = mysqli_fetch_array($employeeQuery);
$account_name = $row['name'];

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Submit a Deal</h4>
                        <div class="card mb-4">
                            <h5 class="card-header">Deal Information</h5>
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Date</label>
                                    <input type="text" class="form-control" id="text_date" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo date("Y-m-d"); ?>" disabled />
                                </div>
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Account</label>
                                    <input type="text" class="form-control" id="text_date" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $account_name; ?>" disabled />
                                </div>
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Remarks | Comments</label>
                                    <textarea class="form-control" id="text_remarks"></textarea>
                                </div>
                                <input type="hidden" id="text_employeeid" value="<?php echo $employee_id; ?>" />
                                <button class="btn btn-primary w-100" onclick="addDeal()">SUBMIT A DEAL</button>
                            </div>
                        </div>
                        <!--/ Hoverable Table rows -->
                    </div>
                    <!-- / Content -->
                    <?php include 'footer.php'; ?>

                    <div class=" content-backdrop fade">
                    </div>
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

    <script type="text/javascript">
        function addDeal() {
            var remarks = $("#text_remarks").val();
            var operation = "Add";
            $.ajax({
                url: "servers/deal-server.php",
                method: "POST",
                data: {
                    remarks,
                    operation,
                },
                success: function(data) {
                    if (remarks == "") {
                        swal("INVALID!", "Fields are required.", "error")
                    } else {
                        if (data === "Success") {
                            window.location.replace("deals.php");
                        }
                    }
                }
            })
        }
    </script>
</body>

</html>