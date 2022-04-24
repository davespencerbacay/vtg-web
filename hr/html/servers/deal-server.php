<?php

include '../db.php';
session_start();
if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'Add') {
        $employeeQuery = mysqli_query($db, "SELECT * FROM employees INNER JOIN accounts ON accounts.account_id = employees.account_id WHERE employee_id = '" . $_SESSION['employee_id'] . "'");
        $row = mysqli_fetch_array($employeeQuery);
        $account_id = $row['account_id'];
        $dateToday = date('Y-m-d');
        $randomNum = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 11);
        $remarks = $_POST['remarks'];

        $addQuery = mysqli_query($db, "INSERT INTO deals (date, deal_id, account_id, employee_id, remarks) VALUES ('" . $dateToday . "', '" . $randomNum . "', '" . $account_id . "', '" . $_SESSION['employee_id'] . "', '" . $remarks . "')");

        if ($addQuery) {
            echo "Success";
        }
    }
}
if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'Edit') {
        $employeeQuery = mysqli_query($db, "SELECT * FROM employees INNER JOIN accounts ON accounts.account_id = employees.account_id WHERE employee_id = '" . $_SESSION['employee_id'] . "'");


        $editQuery = mysqli_query($db, "UPDATE deals SET status = '" . $_POST['status'] . "' WHERE id = '" . $_POST['id'] . "'");

        if ($editQuery) {
            echo "Success";
        }
    }
}
