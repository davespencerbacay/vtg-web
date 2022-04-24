<?php include 'db.php';
session_start();
include 'account_verification.php';


if (isset($_GET['mode'])) {
    if ($_GET['mode'] == "edit") {
        $accountQuery = mysqli_query($db, "SELECT * FROM accounts WHERE account_id = '" . $_GET['account_id'] . "'");
        $row = mysqli_fetch_array($accountQuery);
        $account_id = $_GET['account_id'];
        $name = $row['name'];
        $description = $row['description'];
        $status = $row['status'];
        $hasDeal = $row['has_deal'];
    } else {
        $account_id = "";
        $name = "";
        $description = "";
        $status = "";
        $hasDeal = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <title>Accounts | VTG</title>
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> <?php echo $_GET['mode'] === "edit" ? "Edit" : "Add"; ?> Account </h4>
                        <div class="card mb-4">
                            <h5 class="card-header">Account Information</h5>
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="text_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="text_name" placeholder="John Doe" aria-describedby="defaultFormControlHelp" value="<?php echo $name; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="text_description" placeholder="Lorem Ipsum..." aria-describedby="defaultFormControlHelp" value="<?php echo $description; ?>" />
                                </div>
                                <div class="mb-2">
                                    <label for="text_status" class="form-label">Status</label>
                                    <select id="text_status" class="form-control" value="<?php echo $status; ?>">
                                        <?php if ($status == "1") {
                                            echo '<option value="1">Active</option><option value="0">Inactive</option>';
                                        } else {
                                            echo '<option value="0">Inactive</option><option value="1">Active</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="text_deal" class="form-label">Has Deal?</label>
                                    <select id="text_deal" class="form-control" value="<?php echo $hasDeal; ?>">
                                        <?php if ($hasDeal == "1") {
                                            echo '<option value="1">Yes</option><option value="0">No</option>';
                                        } else {
                                            echo '<option value="0">No</option><option value="1">Yes</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" id="text_accountid" value="<?php echo $account_id; ?>" />
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
            var name = $("#text_name").val();
            var description = $("#text_description").val();
            var deal = $("#text_deal").val();
            var status = $("#text_status").val();
            var operation = "Add";

            $.ajax({
                url: "servers/account-server.php",
                method: "POST",
                data: {
                    name,
                    description,
                    deal,
                    status,
                    operation
                },
                success: function(data) {
                    if (data === "Success") {
                        window.location.replace("accounts.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }

        function editAccount(id) {
            var name = $("#text_name").val();
            var description = $("#text_description").val();
            var deal = $("#text_deal").val();
            var status = $("#text_status").val();
            var operation = "Edit";
            var account_id = $("#text_accountid").val();;

            $.ajax({
                url: "servers/account-server.php",
                method: "POST",
                data: {
                    name,
                    description,
                    deal,
                    status,
                    operation,
                    account_id: account_id,
                },
                success: function(data) {
                    if (data === "Success") {
                        window.location.replace("accounts.php");
                    } else {
                        swal("INVALID!", data, "error");
                    }
                }
            })
        }
    </script>
</body>

</html>