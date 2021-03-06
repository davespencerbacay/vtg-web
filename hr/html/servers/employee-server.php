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
        $salary = $_POST['salary'];
        $randomNum = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 11);

        $addQuery = mysqli_query($db, "INSERT INTO employees (firstname, lastname, email, extension_number, password, account_id, employee_id, contact_number, type_id, avatar, salary) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $extension_number . "', '" . $password . "', '" . $account_id . "', '" . $randomNum . "', '" . $contact_number . "', '3', '1.png', '" . $salary . "')");

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
        $salary = $_POST['salary'];

        $editQuery = mysqli_query($db, "UPDATE employees SET firstname = '" . $firstname . "', lastname = '" . $lastname . "', email = '" . $email . "', extension_number = '" . $extension_number . "', password = '" . $password . "', account_id = '" . $account_id . "', salary = '" . $salary . "' WHERE employee_id = '" . $_POST['employee_id'] . "'");

        if ($editQuery) {
            echo "Success";
        }
    }

    if ($_POST['operation'] == 'Delete') {
        $id = $_POST['id'];

        $deleteQuery = mysqli_query($db, "DELETE FROM employees WHERE extension_number = '" . $id . "'");

        if ($deleteQuery) {
            echo "Success";
        }
    }

    if ($_POST['operation'] == 'Fetch') {
        $employee_id = $_POST['employeeId'];

        $output = array();
        $fetchQuery = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $employee_id . "' ORDER BY id DESC LIMIT 1");
        $fetchQuery1 = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $employee_id . "' ORDER BY id DESC LIMIT 1");
        $row1 = mysqli_fetch_array($fetchQuery1);

        $accountQuery = mysqli_query($db, "SELECT * FROM accounts WHERE account_id = '" . $row1['account_id'] . "'");
        $accountRow = mysqli_fetch_array($accountQuery);
        $account_name = $accountRow['name'];

        $dealQuery = mysqli_query($db, "SELECT * FROM deals WHERE employee_id = '" . $row1['employee_id'] . "' and status = 1");
        $countDeal = mysqli_num_rows($dealQuery);

        while ($row = mysqli_fetch_array($fetchQuery)) {
            //Newbie = 62.5
            //Rookie = 78
            //Tenured = 82
            //OIC = 90

            // !! Newbie
            // 62.5 Hourly
            // 500 Daily
            // 2,500 Weekly
            // 10,000 Monthly

            // !! Rookie
            // 78 Hourly
            // 624 Daily
            // 3,120 Weekly
            // 12,480 Monthly

            // !! Tenured
            // 82 Hourly
            // 656 Daily
            // 3,280 Weekly
            // 13,120

            // !! OIC
            // 90 Hourly
            // 720 Daily
            // 3,600 Weekly
            // 14,400 Monthly

            $days = 10;

            $selectCountHoursPayed = mysqli_query($db, "SELECT SUM(TIMESTAMPDIFF(HOUR, time_in, time_out)) 
                    as `SUM_HOURS`  FROM `attendance` WHERE date BETWEEN '2022-05-16' AND  '2022-05-31' AND employee_id = 'dmi1rle2y5j' ORDER BY `attendance`.`date` DESC");
            $rowCountHours = mysqli_fetch_array($selectCountHoursPayed);
            $hours_per_day = $rowCountHours['SUM_HOURS'];

            if ($row['salary'] == "62.5") {
                $output["employee_type"] = "Newbie Employee";
            } elseif ($row['salary'] == "78") {
                $output["employee_type"] = "Rookie Employee";
            } elseif ($row['salary'] == "82") {
                $output["employee_type"] = "Tenured Employee";
            } else {
                $output["employee_type"] = "Officer In Charge";
            }

            if ($countDeal >= 14) {
                $dealEarned = 1500;
            } else {
                $dealEarned = $countDeal * 25;
            }
            $output["firstname"] = $row["firstname"];
            $output["lastname"] = $row["lastname"];
            $output["email"] = $row["email"];
            $output["phone_number"] = $row["contact_number"];
            $output["extension_number"] = $row["extension_number"];
            $output["tin"] = $row["tin"];
            $output["ph"] = $row["philhealth"];
            $output["sss"] = $row["sss"];
            $output["pi"] = $row["pag_ibig"];
            $output["basic_pay"] = $row["salary"];
            $output["net_pay"] = $row["salary"] * $hours_per_day * $days;
            $output["account_name"] = $account_name;
            $output["deal"] = $countDeal;
            $output["dealEarned"] = $dealEarned;
            $output["totalHours"] = $hours_per_day;
        }
        echo json_encode($output);
    }

    if ($_POST['operation'] == "Generate") {
        $employee_id = $_POST['employee_id'];
        $randomNum = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 11);
        $fetchQuery = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $employee_id . "' ORDER BY id DESC LIMIT 1");
        $fetchQuery1 = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $employee_id . "' ORDER BY id DESC LIMIT 1");
        $row1 = mysqli_fetch_array($fetchQuery1);

        $accountQuery = mysqli_query($db, "SELECT * FROM accounts WHERE account_id = '" . $row1['account_id'] . "'");
        $accountRow = mysqli_fetch_array($accountQuery);
        $account_name = $accountRow['name'];
        $account_id = $accountRow['account_id'];

        $dealQuery = mysqli_query($db, "SELECT * FROM deals WHERE employee_id = '" . $row1['employee_id'] . "' and status = 1");
        $countDeal = mysqli_num_rows($dealQuery);

        $selectCountHoursPayed = mysqli_query($db, "SELECT SUM(TIMESTAMPDIFF(HOUR, time_in, time_out)) 
                                                    as `SUM_HOURS`  FROM `attendance` WHERE date BETWEEN '" . $_POST['start'] . "' AND  '" . $_POST['end'] . "' AND employee_id = '" . $employee_id . "' ORDER BY `attendance`.`date` DESC");
        $rowCountHours = mysqli_fetch_array($selectCountHoursPayed);
        $hours_per_day = $rowCountHours['SUM_HOURS'];

        $selectDaysPayed = mysqli_query($db, "SELECT TIMESTAMPDIFF(HOUR, time_in, time_out) 
                                                    as `SUM_HOURS`  FROM `attendance` WHERE date BETWEEN '" . $_POST['start'] . "' AND  '" . $_POST['end'] . "' AND employee_id = '" . $employee_id . "' ORDER BY `attendance`.`date` DESC");
        $days = mysqli_num_rows($selectDaysPayed);

        if ($countDeal >= 14) {
            $dealEarned = 1500;
        } else {
            $dealEarned = $countDeal * 25;
        }
        $firstname = $row1["firstname"];
        $lastname = $row1["lastname"];
        $email = $row1["email"];
        $contact_number = $row1["contact_number"];
        $extension_number = $row1["extension_number"];
        $employee_type = $row1["employee_type"];
        $tin = $row1["tin"];
        $philhealth = $row1["philhealth"];
        $sss = $row1["sss"];
        $pag_ibig = $row1["pag_ibig"];
        $salary_per_hour = $row1["salary"];
        $net_pay = $row1["salary"] * $hours_per_day * $days;
        $pay_run = date("Y-m-d");
        $start =  $_POST['start'];
        $end =  $_POST['end'];
        $total_working_hours = $hours_per_day;

        $insertQuery = mysqli_query($db, "INSERT INTO payslip (employee_id, pay_run, start_pay_period, end_pay_period, payslip_id, extension_number, account_id, email, firstname, lastname, contact_number, sss, philhealth, tin, pag_ibig, employee_type, total_working_hours, salary_per_hour, netpay, deal_count) VALUES ('" . $employee_id . "', '" . $pay_run . "', '" . $start . "', '" . $end . "', '" . $randomNum . "', '" . $extension_number . "', '" . $account_id . "', '" . $email . "', '" . $firstname . "', '" . $lastname . "', '" . $contact_number . "', '" . $sss . "', '" . $philhealth . "', '" . $tin . "', '" . $pag_ibig . "', '" . $employee_type . "', '" . $total_working_hours . "', '" . $salary_per_hour . "', '" . $net_pay . "', '" . $countDeal . "')");

        if ($insertQuery) {
            echo "Success";
        }
    }
}
