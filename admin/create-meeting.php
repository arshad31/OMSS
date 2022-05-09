<?php
    include_once "includes/session-validation/session-validation.php";
    require_once "../vendor/autoload.php";
    $adminID= $_SESSION["user_id"];
    $admin = new \App\classes\Admin();
    if(isset($_GET["committee_id"])) {
        $committeeId = $_GET["committee_id"];
        $committeeData = mysqli_fetch_assoc($admin->getCommitteeInfoByCommitteeID($committeeId));
    }
    if(isset($_POST["meetingId"])){
        $admin->setGuestData($_POST);
    }
    if(isset($_POST["button"])){
        $indexes = array_keys($_POST);
        $agendaKeys = array_slice($indexes, 3, (sizeof($indexes) - 8));
        $agendas = [];
        foreach ($agendaKeys as $agendaKey){
            array_push($agendas, $_POST[$agendaKey]);
        }
        $admin->setMeetingData($_POST, $adminID, $committeeId);
        $message = $admin->setAgendas($_POST["meeting_id"], $agendas);
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
                        <h3 class="m-0 text-center text-dark">Create Meeting</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-8 offset-2">
                    <form action="" method="POST">
                        <?php if(isset($message)) { ?>
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                                <div class="text-center"><?php echo $message; ?></div>
                            </div>
                        <?php } ?>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="meeting-id">Meeting ID</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="meeting-id" name="meeting_id" placeholder="Meeting ID" required="required" />
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="committee-name">Committee Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="committee-name" name="committee_name" value="<?php echo $committeeData["committee_name"]; ?>" readonly />
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="office">Office Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="office" name="office" value="<?php echo $committeeData["office"]; ?>" readonly />
                            </div>
                        </div>
                        <div class="from-group row my-2" id="dynamic_field">
                            <label class="col-sm-3" for="agenda">Agenda</label>
                            <div class="col-sm-9 d-flex" id="row">
                                <input class="form-control" type="text" id="agenda" name="agenda1" placeholder="" required="required"/>
                                <button type="button" name="add" id="add" class="btn btn-success" style="margin-left:3px">Add</button>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="date">Date</label>
                            <div class="col-sm-9">
                                <input class="form-control datepicker" type="date" id="date" name="date" required="required"/>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="time">Time</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input class="form-control " type="time" id="time" name="time_from" required="required"/>
                                    </div>
                                    <div class="col-sm-1 text-center">
                                        <p>To</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="time" id="time" name="time_to" required="required"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="from-group row my-2">
                            <label class="col-sm-3" for="description">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" rows="1" placeholder="Write short description ... " required="required"></textarea>
                            </div>
                        </div>
                        <div class="row mx-2 d-flex">
                            <input class="btn btn-success offset-sm-3" type="submit" name="button" value="Create Meeting"/>
                        </div>
                </div>
            </div>
            </form>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="exampleModalLabel">Add Guest Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--   Table Start   -->
                            <form id="modal-form" method="POST" action="">
                                <div class="from-group row my-2">
                                    <label class="col-sm-3" for="meeting-id">Meeting ID</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="meeting-id" name="meetingId" placeholder="Meeting ID" required="required" />
                                    </div>
                                </div>
                                <div class="from-group row my-2">
                                    <label class="col-sm-3" for="committee-name">Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="guest-name" name="guest_name" placeholder="Guest Name" required="required" />
                                    </div>
                                </div>
                                <div class="from-group row my-2">
                                    <label class="col-sm-3" for="committee-name">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" id="email" name="email" placeholder="Email" required="required" />
                                        <small class="invalid-feedback">Invalid email address!</small>
                                    </div>
                                </div>
                                <div class="from-group row my-2">
                                    <label class="col-sm-3" for="office">Office Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="office" name="office" placeholder="Office Name" required="required" />
                                    </div>
                                </div>
                                <div class="from-group row my-2">
                                    <label class="col-sm-3" for="office">Designation</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="designation" name="designation" placeholder="Designation" required="required" />
                                    </div>
                                </div>
                            </form>
                            <!--   Table End   -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="modal-save-btm"  class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" style="border-radius: 50px;" class="btn btn-primary btn-icon float-xl-right mr-lg-5" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-user"></i> Guest!
            </button>
        </section>
    </div>

<?php include_once "includes/bottom/bottom.php"; ?>
<!--Dynamic Add Remove-->
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
    //Modal data
    $('#modal-save-btm').click(function () {
        $('#modal-form').submit();
    })
</script>


