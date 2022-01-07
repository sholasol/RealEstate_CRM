<?php 
//$page=  basename($_SERVER['PHP_SELF']);

include_once "../connect/connect.php";
session_start();

if (isset($_SESSION["id"])){
    $user_id = $_SESSION["id"];
    $userQuery = dbConnect()->prepare("SELECT * FROM users WHERE userID='$user_id'");
    $userQuery->execute();
    $user=$userQuery->fetch();
    
    $lname=$user['lname'];
    $fname =$user['fname'];
    $uid=$user['userID'];
    $email=$user['email'];
    $role=$user['role'];
    $name=$fname.", ".$lname;
    $comp = $uid;
    $branch=$user['branch'];
}else{
    echo  " <script>location.href='../../index'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Account | App</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="../../../images/icon.png">
    <link rel="icon" href="../../../images/icon.png" type="image/x-icon">
	
	<!-- vector map CSS -->
    <link href="../vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />

    <!-- Toggles CSS -->
    <link href="../vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="../vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    
    <!-- Data Table CSS -->
    <link href="../vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="../vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

    
    <!-- select2 CSS -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    
    <!-- jquery-steps css -->
    <link rel="stylesheet" href="../vendors/jquery-steps/demo/css/jquery.steps.css">
    
	<!-- Toastr CSS -->
    <link href="../vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    
    <!-- Toggles CSS -->
    <link href="../vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="../vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    
    <!-- Daterangepicker CSS -->
    <link href="../vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet" type="text/css">
    <style>
.loader {
    border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blueviolet;
  border-right: 16px solid lightgray;
  border-bottom: 16px solid blueviolet;
  border-left: 16px solid lightgray;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  margin:auto;
  
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>

<body>
	
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="index">
                <img class="brand-img d-inline-block" src="../../../images/logo2.png" alt="brand" />
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <li class="nav-item">
                    <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
                </li>
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="../dist/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span><?php echo $name; ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="profile"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                        <div class="dropdown-divider"></div>
                        <div class="sub-dropdown-menu show-on-hover">
                            <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item active">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
                                <span class="feather-icon"><i data-feather="activity"></i></span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                            <ul id="dash_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="project">Projects</a>
                                        </li>
				    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-with-badge" href="javascript:void(0);" data-toggle="collapse" data-target="#app_drp">
                                <span class="feather-icon"><i data-feather="users"></i></span>
                                <span class="nav-link-text">Contacts & Sales</span>
                                <span class="badge badge-brown badge-pill"><i class="fa fa-user"></i></span>
                            </a>
                            <ul id="app_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="lead">Leads</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="contact"> Customer</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="sorder">Sales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="osale">Old Sales Record</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="commission">Consultants</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="family">Family</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                       <!-- <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#auth_drp">
                                <span class="feather-icon"><i data-feather="list"></i></span>
                                <span class="nav-link-text">Pay Grade</span>
                            </a>
                            <ul id="auth_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="salary">Employee Salary</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="salaryC"> Salary Component</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="grade"> Grade</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_drp">
                                <span class="feather-icon"><i data-feather="shopping-cart"></i></span>
                                <span class="nav-link-text">Request</span>
                            </a>
                            <ul id="pages_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                       <li class="nav-item">
                                            <a class="nav-link" href="expense">Expense Request</a>
                                       </li>
                                       <li class="nav-item">
                                            <a class="nav-link" href="leave">Leave Request</a>
                                       </li>
                                       <li class="nav-item">
                                           <a class="nav-link" href="travel">Travel Request</a>
                                       </li>
                                       <!--<li class="nav-item">
                                           <a class="nav-link" href="request">Other Request</a>
                                       </li>-->
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Activities</span>
                        <span>UI</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                       
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#content_drp">
                                <span class="feather-icon"><i data-feather="home"></i></span>
                                <span class="nav-link-text">Loans</span>
                            </a>
                            <ul id="content_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="loan">Loans</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="loanR">Loan Request</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#charts_drp">
                                <span class="feather-icon"><i data-feather="pie-chart"></i></span>
                                <span class="nav-link-text">Reports</span>
                            </a>
                            <ul id="charts_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="sorder">Sales Report</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="expense">Expenses</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#utilities_drp">
                                <span class="feather-icon"><i data-feather="book"></i></span>
                                <span class="nav-link-text"> Setting</span>
                            </a>
                            <ul id="utilities_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="company">Company Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="branchA">Branch Admin</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="salary">Employee Salary</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="salaryC"> Salary Component</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="grade"> Grade</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="statutory">Statutory Dues</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="branch">Branch Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="fyear">Set Financial Year</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="../logout">
                                <span class="feather-icon"><i data-feather="power"></i></span>
                                <span class="nav-link-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

       