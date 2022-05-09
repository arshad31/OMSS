<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new \App\classes\SuperAdmin();
    include_once "includes/session-validation/session-validation.php";
    $committeeData = $superAdmin->getAllCommittees();
    if(isset($_GET["committee_id"])){
        $committeeId = $_GET["committee_id"];
        $superAdmin->committeeActionUpdate($committeeId);
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
                        <h3 class="m-0 text-center text-dark">Manage Committee</h3>
                    </div>
                </div>
            </div>
        </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="bg-info text-center">
                            <th>Committee ID</th>
                            <th>Committee Name</th>
                            <th>Committee Admin</th>
                            <th>Office</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($committeeData)) { ?>
                        <tr class="text-center">
                            <td><?php echo $row["committee_id"];?></td>
                            <td><?php echo $row["committee_name"];?></td>
                            <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                            <td><?php echo $row["office"];?></td>
                            <td class="text-center">
                                <?php if($row["is_active"]==0){ ?>
                                    <a href="?committee_id=<?php echo $row["committee_id"];?>" class="btn btn-success btn-block btn-sm" type="submit">Active  </a>
                                <?php }
                                else{ ?>
                                    <a href="?committee_id=<?php echo $row["committee_id"];?>" class="btn btn-primary btn-block btn-sm" type="submit">Inactive</a>
                                <?php } ?>
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