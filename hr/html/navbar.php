<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">VTG</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : " "); ?>">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>



        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Profile</span>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'account_information.php' ? 'active' : " "); ?>">
            <a href="account_information.php" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Account Settings</div>
            </a>
        </li>

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">HR</span></li>
        <!-- Cards -->
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : " "); ?>">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Dashboard</div>
            </a>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : " "); ?>">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Attendance</div>
            </a>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'employees.php' ? 'active' : " "); ?>">
            <a href="employees.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Employees</div>
            </a>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'payroll.php' ? 'active' : " "); ?>">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Payroll</div>
            </a>
        </li>



        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Employees</span></li>
        <!-- Forms -->
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'payroll.php' ? 'active' : " "); ?>">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Payroll</div>
            </a>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : " "); ?>">
            <a href="cards-basic.html" class="menu-link">
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
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'employees.php' ? 'active' : " "); ?>">
            <a href="employees.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Documentation">Employees</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->