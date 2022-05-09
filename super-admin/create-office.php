<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new \App\classes\SuperAdmin();
    include_once "includes/session-validation/session-validation.php";
    if(isset($_POST['btn'])){
        $message = $superAdmin->officeCreation($_POST);
    }
    $officeData = $superAdmin->getAllOffice();
    if(isset($_GET["office_id"])){
        $officeId = $_GET["office_id"];
        $superAdmin->removeOffice($officeId);
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
                    <h3 class="m-0 text-center text-dark">Create Office</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content mt-3">
        <div class="row">
            <div class="col-sm-8 offset-2">
                <form action="#" method="POST">
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="office_id">Office ID</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="office_id" name="office_id" placeholder="Office ID" required="required" />
                        </div>
                    </div>
                    <div class="from-group row my-2">
                        <label class="col-sm-3" for="office_name">Office Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="office_name" name="office_name" placeholder="Office Name" required="required"/>
                        </div>
                    </div>
                    <div class="row mx-2 mb-lg-5">
                        <input class="btn btn-success offset-sm-3" type="submit" name="btn" value="Create Office"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                    <tr class="bg-info text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($officeData)) { ?>
                        <tr class="text-center">
                            <td><?php echo $row["office_id"];?></td>
                            <td><?php echo $row["office_name"];?></td>
                            <td class="text-center">
                                <a href="?office_id=<?php echo $row["office_id"];?>" class="btn btn-danger btn-sm" type="submit">Remove</a>
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