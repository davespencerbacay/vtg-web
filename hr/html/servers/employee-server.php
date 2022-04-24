<?php

include '../db.php';

function upload_image()
{
    if (isset($_FILES["user_image"])) {
        $extension = explode('.', $_FILES['user_image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = '../employee_upload/' . $new_name;
        move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
        return $new_name;
    }
}

if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'Add') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $extension_number = $_POST['extension_number'];
        $password = $_POST['password'];
        $account_id = $_POST['account_id'];
        $contact_number = $_POST['contact_number'];
        $randomNum = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 11);

        $addQuery = mysqli_query($db, "INSERT INTO employees (firstname, lastname, email, extension_number, password, account_id, employee_id, contact_number) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $extension_number . "', '" . $password . "', '" . $account_id . "', '" . $randomNum . "', '" . $contact_number . "')");

        if ($addQuery) {
            echo "Success";
        }
    }
    if ($_POST['operation'] == 'Edit') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $extension_number = $_POST['extension_number'];
        $password = $_POST['password'];
        $account_id = $_POST['account_id'];

        $editQuery = mysqli_query($db, "UPDATE employees SET firstname = '" . $firstname . "', lastname = '" . $lastname . "', email = '" . $email . "', extension_number = '" . $extension_number . "', password = '" . $password . "', account_id = '" . $account_id . "' WHERE employee_id = '" . $_POST['employee_id'] . "'");

        if ($editQuery) {
            echo "Success";
        }
    }

    if ($_POST['operation'] == 'Delete') {
        $id = $_POST['id'];

        $deleteQuery = mysqli_query($db, "DELETE FROM employees WHERE id = '" . $id . "'");

        if ($deleteQuery) {
            echo "Success";
        }
    }
}
