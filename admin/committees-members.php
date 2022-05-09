<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $admin = new \App\classes\Admin();
    $activeUsersData = $admin->getActiveUsers();
    $committeeId = $_GET["committee_id"];
    if(isset($_POST["add_members_btn"])){
        unset($_POST["add_members_btn"]);
        $admin->setCommitteeMembers($committeeId, $_POST);
    }
?>

<?php
    include_once "includes/head/head.php";
    include_once "includes/navbar/navbar-top-admin.php";
    include_once "includes/navbar/navbar-bottom.php";
    include_once "includes/navbar/navbar-side.php";
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h3 class="m-0 text-center text-dark">Add Committee Members</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content mt-3">
            <div class="row">
                <div class="col-sm-9 offset-2">
                    <form action="" method="POST">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                            <tr class="bg-info text-center">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Office</th>
                                <th>Designation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 0; while ($row = mysqli_fetch_assoc($activeUsersData)) { ?>
                                <tr class="text-center">
                                    <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                                    <td><?php echo $row["email"];?></td>
                                    <td><?php echo $row["phone"];?></td>
                                    <td><?php echo $row["office"];?></td>
                                    <td><?php echo $row["designation"];?></td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="<?php echo $row["user_id"]; ?>" value="1" class="custom-control-input" id="<?php echo "customswitch". ++ $count; ?>">
                                            <label class="custom-control-label" for="<?php echo "customswitch". $count ?>"></label>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table
                        <div class="text-center my-2">
                            <input type="submit" class="btn btn-primary" name="add_members_btn" value="Add Members">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
<?php include_once "includes/bottom/bottom.php"; ?>