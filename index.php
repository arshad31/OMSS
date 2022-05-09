<?php
    session_start();
    if(isset($_SESSION["super_admin_id"])){
    header("Location: super-admin/dashboard.php");
    }
    if(isset($_SESSION["user_id"])){
        header("Location: users/user-dashboard.php");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>OMMS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <style>
            .starter-template {
                padding: 3rem 1.5rem;
                text-align: center;
                border: 4px solid #563D7C;
                max-width: 50%;
                margin: 150px auto;
                border-radius: 20px;
                box-shadow: 4px 3px;

            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #563D7C">
        <a class="navbar-brand" href="">
            <img src="assets/dist/img/logo.png" width="40" height="30" class="d-inline-block align-top" alt="">
            Online Meeting Management System
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        Login
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!-- <div class="container"> -->
                        <a class="dropdown-item" href="super-admin/">Super Admin</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="users/">Admin/User</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="starter-template">
        <h2>Welcome to</h2>
        <p class="lead mt-3">Online Meeting Management System</>
        <div class="my-4">
<!--            <a href="" type="button" class="btn btn-outline-danger">Enrole now</a>-->
        </div>
    </div>
    </body>
</html>