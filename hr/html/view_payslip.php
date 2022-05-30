<?php include 'db.php';
session_start();
$payrollQuery = mysqli_query($db, "SELECT * FROM payslip WHERE payslip_id = '" . $_GET['id'] . "'");
$payslipRow = mysqli_fetch_array($payrollQuery);
$employees = mysqli_query($db, "SELECT * FROM employees WHERE type_id = '3'");

if ($payslipRow['salary_per_hour'] == "62.5") {
    $employee_type1 = "Newbie Employee";
} elseif ($payslipRow['salary_per_hour'] == "78") {
    $employee_type1 = "Rookie Employee";
} elseif ($payslipRow['salary_per_hour'] == "82") {
    $employee_type1 = "Tenured Employee";
} else {
    $employee_type1 = "Officer In Charge";
}

$accountQuery = mysqli_query($db, "SELECT * FROM accounts WHERE account_id = '" . $payslipRow['account_id'] . "'");
$accountRow = mysqli_fetch_array($accountQuery);
$account_name = $accountRow['name'];

$deal = mysqli_query($db, "SELECT * FROM deals WHERE employee_id = '" . $payslipRow['employee_id'] . "' ");
$countDeal = mysqli_num_rows($deal);

if ($countDeal == 0) {
    $totalDeal = 0;
} elseif ($countDeal >= 14) {
    $totalDeal = 1500;
} else {
    $totalDeal = $countDeal * 40;
}


$deductions = mysqli_query($db, "SELECT * FROM employer_contribution");
$drow = mysqli_fetch_array($deductions);
$deductions1 = $drow['e_sss'] + $drow['e_ph'] + $drow['e_hdmf'];

$daysAttended = mysqli_query($db, "SELECT * FROM `attendance` WHERE date BETWEEN '" . $payslipRow['start_pay_period'] . "' AND  '" . $payslipRow['end_pay_period'] . "' AND employee_id = '" . $payslipRow['employee_id'] . "' ORDER BY `attendance`.`date` DESC");

