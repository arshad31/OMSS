<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $adminID= $_SESSION["user_id"];
    $admin = new \App\classes\Admin();
    if(isset($_GET["meeting_id"])){
        $meetingData=mysqli_fetch_assoc($admin->getMeetingData($_GET["meeting_id"],$adminID));
        $committeeUser=$admin->getCommitteeUserDataByCommitteeID($meetingData["committee_id"]);
        $guestData=$admin->getGuestDataByMeetingID($_GET["meeting_id"]);
        if($meetingData != NULL){
            $meetingAgendaByID = $admin->getMeetingAgenda($_GET["meeting_id"]);
            $firstAgenda=mysqli_fetch_assoc($meetingAgendaByID);
        }
    }
    if(isset($_POST["button"])){
        $admin->userAttendance($_GET["meeting_id"],$_POST["attendance"]);
        if(!empty($_POST["guestAttendance"])) {
            $admin->guestAttendance($_GET["meeting_id"],$_POST["guestAttendance"]);
        }
        unset($_POST["button"]);
        unset($_POST["attendance"]);
        unset($_POST["guestAttendance"]);
        $admin->setAgendasDecision($_GET["meeting_id"],$_POST);
    }
?>

<?php
    include_once "includes/head/head.php";
    include_once "includes/navbar/navbar-top-admin.php";
    include_once "includes/navbar/navbar-bottom.php";
    include_once "includes/navbar/navbar-side.php";
?>
    <style>.parent{width: 100%;padding-left: 200px; /*padding-right: 5px;*/padding-top: 0px;padding-bottom: 40px;}  .title{font-weight: bold;}  .title-elements{margin-top: 15px;}</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h3 class="m-0 text-center text-dark">Meeting Details</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content ">
            <form method="POST" action="">
                <div class="parent container-fluid">
                    <div class="row title-elements">
                        <div class="col-md-3 title"><div>Meeting ID:</div></div>
                        <div class="col-md-9"><div><?php echo $meetingData["meeting_id"];?></div></div>
                    </div>
                    <div class="row title-elements">
                        <div class="col-md-3 title"><div>Committee Name:</div></div>
                        <div class="col-md-9"><div><?php echo $meetingData["committee_name"];?></div></div>
                    </div>
                    <div class="row title-elements">
                        <div class="col-md-3 title"><div>Office Name:</div></div>
                        <div class="col-md-9"><div><?php echo $meetingData["office"];?></div></div>
                    </div>
                    <div class="row title-elements">
                        <div class="col-md-3 title"><div>Agenda:</div></div>
                        <div class="col-md-9">
                            <div><?php $sNum=1; if($meetingData != NULL){ if($meetingData["m_action"] != 4){?> <input type="hidden" name="agendaId<?php echo $sNum;?>" value="<?php echo $firstAgenda['agenda_id']?>"> <?php } echo $sNum."."." ".$firstAgenda['agenda'];}?></div>
                            <?php if($meetingData["m_action"] != 4){?><div><textarea name="decision<?php echo $sNum;?>" cols="60" rows="2" placeholder="Agenda Decision" required="required" ></textarea></div><?php }?>
                            <?php
                            if($meetingData != NULL){
                                while ($row = mysqli_fetch_assoc($meetingAgendaByID)){
                                    $sNum++; if($meetingData["m_action"] != 4){ ?><input type="hidden" name="agendaId<?php echo $sNum;?>" value="<?php echo $row['agenda_id']?>"><?php }?>
                                    <div><?php echo $sNum.".".$row['agenda'];?></div>
                                    <?php if($meetingData["m_action"] != 4){?><div><textarea name="decision<?php echo $sNum;?>"  cols="60" rows="2" placeholder="Agenda Decision" required="required"></textarea></div>
                                <?php }}}?>
                        </div>
                    </div>
                    <div class="row title-elements">
                        <div class="col-md-3 title"><div>Date:</div></div>
                        <div class="col-md-9"><div><?php echo strtoupper(date_format(date_create($meetingData["meeting_date"]),"d/m/Y")); ?></div></div>
                    </div>
                    <div class="row title-elements">
                        <div class="col-md-3 title"><div>Time:</div></div>
                        <div class="col-md-9"><div><?php echo date('h:i A', strtotime($meetingData["meeting_time_start"]))?>  to  <?php echo date('h:i A', strtotime($meetingData["meeting_time_start"])); ?></div></div>
                    </div>
                    <div class="row title-elements">
                        <div class="col-md-3 title"><div>Description:</div></div>
                        <div class="col-md-9"><div><?php echo $meetingData["description"];?></div></div>
                    </div>
                    <h4 class="my-3 text-center ">Attendance</h4>
                    <div class="row">
                        <div class="col-sm-8 offset-2">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                <tr class="bg-info text-center">
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <?php if($meetingData["m_action"] != 4){?><th>Action</th><?php }?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($committeeUser)) { ?>
                                    <tr class="text-center">
                                        <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                                        <td><?php echo $row["designation"];?></td>
                                        <?php if($meetingData["m_action"] != 4){?>
                                        <td>
                                            <div class="custom-control">
                                                <input type="hidden" name="attendance[<?php echo $row["c_user_id"];?>]" value="0">
                                                <input type="checkbox" name="attendance[<?php echo $row["c_user_id"];?>]" value="1" checked> <!--id="<?php /*echo "customswitch". ++ $count; */?>">-->
                                            </div>
                                        </td><?php }?>
                                    </tr>
                                <?php } ?>
                                <?php while ($r = mysqli_fetch_assoc($guestData)) { ?>
                                    <tr class="text-center">
                                        <td><?php echo $r["guest_name"];?></td>
                                        <td><?php echo $r["designation"];?></td>
                                        <?php if($meetingData["m_action"] != 4){?>
                                        <td>
                                            <div class="custom-control">
                                                <input type="hidden" name="guestAttendance[<?php echo $r["guest_id"];?>]" value="0">
                                                <input type="checkbox" name="guestAttendance[<?php echo $r["guest_id"];?>]" value="1" checked> <!--id="<?php /*echo "customswitch". ++ $count; */?>">-->
                                            </div>
                                        </td><?php }?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table></div></div>
                    <?php if($meetingData["m_action"] != 4){?>
                    <div class="row title-elements" style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                        <input class="btn btn-success" type="submit" name="button" value="Save"/>
                    </div><?php }?>
                </div>
            </form>
    </div>
 </section>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>