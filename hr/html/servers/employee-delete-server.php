<?php

include '../db.php';

$extension_number = $_GET['extension_number'];
$deleteQuery = mysqli_query($db, "DELETE FROM employees WHERE extension_number = '" . $extension_number . "'");
