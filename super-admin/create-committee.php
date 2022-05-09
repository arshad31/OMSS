<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new \App\classes\SuperAdmin();
    include_once "includes/session-validation/session-validation.php";
    if(isset($_POST['btn'])){
        $message = $superAdmin->committeeCreation($_POST);
    }
    $officeData = $superAdmin->getAllOffice();
    $usersData = $superAdmin->getAllUsers();
?>

<?php

    include_once "includes/head/head.php";
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
                        <h3 class="m-0 text-center text-dark">Create Committee</h3>
                    </div>
                </div>
            </div>
        </div>
    <section class="content mt-3">
        <div class="row">
            <div class="col-sm-8 offset-2">
                <form action="" method="POST">
                    <?php if(isset($message)) { ?>
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="committe-name">Committee ID</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="committee_id" name="committee_id" placeholder="Comiitee ID" required="required"/>
                        </div>
                    </div>
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="committe-name">Committee Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="committee_name" name="committee_name" placeholder="Questiom Moderation comiitee" required="required" />
                        </div>
                    </div>
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="committe-admin">Committee Admin</label>
                        <div class="col-sm-9">
                            <select id = "search_select_input" name="committee_admin" class="select2-canal form-control" placeholder="Select a State" required="required" style="width: 100%">
                                <option value="" disabled selected >Select Committee Admin</option>
                                <?php while ($row = mysqli_fetch_assoc($usersData)) { ?>
                                    <option value="<?php echo $row["user_id"];?>" title="<?php echo $row["designation"];?>, <?php echo $row["office"];?>"><?php echo $row["first_name"]." ".$row["last_name"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="email">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="email" name="email" placeholder="jhon@gmail.com" required="required"/>
                        </div>
                    </div>
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="phone">Phone</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="phone" name="phone" required="required" />
                        </div>
                    </div>
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="office" >Office</label>
                        <div class="col-sm-9">
                            <select name="office" id="office" class="form-control" data-placeholder="Select a State">
                                <option value="" disabled selected >Select Office</option>
                                <?php while ($row = mysqli_fetch_assoc($officeData)) { ?>
                                    <option><?php echo $row["office_name"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mx-2">
                        <input class="btn btn-success offset-sm-3" type="submit" name="btn" value="Create Committee"/>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>