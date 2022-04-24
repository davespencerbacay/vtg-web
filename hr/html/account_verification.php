<?php

include 'db.php';

$employeeValidation = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $_SESSION['employee_id'] . "'");
$countQuery = mysqli_num_rows($employeeValidation);

if ($countQuery <= 0) {
    header("Location: login.php");
}
