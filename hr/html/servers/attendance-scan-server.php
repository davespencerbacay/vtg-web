<?php

include '../db.php';
session_start();
if (isset($_GET['operation'])) {
    if ($_GET['operation'] == 'IN_OUT') {
        $employee_id = $_GET['employee_id'];
        $current_time = date("h:i:s");
        $date = date("Y-m-d");

        $attendanceToday = mysqli_query($db, "SELECT * FROM attendance WHERE date = '" . $date . "' ");
        $attendanceRow = mysqli_fetch_array($attendanceToday);
        $attendanceDate = isset($attendanceRow['date']) ? $attendanceRow['date'] : "";

        $validateInQuery = mysqli_query($db, "SELECT * FROM attendance WHERE employee_id = '" . $employee_id . "' AND time_in != ''");
        $countInRow = mysqli_num_rows($validateInQuery);
        $validateOutQuery = mysqli_query($db, "SELECT * FROM attendance WHERE employee_id = '" . $employee_id . "' AND time_out != ''");
        $countOutRow = mysqli_num_rows($validateOutQuery);

        if ($countInRow >= 1 && $attendanceDate == $date || $countOutRow >= 1 && $countOutRow == $date) {
            header("Location: error_attendance.php");
        } else if ($validateInQuery === 0) {
            $inQuery = mysqli_query($db, "INSERT INTO attendance (employee_id, date, time_in) VALUES ('" . $employee_id . "', '" . $date . "', '" . $current_time . "')");
            header("Location: attendance_in.php");
        } else {
            $outQuery = mysqli_query($db, "UPDATE attendance SET time_out = '" . $current_time . "' WHERE employee_id = '" . $employee_id . "' AND date = '" . $date . "' ");
            header("Location: attendance_out.php");
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
