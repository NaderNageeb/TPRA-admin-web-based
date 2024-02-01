<?php  include("include/function.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="include/img/logo/logo-Copy.png" rel="icon">
  <title>TPRA - Login</title>
  <link href="include/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="include/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="include/css/ruang-admin.min.css" rel="stylesheet">

</head>




<?php

if(isset($_POST['login'])){

  $user_name = $_POST['username'];
  $password = $_POST['password'];


 Login($user_name, $password);

}



?>



<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <?php if(isset($_GET['error'])){ echo alerts(3,"Wrong User Name or Password !!"); }    ?>
                    <img src="include/img/logo/IMG-2021.jpg" style="width: 200px;">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" action="login.php" method="POST">
                    <div class="form-group">
                      <input type="text" name="username" required="required" class="form-control" 
                        placeholder="Enter User Name">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" required="required" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <!-- <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <input  type="submit" name="login" value="Login" class="btn btn-primary btn-block">
                    </div>
                    <hr>
                
                  </form>
                
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="include/vendor/jquery/jquery.min.js"></script>
  <script src="include/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="include/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="include/js/ruang-admin.min.js"></script>
</body>

</html>