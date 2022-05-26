<?php

include '../db.php';

if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'Delete') {
        $id = $_POST['id'];

        $deleteQuery = mysqli_query($db, "DELETE FROM payslip WHERE id = '" . $id . "'");

        if ($deleteQuery) {
            echo "Success";
        }
    }
}
