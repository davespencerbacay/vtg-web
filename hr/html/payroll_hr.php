<?php include 'db.php';
session_start();
$payrollQuery = mysqli_query($db, "SELECT employees.*, payslip.pay_run, payslip.start_pay_period, payslip.end_pay_period, payslip.payslip_id, payslip.id FROM payslip INNER JOIN employees ON payslip.employee_id = employees.employee_id");
$employees = mysqli_query($db, "SELECT * FROM employees WHERE type_id = '3'");

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">HR Payroll</span> </h4>

                        <div class="mb-2 text-right">
                            <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payslipModal">Generate Payslip</button>
                        </div>
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
                                            <th>Status</th>
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
                                                <td><span class="badge bg-label-warning me-1">Unseen</span></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="view_payslip.php?id=<?php echo $row['payslip_id'] ?>"> View Payslip</a>
                                                            <button class="dropdown-item" onclick="delete_payslip(<?php echo $row['id']; ?>)">Delete</button>
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

    <!-- Large Modal -->
    <div class="modal fade" id="payslipModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Generate Payslip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">Employee Name</label>
                            <select class="form-control" id="text_employee">
                                <option>-- -- --</option>
                                <?php while ($row = mysqli_fetch_array($employees)) { ?>
                                    <option value="<?php echo $row['employee_id']; ?>"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">Start Pay Period</label>
                            <input class="form-control" id="text_start" type="date" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">End Pay Period</label>
                            <input class="form-control" id="text_end" type="date" />
                        </div>
                    </div>
                    <div class="employee-info-container">
                        <div class="row">
                            <h5>Employee Information</h5>
                            <div class="col-md-12 mb-3">
                                <label for="nameLarge" class="form-label">Employee Name</label>
                                <p>
                                    <span id="text-firstname">-- -- --</span>
                                    <span id="text-lastname"></span>
                                </p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nameLarge" class="form-label">Deals</label>
                                <p>
                                    <span id="text-deal">-- -- --</span>
                                </p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Extension Number</label>
                                <p id="text-extension-number">-- -- --</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Account Name</label>
                                <p id="text-account">-- -- --</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Email</label>
                                <p id="text-email">-- -- --</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Contact Number</label>
                                <p id="text-phone-number">-- -- --</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">SSS</label>
                                <p id="text-sss">-- -- --</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Philhealth</label>
                                <p id="text-ph">-- -- --</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Pag-Ibig</label>
                                <p id="text-pi">-- -- --</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">TIN</label>
                                <p id="text-tin">-- -- --</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Employee Type</label>
                                <p id="text-employee-type">-- -- --</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Total Working Hours</label>
                                <p id="text-hours">--</p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Salary Per Hour</label>
                                <p>₱<span id="text-basic-pay">-- --</span></p>
                            </div>
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Net Pay <br /> (Salary per hour x 8H x 10D + deal)</label>
                                <p><b>₱<span id="text-net-pay">-- --</span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="text_employee_id" />
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="generate()">Generate Payslip</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script-tags.php'; ?>

    <script>
        $('#text_employee').change(function() {
            const employeeId = $(this).val();
            const operation = "Fetch";

            $.ajax({
                url: "servers/employee-server.php",
                method: "POST",
                data: {
                    employeeId,
                    operation: "Fetch"
                },
                dataType: "json",
                success: function(data) {
                    $('#text-firstname').text(data.firstname);
                    $('#text-lastname').text(data.lastname);
                    $('#text-extension-number').text(data.extension_number);
                    $('#text-email').text(data.email);
                    $('#text-phone-number').text(data.phone_number);
                    $('#text-sss').text(data.sss);
                    $('#text-ph').text(data.ph);
                    $('#text-pi').text(data.pi);
                    $('#text-tin').text(data.tin);
                    $('#text-employee-type').text(data.employee_type);
                    $('#text-account').text(data.account_name);
                    $('#text-basic-pay').text(data.basic_pay);
                    $('#text-net-pay').text(data.net_pay + " + " +
                        "₱" + data.dealEarned + " = " + "₱" + parseInt(data.dealEarned + data.net_pay));
                    $('#text-deal').text(data.deal);
                    $("#text_employee_id").val(employeeId)
                }
            })

        });

        function generate() {
            const operation = "Generate";
            let employee_id = $("#text_employee_id").val();
            let start = $("#text_start").val();
            let end = $("#text_end").val();
            $.ajax({
                url: "servers/employee-server.php",
                method: "POST",
                data: {
                    employee_id,
                    operation,
                    start,
                    end
                },
                success: function(data) {
                    if (data === "Success") {
                        window.location.replace("payroll_hr.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })

        };


        function delete_payslip(id) {
            $.ajax({
                url: "servers/payslip-server.php",
                method: "POST",
                data: {
                    id,
                    operation: "Delete"
                },
                success: function(data) {
                    if (data === "Success") {
                        alert("Payslip Deleted");
                        window.location.reload();
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>
</body>

</html>