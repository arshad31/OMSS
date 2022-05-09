<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new \App\classes\SuperAdmin();
    include_once "includes/session-validation/session-validation.php";
    $activeUsersData = $superAdmin->getActiveUsers();
    if(isset($_GET["user_id"])){
        $superAdmin->userActionUpdate($_GET["user_id"]);
    }
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
                    <h3 class="m-0 text-center text-dark">Manage Users</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content mt-3">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                    <tr class="bg-info text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Office</th>
                        <th>Designation</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($activeUsersData)) { ?>
                        <tr class="text-center">
                            <td><?php echo $row["user_id"];?></td>
                            <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                            <td><?php echo $row["email"];?></td>
                            <td><?php echo $row["phone"];?></td>
                            <td><?php echo $row["office"];?></td>
                            <td><?php echo $row["designation"];?></td>
                            <td class="text-center">
                                <?php if($row["is_active"]==2){ ?>
                                    <a href="?user_id=<?php echo $row["user_id"];?>" class="btn btn-success btn-block btn-sm" type="submit">Active</a>
                                <?php }
                                      else{ ?>
                                    <a href="?user_id=<?php echo $row["user_id"];?>" class="btn btn-primary btn-block btn-sm" type="submit">Inactive</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>