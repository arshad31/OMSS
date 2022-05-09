<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #563D7C;">
    <a class="navbar-brand" href="">
        <img src="../assets/dist/img/logo.png" width="40" height="30" class="d-inline-block align-top" alt="">
        Online Meeting Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                    Admin/User
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="z-index: 2000">
                    <!-- <div class="container"> -->
                    <?php if($_SESSION["is_admin"]){?>
                        <a class="dropdown-item" href="./user-profile.php">Profile</a>
                        <a class="dropdown-item" href="../admin/admin-dashboard.php">Admin</a>
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                    <?php }else{?>
                        <a class="dropdown-item" href="./user-profile.php">Profile</a>
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                    <?php }?>
                </div>
            </li>
        </ul>
    </div>
</nav>