<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="../assets/dist/img/user.png" alt="Super Admin" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $_SESSION["first_name"]." ".$_SESSION["last_name"];?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="user-dashboard.php" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            My Meetings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-2">

                        <li class="nav-item">
                            <a href="./upcoming-meetings.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upcoming Meetings </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="./previous-meetings.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Previous Meetings</p>
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
        </nav>
    </div>
</aside>