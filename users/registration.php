<?php
    require_once "../vendor/autoload.php";
    $user = new App\classes\User();
    if(isset($_POST['btn'])){
        $message = $user->userRegistration($_POST);
    }
    $officeData = $user->getAllOffice();
?>

<?php
    include_once("includes/head/head.php");
    include_once ("includes/navbar/navbar-top.php");
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-sm-6 offset-sm-3">
            <div class="card">
                <div class="card-body bg-light">
                    <h3 class="text-center mb-3">Register</h3>
                    <form action="" method="POST" id="registrationFrom">
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" id="user_id" name="user_id" placeholder="User ID" required="required">
                            <small class="invalid-feedback">Invalid user id!</small>
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
                            <input type="text" class="form-control rounded-0" id="phone" name="phone" placeholder="Phone" required="required">
                        </div>
                        <div class="form-group">
                            <select name="office" id="office" class="form-control order-0" data-placeholder="Select a State">
                                <option value="" disabled selected >Select Office</option>
                                <?php while ($row = mysqli_fetch_assoc($officeData)) { ?>
                                    <option ><?php echo $row["office_name"];?></option>
                                <?php } ?>
                            </select>
                            <small class="invalid-feedback">Office name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0" id="designation" name="designation" placeholder="Designation" required="required">
                            <small class="invalid-feedback">Designation name is not valid!</small>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success rounded-0 btn-block" name="btn" value="Register Now" />
                        </div>
                    </form>
                    <div class="text-center">Already have an account? <a href="index.php">Sign in</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>