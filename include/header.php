<?php include("function.php"); ?>

<?php

if(!isset($_SESSION['user_id'])){
  
echo "<script>
window.location= './login.php';
</script>";


}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="include/img/logo/logo-Copy.png" rel="icon">
  <title>TPRA Admin - Dashboard</title>
  <link href="include/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="include/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="include/css/ruang-admin.min.css" rel="stylesheet">
  <link href="include/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="include/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">TPRA Admin</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <!-- <div class="sidebar-heading">
        Features
      </div> -->


  

      <li class="nav-item">
        <a class="nav-link" href="manage_user.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">
          <i class="fas fa-fw fa-comments"></i>
          <span>App Posts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reports.php">
          <i class="fa fa-exclamation-triangle"></i>
          <span>Posts Reports</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="system_report.php">
          <i class="fas fa-fw fa-file"></i>
          <span> Reports </span>
        </a>
      </li>



           

      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="include/logout.php">
          <i class="fas fa-sign-out-alt"></i>
          <span> Logout </span>
        </a>
      </li>
      <!-- <div class="version" id="version-ruangadmin"></div> -->
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->

        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="include/img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">
                <?php
                if(isset($_SESSION['user_name'])){
                  echo $_SESSION['user_name'];
                }else{
                  echo "<script>
                    window.location= './login.php';
                 </script>";
                }
                ?>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a> -->
               
             
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
