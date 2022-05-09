<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $adminID= $_SESSION["user_id"];
    $admin = new \App\classes\Admin();
    if(isset($_GET["meeting_id"])){
        $meetingData=mysqli_fetch_assoc($admin->getMeetingData($_GET["meeting_id"],$adminID));
        if($meetingData != NULL){
            $meetingAgendaByID = $admin->getMeetingAgenda($_GET["meeting_id"]);
            $firstAgenda=mysqli_fetch_assoc($meetingAgendaByID);
            $agendaDecisionByID=($admin->getAgendaDecisionByMeetingID($_GET["meeting_id"]));
            $agendaDecision=mysqli_fetch_assoc($agendaDecisionByID);
        }
    }
    if(isset($_POST["button"])){
        $message = $admin->setAgendasDecision($_GET["meeting_id"],$_POST);
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
                        <?php if(isset($message)) { ?>
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                                <div class="text-center "><?php echo $message; ?></div>
                            </div>
                        <?php } ?>
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
                                <div><?php $sNum=1; if($meetingData != NULL){?> <input type="hidden" name="agendaId<?php echo $sNum;?>" value="<?php echo $firstAgenda['agenda_id']?>"> <?php  echo $sNum."."." ".$firstAgenda['agenda'];}?></div>
                                <div><textarea name="decision<?php echo $sNum;?>" cols="60" rows="2" placeholder="Agenda Decision" required="required" ><?php echo $agendaDecision['decision'];?></textarea></div>
                                <?php
                                    if($meetingData != NULL){
                                        while ($row = mysqli_fetch_assoc($meetingAgendaByID)){
                                            $rw = mysqli_fetch_assoc($agendaDecisionByID);
                                    $sNum++;?><input type="hidden" name="agendaId<?php echo $sNum;?>" value="<?php echo $row['agenda_id']?>">
                                <div><?php echo $sNum.".".$row['agenda'];?></div>
                                <div><textarea name="decision<?php echo $sNum;?>"  cols="60" rows="2" placeholder="Agenda Decision" required="required"><?php echo $rw['decision'];?></textarea></div>
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
                        <div class="row title-elements" style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                            <input class="btn btn-success" type="submit" name="button" value="Update"/>
                            </div>
                    </div>
            </form>
        </section>
    </div>
<?php include_once "includes/bottom/bottom.php"; ?>