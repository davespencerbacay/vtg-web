<?php

include '../db.php';

if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'Add') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $deal = $_POST['deal'];
        $randomNum = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 11);

        $addQuery = mysqli_query($db, "INSERT INTO accounts (account_id, name, description, status, has_deal) VALUES ('" . $randomNum . "', '" . $name . "', '" . $description . "', '" . $status . "', '" . $deal . "')");

        if ($addQuery) {
            echo "Success";
        }
    }
    if ($_POST['operation'] == 'Edit') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $deal = $_POST['deal'];

        $editQuery = mysqli_query($db, "UPDATE accounts SET name = '" . $name . "', description = '" . $description . "', status = '" . $status . "', has_deal = '" . $deal . "' WHERE account_id = '" . $_POST['account_id'] . "'");

        if ($editQuery) {
            echo "Success";
        }
    }

    if ($_POST['operation'] == 'Delete') {
        $id = $_POST['id'];

        $deleteQuery = mysqli_query($db, "DELETE FROM accounts WHERE id = '" . $id . "'");

        if ($deleteQuery) {
            echo "Success";
        }
    }
}
