<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    if(!isset($_GET["meeting_id"])){
        header("Location:manage-meetings.php");
    }
    $adminID= $_SESSION["user_id"];
    $admin = new \App\classes\Admin();
    if(isset($_POST["button"])){
        $indixes = array_keys($_POST);
        $agendaKeys = array_slice($indixes, 3, (sizeof($indixes) - 8));
        $agendas = [];
        foreach ($agendaKeys as $agendaKey){
            array_push($agendas, $_POST[$agendaKey]);
        }
        $admin->setAgendas($_POST["meeting_id"], $agendas);
        $message = $admin->UpdateMeetingData($_POST, $_GET["meeting_id"]);
    }
    $meetingDataByID=mysqli_fetch_assoc($admin->getMeetingData($_GET["meeting_id"] ,$adminID));
    if($meetingDataByID != NULL){
        $meetingAgendaByID = $admin->getMeetingAgenda($_GET["meeting_id"]);
        $firstAgenda=mysqli_fetch_assoc($meetingAgendaByID);
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
                        <h3 class="m-0 text-center text-dark">Update Meeting</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content ">
            <div class="row">
                <div class="col-sm-8 offset-2">
                    <form class="mb-5" action="" method="POST">
                        <?php if(isset($message)) { ?>
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                                <div class="text-center"><?php echo $message; ?></div>
                            </div>
                        <?php } ?>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="meeting-id">Meeting ID</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="meeting-id" name="meeting_id" value="<?php echo $meetingDataByID["meeting_id"];?>"  readonly />
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="committee-name">Committee Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="committee-name" name="committee_name" value="<?php echo $meetingDataByID["committee_name"]; ?>" readonly />
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="office">Office Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="office" name="office" value="<?php echo $meetingDataByID["office"]; ?>" readonly />
                            </div>
                        </div>
                        <div class="from-group row my-2" id="dynamic_field">
                            <label class="col-sm-3" for="agenda">Agenda</label>
                            <div class="col-sm-9 d-flex" id="row">
                                <input class="form-control" type="text" id="agenda" value="<?php if($meetingDataByID != NULL){ echo $firstAgenda['agenda'];}?>" name="agenda0"  required="required"/>
                                <button type="button" name="add" id="add" class="btn btn-success" style="margin-left:3px">Add</button>
                            </div>
                            <?php
                            if($meetingDataByID != NULL){
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($meetingAgendaByID)){
                             $i++;?>
                                <div class="col-sm-3" id="<?php echo 's'.$i;?>"></div>
                                <div class="col-sm-9 d-flex" style="margin-top: 8px;" id="<?php echo 'r'.$i;?>">
                                    <input class="form-control" type="text" name="<?php echo 'agenda'.$i;?>" value = "<?= $row['agenda']?>" placeholder="<?php echo 'Agenda'.$i;?>" required="required"/>
                                    <button type="button" name="remove" id="<?php echo $i;?>" class="btn btn-danger btn_remove" style="margin-left:3px;width: 55px; width:55px">X</button>
                                </div>
                            <?php }}?>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="date">Date</label>
                            <div class="col-sm-9">
                                <input class="form-control datepicker" type="date" id="date" name="meeting_date" value="<?php echo $meetingDataByID["meeting_date"];?>"required="required"/>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="time">Time</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input class="form-control " type="time" id="time" name="meeting_time_start" value="<?php echo date('H:i', strtotime($meetingDataByID["meeting_time_start"])); ?>" required="required"/>
                                    </div>
                                    <div class="col-sm-1 text-center">
                                        <p>To</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="time" id="time" name="meeting_time_end" value="<?php echo date('H:i', strtotime($meetingDataByID["meeting_time_end"])); ?>" required="required"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="description">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" rows="1"   required="required"><?php echo $meetingDataByID["description"];?></textarea>
                            </div>
                        </div>
                        <div class="row mx-2">
                            <input class="btn btn-success offset-sm-3" type="submit" name="button" value="Update"/>
                        </div>
                </div>
            </div>
            </form>
        </section>
    </div>
<?php include_once "includes/bottom/bottom.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<div class="col-sm-3" id="s'+i+'"></div> <div class="col-sm-9 d-flex" style="margin-top: 8px;" id="r'+i+'"><input class="form-control" type="text" name="agenda'+i+'"  placeholder="Agenda'+i+'" required="required"/><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" style="margin-left:3px;width: 55px; width:55px">X</button></div>');
    });
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#r'+button_id+'').remove();
        $('#s'+button_id+'').remove();
    });
</script>


