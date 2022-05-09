<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $adminID= $_SESSION["user_id"];
    $adminName= $_SESSION["first_name"]." ".$_SESSION["last_name"];
    $admin = new \App\classes\Admin();
    if(isset($_GET["meeting_id"])){
        $meetingID = $_GET["meeting_id"];
        $meetingData=mysqli_fetch_assoc($admin->getMeetingData($meetingID, $adminID));
        if($meetingData != NULL){
            $meetingAgendaByID = $admin->getMeetingAgenda($meetingID);
            $firstAgenda=mysqli_fetch_assoc($meetingAgendaByID);
        }
    }
    $committeeUserEmil = $admin->getCommitteeUserEmailByCommitteeID($meetingData["committee_id"]);
    $guestEmail=$admin->getGustEmailByMeetingID($meetingID);
    if(isset($_POST["button"])){
        $splitMail=explode (",", $_POST["mail"]);
        $fName= $_FILES['file']['name'];
        $fTmpName= $_FILES['file']['tmp_name'];
        $path='../PDF/'.$fName;
        move_uploaded_file($fTmpName,$path);
        $message = $admin->sendMail($_POST,$splitMail,$adminName,$path);
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
                        <h3 class="m-0 text-center text-dark">Send Mail</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-8 offset-2">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php if(isset($message)) { ?>
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                                <?php echo $message; ?>
                            </div>
                        <?php } ?>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="mail-to">To</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="mail" rows="1"  required="required">
                                    <?php while ($row = mysqli_fetch_assoc($committeeUserEmil)){echo $row['email'].",";}?>
                                    <?php while ($r = mysqli_fetch_assoc($guestEmail)){echo $r['email'].",";}?>
                                </textarea>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="mail-subject">Subject</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="subject" name="subject"  required="required"/>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="mail-subject">Address as</label>
                            <div class="col-sm-9">
                                <p><input class="form-control" type="text" id="subject" name="body-one"  required="required"/></p>
                            </div>
                        </div>
                        <br>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="mail-subject">Body</label>
                            <div class="col-sm-9">
                                <p><textarea class="form-control" name="body-two" rows="1"  required="required"></textarea></p>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="mail-body"></label>
                            <div class="col-sm-9">
                               <textarea class="form-control" name="body-three" rows="1"  required="required" style="display: none">
                               <section style="color:black;">
                                   <table border="10" cellpadding="10" cellspacing="1"  style="border-color: #96D4D4;">
                                        <tbody>
                                            <tr>
                                                <td><strong>Meeting ID:</strong></td>
                                                <td><?php echo $meetingData["meeting_id"];?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Committee Name:</strong></td>
                                                <td><?php echo $meetingData["committee_name"];?></td>
                                            </tr>
                                                                       <tr>
                                                <td><strong>Office:</strong></td>
                                                <td><?php echo $meetingData["office"];?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Agenda:</strong></td>
                                                <td>
                                                <p><?php $sNum=1; if($meetingData != NULL){ echo $sNum."."." ".$firstAgenda['agenda'];}?></p>
                                                <?php
                                                if($meetingData != NULL){
                                                    while ($row = mysqli_fetch_assoc($meetingAgendaByID)){
                                                        $sNum++;?>

                                                        <p><?php echo $sNum."."." ".$row['agenda'];?></p>
                                                    <?php }}?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date:</strong></td>
                                                <td><?php echo strtoupper(date_format(date_create($meetingData["meeting_date"]),"d/m/Y")); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Time:</strong></td>
                                                <td><?php echo date('h:i A', strtotime($meetingData["meeting_time_start"]))?>  to  <?php echo date('h:i A', strtotime($meetingData["meeting_time_start"])); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Description:</strong></td>
                                                <td>
                                                    <div><?php echo $meetingData["description"];?></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                   </table>
                                   <br>
                                   <div>Regards,</div>
                                   <div><b><?php echo $adminName?></b></div>
                                   <div>Admin, <?php echo " ".$meetingData["committee_name"]." ";?>Committee</div>
                               </section>
                                </textarea>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="mail-subject">Attach File</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" accept=".pdf,.doc,.docx" id="file" name="file" value="" />
                            </div>
                        </div>
                        <div class="row mx-2">
                            <input class="btn btn-success offset-sm-3" type="submit" name="button" value="Send"/>
                        </div>
                </div>
            </div>
            </form>
        </section>
    </div>
<?php include_once "includes/bottom/bottom.php"; ?>