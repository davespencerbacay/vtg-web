<?php include 'db.php';
session_start();
$attendanceQuery = mysqli_query($db, "SELECT employees.extension_number, attendance_requests.id, attendance_requests.date, attendance_requests.time_in, attendance_requests.time_out, attendance_requests.reason,  attendance_requests.reason, attendance_requests.status, employees.firstname, employees.lastname, employees.employee_id FROM attendance_requests INNER JOIN employees ON attendance_requests.employee_id = employees.employee_id WHERE employees.employee_id = '" . $_SESSION["employee_id"] . "'");

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Attendance Requests</span> </h4>
                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <div class="table-responsive text-nowrap" style="overflow: inherit !important;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Extension Number</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Total Hours</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php while ($row = mysqli_fetch_array($attendanceQuery)) {
                                            $total      = strtotime($row['time_out']) - strtotime($row['time_in']);
                                            $hours      = floor($total / 60 / 60);

                                            if ($row['status'] == 1) {
                                                $status = '<span class="badge bg-label-success me-1">Approved</span>';
                                            } elseif ($row['status'] == 2) {
                                                $status = '<span class="badge bg-label-danger me-1">Declined</span>';
                                            } else {
                                                $status = '<span class="badge bg-label-warning me-1">Pending</span>';
                                            }
                                        ?>
                                            <tr>
                                                <td><strong><?php echo $row['extension_number']; ?></strong></td>
                                                <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['time_in']; ?></td>
                                                <td><?php echo $row['time_out']; ?></td>
                                                <td><?php echo $hours; ?></td>
                                                <td><?php echo $status; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item" onclick="approvedRequest(<?php echo $row['id']; ?>)"><i class="bx bx-edit-alt me-1"></i> Approved</button>
                                                            <button class="dropdown-item" onclick="declinedRequest(<?php echo $row['id']; ?>)"><i class="bx bx-edit-alt me-1"></i> Declined</button>
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

    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Request to modify</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="text_in" class="form-label">Time In</label>
                            <input type="datetime-local" id="text_in" class="form-control" placeholder="xxxx@xxx.xx" />
                        </div>
                        <div class="col mb-0">
                            <label for="text_out" class="form-label">Time Out</label>
                            <input type="datetime-local" id="text_out" class="form-control" placeholder="DD / MM / YY" />
                        </div>
                        <div class="col mb-0">
                            <label for="dobWithTitle" class="form-label">Reason</label>
                            <textarea class="form-control" id="text_reason"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="requestTimeInAndOut()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script-tags.php'; ?>
    <script type="text/javascript">
        function requestTimeInAndOut() {
            var timeIn = $("#text_in").val();
            var timeOut = $("#text_out").val();
            var reason = $("#text_reason").val();
            var operation = "Add";

            $.ajax({
                url: "servers/attendance-server.php",
                method: "POST",
                data: {
                    timeIn,
                    timeOut,
                    reason,
                    operation
                },
                success: function(data) {
                    if (data === "Success") {
                        alert("Request Submitted");
                        window.location.replace("attendance.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }

        function approvedRequest(attendance_id) {
            var operation = "Approval";

            $.ajax({
                url: "servers/attendance-server.php",
                method: "POST",
                data: {
                    attendance_id,
                    operation
                },
                success: function(data) {
                    if (data === "Success") {
                        alert("Request Submitted");
                        window.location.replace("attendance_requests.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }

        function declinedRequest(attendance_id) {
            var operation = "Declined";

            $.ajax({
                url: "servers/attendance-server.php",
                method: "POST",
                data: {
                    attendance_id,
                    operation
                },
                success: function(data) {
                    if (data === "Success") {
                        alert("Request Declined");
                        window.location.replace("attendance_requests.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>
</body>

</html>