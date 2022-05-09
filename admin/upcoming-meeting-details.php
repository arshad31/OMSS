<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $adminID= $_SESSION["user_id"];
    $admin = new \App\classes\Admin();
    if(isset($_GET["meeting_id"])){
        $meetingData=mysqli_fetch_assoc($admin->getMeetingData($_GET["meeting_id"],$adminID));
        if($meetingData != NULL){
            $meetingAgendaByID = $admin->getMeetingAgenda($_GET["meeting_id"]);
            $pdfData = new \App\classes\Pdf( ['meetingData'=>$meetingData,'agenda'=>$meetingAgendaByID]);
        }
    }
    if(isset($_POST["button"])){
        $admin->generatePdf($pdfData->getString());
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
                                <div><?php  $firstAgenda=mysqli_fetch_assoc($meetingAgendaByID);
                                    $sNum=1; if($meetingData != NULL){?>
                                        <?php  echo $sNum."."." ".$firstAgenda['agenda'];}?></div>
                                <?php
                                if($meetingData != NULL){
                                    while ($row = mysqli_fetch_assoc($meetingAgendaByID)){
                                        $sNum++;?>
                                        <div><?php echo $sNum.".".$row['agenda'];?></div>
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
                            <input id="cmd" class="btn btn-primary" type="submit" name="button" value="Get PDF">
                        </div>
                    </div>
                </form>
        </section>
      </div>
<?php include_once "includes/bottom/bottom.php"; ?>