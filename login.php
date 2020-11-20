<?php
include("db_config.php");

    ob_start();
    session_start();
    $outputmsg = "";

    $msg = '';
            
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $con=mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql="SELECT * FROM user WHERE password='$password' AND username='$username'";

        if ($result=mysqli_query($con,$sql)){
            $rowcount=mysqli_num_rows($result);
            switch ($rowcount) {
              case 0:
                  ?><div class='alert alert-danger'> 
                    <strong>Login Error : </strong> Invalid Username or Password </div><?php
                  break;
              case 1:
                //session_start();
                  $_SESSION["loged_user"]= $username;
                  $row = mysqli_fetch_assoc($result);

                  ?><div class='alert alert-danger'> 
                    <strong>Alert : </strong> one user found, directed to Panel page</div><?php 
                    header('Location: index');                  
                break;
              default:
                  ?><div class='alert alert-danger'> 
                    <strong>Alert : </strong> duplicate users found, pls contact system administrator </div><?php 
            }
        }else {
            echo "SQL Query Error";
        }

    }
      ?>


<html lang = "en">
<head>
      <title>Poli App - Login</title>
      <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
      <!-- <link rel="stylesheet" href="css/login.css"> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>            
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>          
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      <link rel="stylesheet" type="text/css" href="assetsLog/login/vendor/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assetsLog/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assetsLog/login/fonts/iconic/css/material-design-iconic-font.min.css">
      <link rel="stylesheet" type="text/css" href="assetsLog/login/vendor/animate/animate.css"> 
      <link rel="stylesheet" type="text/css" href="assetsLog/login/vendor/css-hamburgers/hamburgers.min.css">
      <link rel="stylesheet" type="text/css" href="assetsLog/login/vendor/animsition/css/animsition.min.css">
      <link rel="stylesheet" type="text/css" href="assetsLog/login/vendor/select2/select2.min.css">  
      <link rel="stylesheet" type="text/css" href="assetsLog/login/vendor/daterangepicker/daterangepicker.css">
      <link rel="stylesheet" type="text/css" href="assetsLog/login/css/util.css">
      <link rel="stylesheet" type="text/css" href="assetsLog/login/css/main.css">
</head>
<body>
<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
        <span class="login100-form-title p-b-26">
            User Login 
        </span> 
        <div class = "container form-signin">  </div> <!-- /container -->
        <div class = "container">

         <form class = "form-signin" role = "form"  action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
              <h4 class = "form-signin-heading"></h4>

              <div class="wrap-input100 validate-input" >
                <input  class = "input100" type = "text" name = "username">
                <span class="focus-input100" data-placeholder="Username"></span>
              </div>
              <div class="wrap-input100 validate-input" >
                <span class="btn-show-pass"><i class="zmdi zmdi-eye"></i></span>
                <input  class = "input100" type = "password" name = "password">
                <span class="focus-input100" data-placeholder="Password" required></span>
              </div>
              <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                  <button type = "submit"   class="login100-form-btn"  name = "login">Login</button>
                </div>
              </div>

              <?php echo $msg; ?>
              <br><h5 style="text-align: center ">Click here to clean <a href = "logout.php" tite = "Logout">Session. </a></h5>

         </form>
      </div>
    </div> 
  </div>
</div>
<script src="assetsLog/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="assetsLog/login/vendor/animsition/js/animsition.min.js"></script>
<script src="assetsLog/login/vendor/bootstrap/js/popper.js"></script>
<script src="assetsLog/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assetsLog/login/vendor/select2/select2.min.js"></script>
<script src="assetsLog/login/vendor/daterangepicker/moment.min.js"></script>
<script src="assetsLog/login/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assetsLog/login/vendor/countdowntime/countdowntime.js"></script>
<script src="assetsLog/login/js/main.js"></script>
</body>
</html>