<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new \App\classes\SuperAdmin();
    include_once "includes/session-validation/session-validation.php";
    $committeeData = $superAdmin->getAllCommittees();

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
                        <h3 class="m-0 text-center text-dark">Committee</h3>
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
                            <th>Mail</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($committeeData)) { ?>
                        <?php if($row["is_active"] != 0 ){?>
                        <tr class="text-center">
                            <td><?php echo $row["committee_id"];?></td>
                            <td><?php echo $row["committee_name"];?></td>
                            <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                            <td><?php echo $row["office"];?></td>
                            <td><?php echo $row["email"];?></td>
                            <td><?php echo $row["phone"];?></td>
                            <td class="text-center">
                                <a href="update-committee.php?committee_id=<?php echo $row["committee_id"];?>" class="btn btn-dark btn-sm" type="submit">Update</a>
                            </td>
                        </tr>
                        <?php }?>
                    <?php } ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>