$selectCountHoursPayed = mysqli_query($db, "SELECT SUM(TIMESTAMPDIFF(HOUR, time_in, time_out)) 
                                            as `SUM_HOURS`  FROM `attendance` WHERE date BETWEEN '" . $payslipRow['start_pay_period'] . "' AND  '" . $payslipRow['end_pay_period'] . "' AND employee_id = '" . $payslipRow['employee_id'] . "' ORDER BY `attendance`.`date` DESC");
$rowCountHours = mysqli_fetch_array($selectCountHoursPayed);
$hours_per_day = $rowCountHours['SUM_HOURS'];

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <title>Payslip | VTG</title>
    <?php include 'title-tags.php'; ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include 'navbar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'top-nav.php'; ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> Basic Tables</h4> -->
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">HR Payroll / Payslip - <?php echo $payslipRow['firstname']; ?> <?php echo $payslipRow['lastname']; ?></span> </h4>
                        <!-- Hoverable Table payslipRows -->
                        <div class="payslip-container">

                            <div id="payslip">
                                <div id="title">Payslip</div>
                                <div id="scope">
                                    <div class="scope-entry">
                                        <div class="title">PAY RUN</div>
                                        <div class="value"><?php echo date("F d, Y", strtotime($payslipRow['pay_run'])); ?></div>
                                    </div>
                                    <div class="scope-entry">
                                        <div class="title">PAY PERIOD</div>
                                        <div class="value"><?php echo date("F d, Y", strtotime($payslipRow['start_pay_period'])); ?> - <?php echo date("F d, Y", strtotime($payslipRow['end_pay_period'])); ?></div>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="left-panel">
                                        <div id="employee">
                                            <div id="name">
                                                VTG
                                            </div>
                                            <div id="email">
                                                vtg@gmail.com
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="entry">
                                                <div class="label">Extension ID</div>
                                                <div class="value"><?php echo $payslipRow['extension_number']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Employee ID</div>
                                                <div class="value"><?php echo strtoupper($payslipRow['employee_id']); ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Employee ID</div>
                                                <div class="value"><?php echo $payslipRow['firstname']; ?> <?php echo $payslipRow['lastname']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Hourly Rate</div>
                                                <div class="value">₱<?php echo $payslipRow['salary_per_hour']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Company Name</div>
                                                <div class="value">VTG Support</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Position</div>
                                                <div class="value"><?php echo $employee_type1; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Account Name</div>
                                                <div class="value"><?php echo $account_name; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">TIN</div>
                                                <div class="value"><?php echo $payslipRow['tin']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">SSS</div>
                                                <div class="value"><?php echo $payslipRow['sss']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">HDMF</div>
                                                <div class="value"><?php echo $payslipRow['pag_ibig']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Philhealth</div>
                                                <div class="value"><?php echo $payslipRow['philhealth']; ?></div>
                                            </div>
                                        </div>
                                        <div class="contributions">
                                            <div class="title">Employer Contribution</div>
                                            <div class="entry">
                                                <div class="label">SSS</div>
                                                <div class="value">₱<?php echo $drow['sss']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">HDMF</div>
                                                <div class="value">₱<?php echo $drow['hdmf']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">PhilHealth</div>
                                                <div class="value">₱<?php echo $drow['philhealth']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-panel">
                                        <div class="details">
                                            <div class="basic-pay">
                                                <div class="entry">
                                                    <div class="label">Basic Pay</div>
                                                    <div class="detail"></div>
                                                    <div class="rate">₱<?php echo $payslipRow["salary_per_hour"] * 8 * 20; ?>/Month</div>
                                                    <div class="amount">₱<?php echo $payslipRow["salary_per_hour"] * 8 * 20 / 2; ?></div>
                                                </div>
                                            </div>
                                            <div class="salary">
                                                <div class="entry">
                                                    <div class="label">Deals</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount"></div>
                                                </div>
                                                <?php while ($row = mysqli_fetch_array($deal)) { ?>
                                                    <div class="entry">
                                                        <div class="label"></div>
                                                        <div class="detail"><?php echo $account_name; ?> Deal</div>
                                                        <div class="rate">₱40</div>
                                                        <div class="amount">(₱40)</div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="net_pay">
                                                <div class="entry">
                                                    <div class="label">DEALS</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount">₱<?php echo $totalDeal; ?></div>
                                                </div>
                                            </div>
                                            <div class="taxable_commission"></div>
                                            <div class="contributions">
                                                <div class="entry">
                                                    <div class="label">Attendance</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount"></div>
                                                </div>
                                                <?php while ($row11 = mysqli_fetch_array($daysAttended)) {
                                                    if ($row11['time_out'] == "00:00:00") {
                                                        $time_out = "-- : -- : --";
                                                        $hours = 0;
                                                    } else {
                                                        $time_out = $row11['time_out'];
                                                        $total      = strtotime($row11['time_out']) - strtotime($row11['time_in']);
                                                        $hours      = floor($total / 60 / 60);
                                                    }
                                                ?>
                                                    <div class="entry">
                                                        <div class="label"></div>
                                                        <div class="detail"><?php echo $row11['date'] ?> &nbsp; <?php echo $hours ?> hrs</div>
                                                        <div class="rate"></div>
                                                        <div class="amount"></div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="contributions">
                                                <div class="entry">
                                                    <div class="label">Contributions</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount"></div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">SSS</div>
                                                    <div class="rate"></div>
                                                    <div class="amount">(₱<?php echo $drow['e_sss']; ?>)</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">HDMF</div>
                                                    <div class="rate"></div>
                                                    <div class="amount">(₱<?php echo $drow['e_hdmf']; ?>)</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">PhilHealth</div>
                                                    <div class="rate"></div>
                                                    <div class="amount">(₱<?php echo $drow['e_ph']; ?>)</div>
                                                </div>
                                            </div>

                                            <div class="net_pay">
                                                <div class="entry">
                                                    <div class="label">Contributions</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount">₱<?php echo $deductions1; ?></div>
                                                </div>
                                            </div>

                                            <div class="net_pay">
                                                <div class="entry">
                                                    <div class="label">NET PAY</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount">₱<?php echo $payslipRow["salary_per_hour"] * $hours_per_day - $deductions1; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Hoverable Table rows -->
                    </div>
                    <!-- / Content -->
                    <?php include 'footer.php'; ?>

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <?php include 'script-tags.php'; ?>
</body>

</html>