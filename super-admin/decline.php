<?php
    require_once "../vendor/autoload.php";
    $superAdmin = new \App\classes\SuperAdmin();
    include_once "includes/session-validation/session-validation.php";
    if(isset($_GET["user_id"])){
        $userId = $_GET["user_id"];
        $superAdmin->declineUserRequest($userId);
    }
?>

<?php
    /* necessary common layouts inclusion goes here */
    include_once "includes/head/head.php";
    include_once "includes/navbar/navbar-top-super-admin.php";
    include_once "includes/navbar/navbar-bottom.php";
    include_once "includes/navbar/navbar-side.php";
?>
    <h3 class="m-0 text-center text-dark">Declain Requests</h3>

<?php include_once "includes/bottom/bottom.php"; ?>