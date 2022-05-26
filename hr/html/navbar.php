<?php include 'db.php';
$navQuery = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $_SESSION['employee_id'] . "'");
$rowNav = mysqli_fetch_array($navQuery);

// 1 Owner
// 2 HR
// 3 Employee

$employee_type = $rowNav['type_id'];

?>

<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">VTG</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <?php if ($employee_type == 1) { ?>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : " "); ?>">
                <a href="index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
        <?php } ?>



        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Profile</span>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'account_information.php' ? 'active' : " "); ?>">
            <a href="account_information.php" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Account Settings</div>
            </a>
        </li>

        <?php if ($employee_type == 2 || $employee_type == 1) { ?>
            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">HR</span></li>
            <!-- Cards -->
            <!-- <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : " "); ?>">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Dashboard</div>
            </a>
        </li> -->
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : " "); ?>">
                <a href="attendance.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Attendance</div>
                </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'attendance_requests.php' ? 'active' : " "); ?>">
                <a href="attendance_requests.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Attendance Requests</div>
                </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'employees.php' ? 'active' : " "); ?>">
                <a href="employees.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Employees</div>
                </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'payroll_hr.php' ? 'active' : " "); ?>">
                <a href="payroll_hr.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Payroll HR</div>
                </a>
            </li>
        <?php } ?>

        <?php if ($employee_type == 3 || $employee_type == 1) { ?>
            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Employees</span></li>
            <!-- Forms -->
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'payroll.php' ? 'active' : " "); ?>">
                <a href="payroll_employee.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Payroll</div>
                </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : " "); ?>">
                <a href="attendance.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Attendance</div>
                </a>
            </li>


            <li class="menu-header small text-uppercase"><span class="menu-header-text">Others</span></li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'accounts.php' ? 'active' : " "); ?>">
                <a href="accounts.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Support">Accounts</div>
                </a>
            </li>
            <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'deals.php' ? 'active' : " "); ?>">
                <a href="deals.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Documentation">Deals</div>
                </a>
            </li>
        <?php } ?>
    </ul>
</aside>
<!-- / Menu -->