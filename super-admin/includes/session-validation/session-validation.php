<?php
    session_start();
    if(!isset($_SESSION["super_admin_id"])){
        /* if session is empty user can't access the system except registration and login page
            unless he logs into the system with proper credentials.
        */
        /*echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";*/
        header("Location: index.php");
    }
?>