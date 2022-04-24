<?php

include '../db.php';
session_start();
$extensionNumber = $_POST['extensionNumber'];
$password = $_POST['password'];


$query = mysqli_query($db, "SELECT * FROM employees WHERE extension_number = '" . $extensionNumber . "' AND password = '" . $password . "'");
$countQuery = mysqli_num_rows($query);
$row = mysqli_fetch_array($query);

if ($countQuery >= 1) {
    $_SESSION["employee_id"] = $row['employee_id'];
    echo "Success";
} else {
    echo "Error";
}
