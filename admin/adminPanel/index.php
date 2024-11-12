<?php 
    session_start();
    if(!$_SESSION['auth']){
        header('location: auth/login.php');
    }
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        header('location: auth/login.php');
    }
?>

<?php	 include('includes/header.php');
		 include('includes/navbar.php');		
        //  include_once("../blogAdmin/forms.php");
         ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    
                                    <div>
                                        <span class="font-weight-bold">No New Alert!</span>
                                    </div>
                                </a>
                                
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">No messages!</div>
                                    </div>
                                </a>
                                
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">admin</span>
                                <img class="img-profile rounded-circle"
                                    src="./../../assets/images/avatar.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        <li class="d-flex justify-content-center align-items-center">
                            <a href="logout.php" class="btn btn-sm btn-primary shadow-sm d-flex align-items-center justify-content-center" style="max-height: 20px;">
                            <i class="fas fa-download fa-sm text-white-50" style="margin-right: 5px;"></i> Logout</a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 style="transform: translateX(100px);" class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                </div>
                <div class="row">
                <?php
                    $table='f';

                    if (isset($_GET['table'])){
                        $table = $_GET['table'];
                    }
                    switch ($table) {                    
                        case 'AddAnnouncement':
                            include('./faqadmin/announcements-form.php');
                            break;
                        case 'Blog':
                            include('./faqadmin/blogtable.php');
                            break;
                        case 'AddBlog':
                            include('./faqadmin/blogAdmin.html');
                            break;
                        case 'AddForm':
                            include('./faqadmin/forms.php');
                            break;
                        case 'Forms':
                            include('./faqadmin/formstable.php');
                            break;
                        case 'ShortLink';
                            include('./faqadmin/linkAdmin.php');
                            break;
                        case 'QrCode';
                            include('./faqadmin/QrCode.php');
                            break;
                        case 'AddQrCode';
                           echo  "<iframe src='./faqadmin/qrGenerator/index.html' style='border: 0; width: 100%; height: 100vh' ></iframe>";
                            break;
                        case 'AddLink':
                            include('./faqadmin/linkAdminAdd.php');
                            break;
                        case 'editLink':
                            include('./faqadmin/editLink.php');
                            break;
                        case 'ResponsesForm':
                            include('../blogAdmin/responses.php');
                            break;
                        case 'formCreation':
                            include('./faqadmin/form-created.php');
                            break;
                        case 'Certificate':
                            include('./faqadmin/certificate/admin.php');
                            break;
                        case 'Teams':
                            include('./faqadmin/teams/admin.php');
                            break;
                        case 'joinus':
                            include('./faqadmin/joinus.php');
                            break;
                        case 'AddCertificate':
                            include('./faqadmin/certificate/adminAdd.php');
                            break;
                        case 'AddMember':
                            include('./faqadmin/teams/adminAdd.php');
                            break;
                         case 'AddBulkCertificate':
                            include('./faqadmin/certificate/adminbulkadd.php');
                            break;
                        case 'certificateCreation':
                            include('./faqadmin/certificate/certificate-created.php');
                            break;
                        case 'Contactus':
                            include('./faqadmin/contactusAdmin.php');
                            break;
                        case 'invite':
                            include('./faqadmin/invite/bulkUpload.php');
                            break;
                        case 'Utkrisht':
                            include('./faqadmin/utkrisht/table.php');
                            break;
                        case 'Newsletter':
                            include('./faqadmin/newsletter.php');
                            break;
                        case 'uploadExcel':
                            include('./faqadmin/utkrisht/adminbulkadd.php');
                            break;
                        default:
                            include('./faqadmin/index.php');
                            break;
                        
                    }
                ?>
                </div>

                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->
<?php
	include('includes/scripts.php');
	include('includes/footer.php');
	?>
