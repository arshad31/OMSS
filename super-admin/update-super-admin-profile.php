<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new App\classes\SuperAdmin();
    $superAdminInfo = mysqli_fetch_assoc($superAdmin->getSuperAdminInfo());
    if(isset($_POST['btn'])){
        $message = $superAdmin->superAdminInfoUpdate($_POST);
    }
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
                        <h3 class="m-0 text-center text-dark">Update Super Admin Information</h3>
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
                                <div class="col"><input type="text" class="form-control rounded-0" id="first_name" name="first_name" value="<?php echo $superAdminInfo["first_name"];?>" required="required">
                                    <small class="invalid-feedback">Fist name is not valid!</small>
                                </div>
                                <div class="col"><input type="text" class="form-control rounded-0" id="last_name" name="last_name" value="<?php echo $superAdminInfo["last_name"];?>" required="required">
                                    <small class="invalid-feedback">Last name is not valid!</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control rounded-0" id="email" name="email" value="<?php echo $superAdminInfo["email"];?>" required="required">
                            <small class="invalid-feedback">Invalid email address!</small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control rounded-0" id="password" placeholder="Password" name="password" >
                            <small class="invalid-feedback">Invalid password!</small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control rounded-0" id="confirm_password" placeholder="Confirm Password" name="confirm_password">
                            <small class="invalid-feedback">Confirm password doesn't match!</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" name="phone" value="<?php echo $superAdminInfo["phone"];?>" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control order-0" id="organization" name="organization" value="<?php echo $superAdminInfo["organization"];?>" required="required">
                            <small class="invalid-feedback">Organization name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" id="designation" name="designation" value="<?php echo $superAdminInfo["designation"];?>" required="required">
                            <small class="invalid-feedback">Designation name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success rounded-0 btn-block" name="btn" value="Save" />
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

<?php include_once "includes/bottom/bottom.php"; ?>