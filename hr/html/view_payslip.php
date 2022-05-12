<?php include 'db.php';
session_start();
$payrollQuery = mysqli_query($db, "SELECT * FROM payslip WHERE payslip_id = '" . $_GET['id'] . "'");
$row = mysqli_fetch_array($payrollQuery);
$employees = mysqli_query($db, "SELECT * FROM employees WHERE type_id = '3'");

if ($row['employee_type'] == "1") {
    $employee_type = "Regular Employee";
} else {
    $employee_type = "Probitionary Employee";
}

$accountQuery = mysqli_query($db, "SELECT * FROM accounts WHERE account_id = '" . $row['account_id'] . "'");
$accountRow = mysqli_fetch_array($accountQuery);
$account_name = $accountRow['name'];

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">HR Payroll / Payslip - <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></span> </h4>
                        <!-- Hoverable Table rows -->
                        <div class="payslip-container">

                            <div id="payslip">
                                <div id="title">Payslip</div>
                                <div id="scope">
                                    <div class="scope-entry">
                                        <div class="title">PAY RUN</div>
                                        <div class="value"><?php echo date("F d, Y", strtotime($row['pay_run'])); ?></div>
                                    </div>
                                    <div class="scope-entry">
                                        <div class="title">PAY PERIOD</div>
                                        <div class="value"><?php echo date("F d, Y", strtotime($row['start_pay_period'])); ?> - <?php echo date("F d, Y", strtotime($row['start_pay_period'])); ?></div>
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
                                                <div class="label">Employee ID</div>
                                                <div class="value"><?php echo $row['employee_id']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Employee ID</div>
                                                <div class="value"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Hourly Rate</div>
                                                <div class="value">₱<?php echo $row['salary_per_hour']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Company Name</div>
                                                <div class="value">VTG Support</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Position</div>
                                                <div class="value"><?php echo $employee_type; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Account Name</div>
                                                <div class="value"><?php echo $account_name; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">TIN</div>
                                                <div class="value"><?php echo $row['tin']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">SSS</div>
                                                <div class="value"><?php echo $row['sss']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">HDMF</div>
                                                <div class="value"><?php echo $row['pag_ibig']; ?></div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Philhealth</div>
                                                <div class="value"><?php echo $row['philhealth']; ?></div>
                                            </div>
                                        </div>
                                        <div class="contributions">
                                            <div class="title">Employer Contribution</div>
                                            <div class="entry">
                                                <div class="label">SSS</div>
                                                <div class="value">1,178.70</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">SSS EC</div>
                                                <div class="value">30.00</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">HDMF</div>
                                                <div class="value">100.00</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">PhilHealth</div>
                                                <div class="value">437.50</div>
                                            </div>
                                        </div>
                                        <div class="ytd">
                                            <div class="title">Year To Date Figures</div>
                                            <div class="entry">
                                                <div class="label">Gross Income</div>
                                                <div class="value">92,823.86</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Taxable Income</div>
                                                <div class="value">82,705.06</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Net Pay</div>
                                                <div class="value">69,656.21</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Bonus</div>
                                                <div class="value">21,409.34</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Deduction</div>
                                                <div class="value">500.00</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">SSS Employer</div>
                                                <div class="value">1,178.70</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">PhilHealth Employer</div>
                                                <div class="value">437.50</div>
                                            </div>
                                            <div class="entry">
                                                <div class="label">Pag-ibig Employer</div>
                                                <div class="value">100.00</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-panel">
                                        <div class="details">
                                            <div class="basic-pay">
                                                <div class="entry">
                                                    <div class="label">Basic Pay</div>
                                                    <div class="detail"></div>
                                                    <div class="rate">₱<?php echo $row["salary_per_hour"] * 8 * 20; ?>/Month</div>
                                                    <div class="amount">₱45,000.00</div>
                                                </div>
                                            </div>
                                            <div class="salary">
                                                <div class="entry">
                                                    <div class="label">Salary</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount"></div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Undertime</div>
                                                    <div class="rate">128hrs@259.62/hr</div>
                                                    <div class="amount">(33,231.36)</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Unworked Holiday</div>
                                                    <div class="rate">16hrs@259.62/hr</div>
                                                    <div class="amount">4,153.92</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Regular Holiday Regular Holiday</div>
                                                    <div class="rate">9hrs@778.85/hr</div>
                                                    <div class="amount">7,009.65</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Regular Holiday Regular Holiday Night</div>
                                                    <div class="rate">7hrs@856.73/hr</div>
                                                    <div class="amount">5,997.11</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Night</div>
                                                    <div class="rate">56hrs@285.582/hr</div>
                                                    <div class="amount">15,992.59</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Regular Holiday</div>
                                                    <div class="rate">9hrs@519.23/hr</div>
                                                    <div class="amount">4,673.07</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Regular Holiday Night</div>
                                                    <div class="rate">7hrs@571.15/hr</div>
                                                    <div class="amount">3,998.05</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Regular Holiday Night Overtime</div>
                                                    <div class="rate">2hrs@742.50/hr</div>
                                                    <div class="amount">1,485.00</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Special Holiday</div>
                                                    <div class="rate">9hrs@337.50/hr</div>
                                                    <div class="amount">3,037.50</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Special Holiday Night</div>
                                                    <div class="rate">7hrs@371.25/hr</div>
                                                    <div class="amount">2,598.75</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Rest Day</div>
                                                    <div class="rate">8hrs@337.50/hr</div>
                                                    <div class="amount">2,700.00</div>
                                                </div>
                                            </div>
                                            <div class="leaves">
                                                <div class="entry">
                                                    <div class="label">Leaves</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount"></div>
                                                </div>
                                                <div class="entry paid">
                                                    <div class="label"></div>
                                                    <div class="detail">Paid Leave</div>
                                                    <div class="rate">8hrs@259.62/hr</div>
                                                    <div class="amount">2,076.92</div>
                                                </div>
                                                <div class="entry unpaid">
                                                    <div class="label"></div>
                                                    <div class="detail">Unpaid Leave</div>
                                                    <div class="rate">8hrs@259.62/hr</div>
                                                    <div class="amount">(2076.96)</div>
                                                </div>
                                            </div>
                                            <div class="taxable_allowance">
                                                <div class="entry">
                                                    <div class="label">Taxable Allowance</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount"></div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Allowance Name</div>
                                                    <div class="rate"></div>
                                                    <div class="amount">1,000.00</div>
                                                </div>
                                            </div>
                                            <div class="taxable_bonus">
                                                <div class="entry">
                                                    <div class="label">Taxable Bonus</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount"></div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">Bonus Name</div>
                                                    <div class="rate"></div>
                                                    <div class="amount">19,409.34</div>
                                                </div>
                                            </div>
                                            <div class="taxable_commission"></div>
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
                                                    <div class="amount">(581.30)</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">HDMF</div>
                                                    <div class="rate"></div>
                                                    <div class="amount">(100.00)</div>
                                                </div>
                                                <div class="entry">
                                                    <div class="label"></div>
                                                    <div class="detail">PhilHealth</div>
                                                    <div class="rate"></div>
                                                    <div class="amount">(437.50)</div>
                                                </div>
                                            </div>

                                            <div class="net_pay">
                                                <div class="entry">
                                                    <div class="label">NET PAY</div>
                                                    <div class="detail"></div>
                                                    <div class="rate"></div>
                                                    <div class="amount">₱<?php echo $row["salary_per_hour"] * 8 * 20; ?>/Month</div>
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