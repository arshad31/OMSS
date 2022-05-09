<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $adminID= $_SESSION["user_id"];
    $admin = new \App\classes\Admin();
    $meetingsData = $admin->getUpcomingMeetingsByAdminID($adminID);
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
                        <h3 class="m-0 text-center text-dark">Upcoming Meeting</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row ">
                <div class="col-sm-10 offset-1">
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                        <tr class="bg-info text-center">
                            <th>Meting Date</th>
                            <th>Meting Time   </th>
                            <th>Meeting Description</th>
                            <th>Action</th>
                            <th>Send Mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($meetingsData)) {?>
                        <tr >
                            <td class="text-center">
                                <?php $date=date_create($row["meeting_date"]);?>
                                <div><?php echo strtoupper(date_format($date,"M")); ?></div>
                                <div><?php echo date_format($date,"d"); ?></div>
                                <div><?php echo date_format($date,"Y"); ?></div>
                            </td>
                            <td class="text-center">
                                <div><?php echo date('h:i A', strtotime($row["meeting_time_start"])); ?></div>
                                <div>to</div>
                                <div><?php echo date('h:i A', strtotime($row["meeting_time_end"])); ?></div>
                            </td>
                            <td>
                                <?php if($row["m_action"]==1){?>
                                    <div> <strong><?php echo $row["committee_name"];?></strong> </div>
                                    <div><?php echo substr_replace($row["description"], "...", 120);?></div>
                                <?php }else{?>
                                    <div> <strong><s><?php echo $row["committee_name"];?></s></strong> </div>
                                    <div><s><?php echo substr_replace($row["description"], "...", 120);?></s></div>
                                <?php }?>
                            </td>
                            <td class="text-center " >
                                <a href="upcoming-meeting-details.php?meeting_id=<?php echo $row["meeting_id"];?>" class="btn btn-dark btn-sm mt-lg-3"  type="submit">View</a>

                            </td>
                            <td >
                                <div class="mt-2"><a href="mail-sending.php?meeting_id=<?= $row["meeting_id"]?>" class="btn btn-outline-primary btn-sm" type="submit">Send Mail</a></div>
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