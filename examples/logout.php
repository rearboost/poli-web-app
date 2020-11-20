<?php
include("db_config.php"); 
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
        	
        </title>

      <title>Poly App</title>
       
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>            
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>          
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/login.css">
      <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
      <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
      <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css"> 
      <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
      <link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
      <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">  
      <link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
      <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
      <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">

    </head>



<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
        <span class="login100-form-title p-b-26">
            LOGOUT
        </span> 
        <div class = "container form-signin">  </div> <!-- /container -->
        <div class = "container">
        	<!-- <h2>You have cleaned session</h2> -->


                <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                   <a href="login.php"  style="text-decoration: none; color: white">
                    <button type="submit" class="login100-form-btn">Back to Login</button></a>
                </div>
              </div>

        </div>
    </div>
    </div>
    </div> 
   

<?php
session_start();
unset($_SESSION['username']);
session_destroy();
?>

<script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
<script src="assets/login/vendor/bootstrap/js/popper.js"></script>
<script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/login/vendor/select2/select2.min.js"></script>
<script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
<script src="assets/login/js/main.js"></script>
 </body>
</html>
