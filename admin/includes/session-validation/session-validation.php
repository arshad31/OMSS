<?php

    session_start();
    /*echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";*/
    if(!isset($_SESSION["user_id"])){
        /* if session is empty user can't access the
            system expect registration and login page
            unless he logs into the system with proper
            credentials.
        */

        header("Location: index.php");
    }
?>