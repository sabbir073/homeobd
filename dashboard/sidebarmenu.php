<div class="az-sidebar az-sidebar-sticky az-sidebar-indigo-dark">
    <div class="az-sidebar-header">
        <a href="index.php" class="az-logo">h<span>o</span>me<span>o</span>bd</a>
    </div><!-- az-sidebar-header -->
    <div class="az-sidebar-loggedin">
        <div class="az-img-user online"><img src="./images/user.png" alt="User"></div>
        <div class="media-body">
            <h6><?php echo $name;?></h6>
            <span><?php echo $role;?></span>
        </div><!-- media-body -->
    </div><!-- az-sidebar-loggedin -->
    <div class="az-sidebar-body">
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item active show">
                <a href="index.php" style="position: relative;" class="nav-link"><i
                        class="typcn typcn-clipboard"></i>Dashboard</a>

            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="typcn typcn-user"></i>Users</a>
                <nav class="nav-sub">
                    <a href="all-users.html" class="nav-sub-link">All Users</a>
                    <a href="pending-users.html" class="nav-sub-link">Pending Users</a>
                    <a href="add-users.html" class="nav-sub-link">Add New</a>

                </nav>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-stethoscope" aria-hidden="true"></i>Symptoms</a>
                <nav class="nav-sub">
                    <a href="all-symptoms.html" class="nav-sub-link">All Symtoms</a>
                    <a href="pending-symptoms.html" class="nav-sub-link">Pending Symptoms</a>
                    <a href="add-new-symptoms.html" class="nav-sub-link">Add New</a>

                </nav>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-medkit" aria-hidden="true"></i>Medicines</a>
                <nav class="nav-sub">
                    <a href="allmedicines.php" class="nav-sub-link">All Medicines</a>
                    <a href="pending-medicines.html" class="nav-sub-link">Pending Medicines</a>
                    <a href="add-new-medicines.html" class="nav-sub-link">Add New</a>
                </nav>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-users" aria-hidden="true"></i>Patients</a>
                <nav class="nav-sub">
                    <a href="all-patients.html" class="nav-sub-link">All Patients</a>
                    <a href="pending-patients.html" class="nav-sub-link">Pending Patients</a>
                    <a href="add-new-patient.html" class="nav-sub-link">Add New</a>
                </nav>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" style="position: relative;" class="nav-link"><i class="fa fa-cog"
                        aria-hidden="true"></i>Settings</a>

            </li><!-- nav-item -->
        </ul><!-- nav -->
    </div><!-- az-sidebar-body -->
</div><!-- az-sidebar -->