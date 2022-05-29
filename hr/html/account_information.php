<?php
include 'db.php';
session_start();

$employeeQuery = mysqli_query($db, "SELECT * FROM employees WHERE employee_id = '" . $_SESSION['employee_id'] . "'");
$row = mysqli_fetch_array($employeeQuery);

// ! Account Query 
$accountQuery = mysqli_query($db, "SELECT * FROM accounts ORDER BY FIELD(account_id, '" . $row['account_id'] . "') DESC");
$employee_id = $_SESSION['employee_id'];
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
$avatar = $row['avatar'];

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <title>Account settings - Account | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <?php include 'title-tags.php'; ?>
</head>

<body onload="generateQRCode()">
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills d-flex justify-content-center mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="account_information.php">Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="deals.php"> Deals</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="payslip.php"> Payslip</a>
                                    </li>
                                </ul>
                                <div class="card mb-4">
                                    <h5 class="card-header">Profile Details</h5>
                                    <!-- Account -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            <div id="qrCode"></div>
                                            <div class="button-wrapper">
                                                <a class="btn btn-outline-secondary mb-4 btn-primary btn-sm" href="servers/attendance-scan.php?employee_id=<?php echo $_SESSION['employee_id']; ?>">TIME IN</a>
                                                <a class="btn btn-outline-secondary mb-4 btn-primary btn-sm" href="servers/attendance-scan.php?employee_id=<?php echo $_SESSION['employee_id']; ?>">TIME OUT</a>

                                                <p class="text-muted mb-0">Scan the QR code to time in or time out.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0" />
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
                                        <div class="mt-2">
                                            <button class="btn btn-primary btn-block w-100" onclick="editAccount()">Edit</button>
                                        </div>
                                    </div>
                                    <!-- /Account -->
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Delete Account</h5>
                                    <div class="card-body">
                                        <div class="mb-3 col-12 mb-0">
                                            <div class="alert alert-warning">
                                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                                            </div>
                                        </div>
                                        <form id="formAccountDeactivation" onsubmit="return false">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                                                <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                                            </div>
                                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script>
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
                        window.location.replace("account_information.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>

    <script type="text/javascript">
        function generateQRCode() {
            let employee_id = <?php echo json_encode($_SESSION['employee_id']); ?>;
            let website = `http://192.168.1.1/vtg-website/hr/html/servers/attendance-scan-server.php?operation=IN_OUT&employee_id=${employee_id}`;
            if (website) {
                let qrcodeContainer = document.getElementById("qrCode");
                qrcodeContainer.innerHTML = "";
                new QRCode(qrcodeContainer, website);
            } else {
                alert("INVALID URL");
            }
        }
    </script>
    <?php include 'script-tags.php'; ?>
</body>

</html>