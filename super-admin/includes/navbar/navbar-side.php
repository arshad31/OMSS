<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="../assets/dist/img/user.png" alt="Super Admin" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Super Admin</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                <!--<li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            My Meetings
                        </p>
                    </a>
                </li>-->

                <li class="nav-item">
                    <a href="committees.php" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            Committees
                        </p>
                    </a>
                </li>
                <!--<li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            Meetings
                        </p>
                    </a>
                </li>-->


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            Create
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-2">
                        <!--<li class="nav-item">
                            <a href="/OMSS/super-admin/create-meeting.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Meeting</p>
                            </a>
                        </li>-->
                        <li class="nav-item">
                            <a href="/OMSS/super-admin/create-committee.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Committee</p>
                            </a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="/OMSS/super-admin/create-office.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Office</p>
                            </a>
                        </li>-->
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>
                            Manage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-2">
                        <li class="nav-item">
                            <a href="/OMSS/super-admin/manage-users.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/OMSS/super-admin/manage-request.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage User Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/OMSS/super-admin/manage-committee.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Committee</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>