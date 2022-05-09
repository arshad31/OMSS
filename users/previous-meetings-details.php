<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $user = new \App\classes\User();
    if(isset($_GET["meeting_id"])){
        $meetingData=mysqli_fetch_assoc($user->getMeetingData($_GET["meeting_id"]));
        $guestAttendance = $user->getGuestAttendanceByMeetingID($_GET["meeting_id"]);
        $userAttendance = $user->getUserAttendanceByMeetingID($_GET["meeting_id"]);
        if($meetingData != NULL){
            $meetingAgendaByID = $user->getMeetingAgenda($_GET["meeting_id"]);
            $agendaDecisionByID=$user->getAgendaDecision($_GET["meeting_id"]);
        }
    }
?>

<?php
    include_once "includes/head/head.php";
    include_once "includes/navbar/navbar-top-user.php";
    include_once "includes/navbar/navbar-bottom.php";
    include_once "includes/navbar/navbar-side.php";
?>
    <style>.parent{width: 100%;padding-left: 200px; /*padding-right: 5px;*/padding-top: 0px;padding-bottom: 40px;}  .title{font-weight: bold;}  .title-elements{margin-top: 15px;}</style>
<div class="content-wrapper" id="jspdf">
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
                        <div <?php if($meetingData["m_action"]!=4){?> style="border: 1px solid green"<?php }?>>
                            <?php $firstAgenda=mysqli_fetch_assoc($meetingAgendaByID);
                            $agendaDecision=mysqli_fetch_assoc($agendaDecisionByID);
                            ?>
                            <div>&nbsp;&nbsp;&nbsp;<?php $sNum=1; if($meetingData != NULL){ echo $sNum."."." ".$firstAgenda['agenda'];}?></div>
                            <?php if($meetingData["m_action"]!=4){?><div class="mt-2"><i><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Decision:</b><?php if($meetingData != NULL){ echo " ".$agendaDecision['decision'];}?></i></div><?php }?>
                        </div>
                        <?php
                        if($meetingData != NULL){
                            while ($row = mysqli_fetch_assoc($meetingAgendaByID)){
                                $rw = mysqli_fetch_assoc($agendaDecisionByID);
                                $sNum++;?>
                                <div class="mt-3" <?php if($meetingData["m_action"]!=4){?> style="border: 1px solid green"<?php }?>>
                                    <div>&nbsp;&nbsp;&nbsp;<?php echo $sNum."."." ".$row['agenda'];?></div>
                                    <?php if($meetingData["m_action"]!=4){?><div class="mt-2"><i><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Decision:</b><?php  echo " ".$rw['decision'];?></i></div><?php }?>
                                </div>
                            <?php }}?>
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
                <h4 class="my-3 text-center "><b>Attendance</b></h4>
                <div class="row">
                    <div class="col-sm-8 offset-2">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                            <tr class="bg-info text-center">
                                <th>Name</th>
                                <th>Office</th>
                                <th>Designation</th>
                                <?php if($meetingData["m_action"]!=4){?><th>Attendance</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = mysqli_fetch_assoc($userAttendance)) { ?>
                                <tr class="text-center">
                                    <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
                                    <td><?php echo $row["office"];?></td>
                                    <td><?php echo $row["designation"];?></td>
                                    <?php if($meetingData["m_action"]!=4){ if($row["attendance_status"]!=0){?>
                                        <td>Present</td><?php }else{?>
                                        <td>Absent</td><?php }}?>
                                </tr>
                            <?php } ?>
                            <?php while ($r = mysqli_fetch_assoc($guestAttendance)) { ?>
                                <tr class="text-center">
                                    <td><?php echo $r["guest_name"];?></td>
                                    <td><?php echo $r["office"];?></td>
                                    <td><?php echo $r["designation"];?></td>
                                    <?php if($meetingData["m_action"]!=4){ if($r["attendance_status"]!=0){?>
                                        <td>Present</td><?php }else{?>
                                        <td>Absent</td><?php }}?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php include_once "includes/bottom/bottom.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>