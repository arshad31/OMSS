<?php
    session_start();
    require_once "../vendor/autoload.php";
    $user = new \App\classes\User();
    if(isset($_POST['btn'])){
        $message = $user->userLogin($_POST);
    }
    if(isset($_SESSION["super_admin_id"])){
        header("Location: ../super-admin/index.php");
    }
    if(isset($_SESSION["user_id"])){
        header("Location: user-dashboard.php");
    }
?>

<?php
    include_once("includes/head/head.php");
    include_once ("includes/navbar/navbar-top.php");
?>
<div class="container margin-top">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="text-center m-0">Admin/User Login</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if(isset($message)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                                    <strong>Error: </strong> <?php echo $message; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="row form-group">
                            <label class="col-sm-12 col-md-3" for="email">Email</label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control rounded-0" type="email" name="email" id="email" placeholder="jhon@gmail.com"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-12 col-md-3" for="password">Password</label>
                            <div class="col-sm-12 col-md-9">
                                <input class="form-control rounded-0" type="password" name="password" id="password" placeholder="*****"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-12 col-md-3"></div>
                            <div class="col-sm-12 col-md-9">
                                <input class="btn btn-block btn-success rounded-0" type="submit" name="btn" value="Sign In" />
                                <div class="d-flex justify-content-center links mt-2">
                                    Don't have an account? <a href="registration.php" class="ml-2">Register</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/bottom/bottom.php"); ?>

