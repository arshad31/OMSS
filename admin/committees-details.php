<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $admin = new \App\classes\Admin();
    $committeeUsersData = [];
    if(isset($_GET["committee_id"])){
        $committeeId = $_GET["committee_id"];
        $committeeInfo = mysqli_fetch_assoc($admin->getCommitteeInfoByCommitteeID($committeeId));
        $committeeUsersData = $admin->getCommitteeMemberInfoByCommitteeID($committeeId);
    }
    $usersData = $admin->getActiveUsers();
    if(isset($_GET["user_id"])){
        $admin->removeCommitteeMemberByCommitteeID($_GET);
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
                        <h3 class="m-0 text-center text-dark">Committee Details</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content mt-3">
            <div class="row">
                <div class="col-sm-8 offset-2">
                    <table>
                        <tr>
                            <th>Committee ID :</th>
                            <td class="w-25"></td>
                            <td><?php  echo $committeeInfo["committee_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Committee Name :</th>
                            <td></td>
                            <td><?php  echo $committeeInfo["committee_name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Committee Admin :</th>
                            <td class="w-25"></td>
                            <td>
                                <?php while ($row = mysqli_fetch_assoc($usersData)) { if ($row["user_id"]==$committeeInfo["committee_admin"]){
                                    echo $row["first_name"]." ".$row["last_name"];
                                 }}?>
                            </td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td></td>
                            <td><?php  echo $committeeInfo["email"]; ?></td>
                        </tr>
                        <tr>
                            <th>Phone :</th>
                            <td></td>
                            <td><?php  echo $committeeInfo["phone"]; ?></td>
                        </tr>
                        <tr>
                            <th>Office :</th>
                            <td></td>
                            <td><?php  echo $committeeInfo["office"]; ?></td>
                        </tr>
                    </table>
                    <h4 class="my-3 text-center ">Members</h4>
                    <!-- <hr>-->
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                        <tr class="bg-info text-center">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($committeeUsersData)){ ?>
                            <tr class="text-center">
                                <td><?php echo $row["first_name"]." ".$row["last_name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["phone"]; ?></td>
                                <td><?php echo $row["office"]; ?></td>
                                <td><?php echo $row["designation"]; ?></td>
                                <td class="text-center">
                                    <a href="?user_id=<?php echo $row["user_id"];?>&amp;committee_id=<?php echo $committeeInfo["committee_id"];?>" class="btn btn-danger btn-sm" type="submit">Remove</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-center my-2">
                        <a type="button" class="btn btn-primary" href="committees-members.php?committee_id=<?php echo $committeeInfo["committee_id"];?>">Add Members</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include_once "includes/bottom/bottom.php"; ?>