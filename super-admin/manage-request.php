<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new \App\classes\SuperAdmin();
    include_once "includes/session-validation/session-validation.php";
    $usersData = $superAdmin->usersRequest();
    if(isset($_GET["user_id"])){
        $userId = $_GET["user_id"];
        $superAdmin->acceptUserRequest($userId);
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
                    <h3 class="m-0 text-center text-dark">Manage Requests</h3>
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
                    <?php while ($row = mysqli_fetch_assoc($usersData)) { ?>
                        <tr class="text-center">
                            <td><?php echo $row["user_id"];?></td>
                            <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                            <td><?php echo $row["email"];?></td>
                            <td><?php echo $row["phone"];?></td>
                            <td><?php echo $row["office"];?></td>
                            <td><?php echo $row["designation"];?></td>
                            <td class="text-center">
                                <a href="?user_id=<?php echo $row["user_id"];?>" class="btn btn-success btn-sm" type="submit">Accept</a>
                                <a href="decline.php?user_id=<?php echo $row["user_id"];?>" class="btn btn-danger btn-sm" type="submit">Decline</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>