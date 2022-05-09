<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $superAdmin = new App\classes\SuperAdmin();
    $superAdminInfo = mysqli_fetch_assoc($superAdmin->getSuperAdminInfo());
?>

<?php
    include_once ("includes/head/head.php");
    include_once "includes/navbar/navbar-top-super-admin.php";
    include_once "includes/navbar/navbar-bottom.php";
    include_once "includes/navbar/navbar-side.php";
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h3 class="m-0 text-center text-dark">Super Admin Information</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content mt-3">
            <div class="row">
                <div style="margin-left: 300px; margin-right: 50px;">
                    <form action="" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col"><input type="text" class="form-control rounded-0" id="first_name" name="first_name" value="<?php echo $superAdminInfo["first_name"];?>" readonly>
                                    <small class="invalid-feedback">Fist name is not valid!</small>
                                </div>
                                <div class="col"><input type="text" class="form-control rounded-0" id="last_name" name="last_name" value="<?php echo $superAdminInfo["last_name"];?>" readonly>
                                    <small class="invalid-feedback">Last name is not valid!</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control rounded-0" id="email" name="email" value="<?php echo $superAdminInfo["email"];?>" readonly>
                            <small class="invalid-feedback">Invalid email address!</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" name="phone" value="<?php echo $superAdminInfo["phone"];?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control order-0" id="organization" name="organization" value="<?php echo $superAdminInfo["organization"];?>" readonly>
                            <small class="invalid-feedback">Organization name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" id="designation" name="designation" value="<?php echo $superAdminInfo["designation"];?>" readonly>
                            <small class="invalid-feedback">Designation name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <a href="update-super-admin-profile.php" class="btn btn-success rounded-0 btn-block" name="btn">Update</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
<?php include_once "includes/bottom/bottom.php"; ?>