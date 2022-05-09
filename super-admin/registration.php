<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new App\classes\SuperAdmin();
    if(isset($_POST['btn'])){
        $message = $superAdmin->superAdminRegistration($_POST);
    }
?>

<?php
    include_once ("includes/head/head.php");
    include_once ("includes/navbar/navbar-top.php");

?>
<div class="container">
    <div class="row mt-5">
        <div class="col-sm-6 offset-sm-3">
            <div class="card">
                <div class="card-body bg-light">
                    <h3 class="text-center mb-3">Register</h3>
                    <form action="" method="POST">
			<div class="form-group">
                            <input type="id" class="form-control rounded-0" id="id" name="id" placeholder="ID" required="required">
                            <small class="invalid-feedback">Invalid ID!</small>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col"><input type="text" class="form-control rounded-0" id="first_name" name="first_name" placeholder="First Name" required="required">
                                    <small class="invalid-feedback">Fist name is not valid!</small>
                                </div>
                                <div class="col"><input type="text" class="form-control rounded-0" id="last_name" name="last_name" placeholder="Last Name" required="required">
                                    <small class="invalid-feedback">Last name is not valid!</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control rounded-0" id="email" name="email" placeholder="Email" required="required">
                            <small class="invalid-feedback">Invalid email address!</small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control rounded-0" id="password" name="password" placeholder="Password" required="required">
                            <small class="invalid-feedback">Invalid password!</small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control rounded-0" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required="required">
                            <small class="invalid-feedback">Confirm password doesn't match!</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" name="phone" placeholder="Phone" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control order-0" id="organization" name="organization" placeholder="Organization" required="required">
                            <small class="invalid-feedback">Organization name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" id="designation" name="designation" placeholder="Designation" required="required">
                            <small class="invalid-feedback">Designation name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success rounded-0 btn-block" name="btn" value="Register Now" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>