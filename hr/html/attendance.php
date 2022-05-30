<?php include 'db.php';
session_start();
error_reporting(0);
$attendanceQuery = mysqli_query($db, "SELECT * FROM attendance INNER JOIN employees ON attendance.employee_id = employees.employee_id WHERE employees.employee_id = '" . $_SESSION["employee_id"] . "'");

$dateToday = date("Y-m-d");
$attendanceToday = mysqli_query($db, "SELECT * FROM attendance WHERE date = '" . $dateToday . "' AND employee_id = '" . $_SESSION['employee_id'] . "'");
$attendanceRow = mysqli_fetch_array($attendanceToday);
$attendanceDate = isset($attendanceRow['date']) ? $attendanceRow['date'] : "";
$countRow = mysqli_num_rows($attendanceToday);
$dateToday = date("Y-m-d");

if ($countRow >= 1 && $attendanceDate == $dateToday) {
    $timeInIsDisabled = "disabled";
} else {
    $timeInIsDisabled = "";
}

if ($attendanceRow['time_out'] != "00:00:00") {
    $timeOutIsDisabled = "disabled";
} else {
    $timeOutIsDisabled = "";
}


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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Attendance</span> </h4>

                        <?php if ($employee_type == 3) { ?>
                            <div class="mb-2 text-right">
                                <button class="btn btn-primary" type="button" href="account-form.php?mode=add" <?php echo $timeInIsDisabled ?> onclick="timeIn()">Time In</button>
                                <button class="btn btn-primary" type="button" href="account-form.php?mode=add" <?php echo $timeOutIsDisabled ?> onclick="timeOut()">Time Out</button>
                                <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">Request to modify</button>
                            </div>
                        <?php } ?>
                        <!-- Hoverable Table rows -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Extension Number</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Total Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php while ($row = mysqli_fetch_array($attendanceQuery)) {


                                            if ($row['time_out'] == "00:00:00") {
                                                $time_out = "-- : -- : --";
                                                $hours = 0;
                                            } else {
                                                $time_out = $row['time_out'];
                                                $total      = strtotime($row['time_out']) - strtotime($row['time_in']);
                                                $hours      = floor($total / 60 / 60);
                                            }
                                        ?>
                                            <tr>
                                                <td><strong><?php echo $row['extension_number']; ?></strong></td>
                                                <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['time_in']; ?></td>
                                                <td><?php echo $time_out; ?></td>
                                                <td><?php echo $hours; ?></td>
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
                        <div class="col-md-12 mb-0">
                            <label for="text_date" class="form-label">Date</label>
                            <input type="date" id="text_date" class="form-control" placeholder="xxxx@xxx.xx" />
                        </div>
                        <div class="col mb-0">
                            <label for="text_in" class="form-label">Time In</label>
                            <input type="time" id="text_in" class="form-control" placeholder="xxxx@xxx.xx" />
                        </div>
                        <div class="col mb-0">
                            <label for="text_out" class="form-label">Time Out</label>
                            <input type="time" id="text_out" class="form-control" placeholder="DD / MM / YY" />
                        </div>
                        <div class="col-md-12 mb-0">
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
            var date = $("#text_date").val();
            var timeIn = $("#text_in").val();
            var timeOut = $("#text_out").val();
            var reason = $("#text_reason").val();
            var operation = "Add";

            $.ajax({
                url: "servers/attendance-server.php",
                method: "POST",
                data: {
                    date,
                    timeIn,
                    timeOut,
                    reason,
                    operation
                },
                success: function(data) {
                    if (data == "Success") {
                        alert("Request Submitted");
                        window.location.replace("attendance.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }

        function timeIn() {
            var operation = "TIME_IN";

            $.ajax({
                url: "servers/attendance-server.php",
                method: "POST",
                data: {
                    operation
                },
                success: function(data) {
                    if (data === "Success") {
                        alert("Timein Submitted");
                        window.location.replace("attendance.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }

        function timeOut() {
            var operation = "TIME_OUT";

            $.ajax({
                url: "servers/attendance-server.php",
                method: "POST",
                data: {
                    operation
                },
                success: function(data) {
                    if (data === "Success") {
                        alert("Timein Submitted");
                        window.location.replace("attendance.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>
</body>

</html>