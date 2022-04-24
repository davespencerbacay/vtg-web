<?php include 'db.php';
session_start();
include 'account_verification.php';



if (isset($_GET['mode'])) {
    if ($_GET['mode'] == "edit") {
        $employeeQuery = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $_GET['employee_id'] . "'");
        $row = mysqli_fetch_array($employeeQuery);

        // ! Account Query 
        $accountQuery = mysqli_query($db, "SELECT * FROM accounts ORDER BY FIELD(account_id, '" . $row['account_id'] . "') DESC");
        $employee_id = $_GET['employee_id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $account_id = $row['account_id'];
        $extension_number = $row['extension_number'];
        $salary_id = $row['salary_id'];
        $email = $row['email'];
        $password = $row['password'];
        $avatar = $row['avatar'];
        $team_leader = $row['team_leader'];
        $contact_number = $row['contact_number'];
    } else {
        $accountQuery = mysqli_query($db, "SELECT * FROM accounts ORDER BY id DESC");
        $employee_id = "";
        $firstname = "";
        $lastname = "";
        $account_id = "";
        $extension_number = "";
        $salary_id = "";
        $email = "";
        $password = "";
        $avatar = "";
        $team_leader = "";
        $contact_number = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <title>Employees | VTG</title>
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
                        <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employees /</span> Basic Tables</h4> -->
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employees /</span> <?php echo $_GET['mode'] === "edit" ? "Edit" : "Add"; ?> Employees </h4>
                        <div class="card mb-4">
                            <h5 class="card-header">Employee Information</h5>
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Firstname</label>
                                    <input type="text" class="form-control" id="text_firstname" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $firstname; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Lastname</label>
                                    <input type="text" class="form-control" id="text_lastname" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $lastname; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="text_email" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $email; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="text_number" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $contact_number; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_extension_number" class="form-label">Extension Number</label>
                                    <input type="text" class="form-control" id="text_extension_number" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $extension_number; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="text_password" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $password; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Account</label>
                                    <select class="form-control" id="text_accountid">
                                        <?php while ($row1 = mysqli_fetch_array($accountQuery)) { ?>
                                            <option value="<?php echo $row1['account_id']; ?>"><?php echo $row1['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <input type="hidden" id="text_employeeid" value="<?php echo $employee_id; ?>" />
                                <?php
                                if ($_GET['mode'] === "edit") {
                                    echo '<button class="btn btn-primary btn-block w-100" onclick="editAccount()">Edit</button>';
                                } else {
                                    echo '<button class="btn btn-primary btn-block w-100" onclick="addAccount()">Add</button>';
                                }
                                ?>
                            </div>
                        </div>
                        <!--/ Hoverable Table rows -->
                    </div>
                    <!-- / Content -->
                    <?php include 'footer.php'; ?>

                    <div class=" content-backdrop fade">
                    </div>
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

    <script type="text/javascript">
        function addAccount() {
            var firstname = $("#text_firstname").val();
            var lastname = $("#text_lastname").val();
            var email = $("#text_email").val();
            var extension_number = $("#text_extension_number").val();
            var contact_number = $("#text_number").val();
            var password = $("#text_password").val();
            var operation = "Add";
            var account_id = $("#text_accountid").val();

            $.ajax({
                url: "servers/employee-server.php",
                method: "POST",
                data: {
                    firstname,
                    lastname,
                    email,
                    extension_number,
                    contact_number,
                    password,
                    operation,
                    account_id: account_id,
                },
                success: function(data) {
                    if (data === "Success") {
                        window.location.replace("employees.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }

        function editAccount(id) {
            var firstname = $("#text_firstname").val();
            var lastname = $("#text_lastname").val();
            var email = $("#text_email").val();
            var extension_number = $("#text_extension_number").val();
            var contact_number = $("#text_number").val();
            var password = $("#text_password").val();
            var operation = "Edit";
            var account_id = $("#text_accountid").val();
            var employee_id = $("#text_employeeid").val();

            $.ajax({
                url: "servers/employee-server.php",
                method: "POST",
                data: {
                    firstname,
                    lastname,
                    email,
                    extension_number,
                    contact_number,
                    password,
                    employee_id,
                    operation,
                    account_id: account_id,
                },
                success: function(data) {
                    if (data === "Success") {
                        window.location.replace("employees.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>
</body>

</html>