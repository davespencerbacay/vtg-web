<?php

include '../db.php';
session_start();
if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'Add') {
        $employee_id = $_SESSION['employee_id'];
        $time_in = $_POST['timeIn'];
        $time_out = $_POST['timeOut'];
        $reason = $_POST['reason'];
        $date = $_POST['date'];

        $addQuery = mysqli_query($db, "INSERT INTO attendance_requests (employee_id, date, time_in, time_out, reason, status) VALUES ('" . $employee_id . "', '" . $date . "', '" . $time_in . "', '" . $time_out . "', '" . $reason . "', 0)");

        if ($addQuery) {
            echo "Success";
        }
    }


    if ($_POST['operation'] == 'Approval') {
        $attendance_id = $_POST['attendance_id'];

        $attendanceQuery = mysqli_query($db, "SELECT * FROM attendance_requests WHERE id = '" . $attendance_id . "'");
        $rowAttendance = mysqli_fetch_array($attendanceQuery);
        $employee_id = $rowAttendance['employee_id'];
        $time_in = $rowAttendance['time_in'];
        $time_out = $rowAttendance['time_out'];
        $date = $rowAttendance['date'];

        $activeAttendance = mysqli_query($db, "SELECT * FROM attendance WHERE date = '" . $date . "' ");
        $countActiveAttendance = mysqli_num_rows($activeAttendance);

        if ($countActiveAttendance >= 1) {
            $addQuery = mysqli_query($db, "UPDATE attendance SET time_in = '" . $time_in . "', time_out = '" . $time_out . "' WHERE employee_id = '" . $employee_id . "' AND date = '" . $date . "'");
            $updateQuery = mysqli_query($db, "UPDATE attendance_requests SET status = 1 WHERE id = '" . $attendance_id . "'");
        } else {
            $addQuery = mysqli_query($db, "INSERT INTO attendance (employee_id, date, time_in, time_out) VALUES ('" . $employee_id . "', '" . $date . "', '" . $time_in . "', '" . $time_out . "')");
        }

        if ($addQuery) {
            echo "Success";
        }
    }

    if ($_POST['operation'] == 'Declined') {
        $attendance_id = $_POST['attendance_id'];

        $updateQuery = mysqli_query($db, "UPDATE attendance_requests SET status = 2 WHERE id = '" . $attendance_id . "'");

        if ($updateQuery) {
            echo "Success";
        }
    }


    if ($_POST['operation'] == 'TIME_IN') {
        $employee_id = $_SESSION['employee_id'];
        $time_in = date("h:i:s");
        $date = date("Y-m-d");
        $addQuery = mysqli_query($db, "INSERT INTO attendance (employee_id, date, time_in) VALUES ('" . $employee_id . "', '" . $date . "', '" . $time_in . "')");

        if ($addQuery) {
            echo "Success";
        }
    }


    if ($_POST['operation'] == 'TIME_OUT') {
        $employee_id = $_SESSION['employee_id'];
        $time_out = date("h:i:s");
        $date = date("Y-m-d");
        $addQuery = mysqli_query($db, "UPDATE attendance SET time_out = '" . $time_out . "' WHERE employee_id = '" . $employee_id . "' AND date = '" . $date . "' ");

        if ($addQuery) {
            echo "Success";
        }
    }
}
