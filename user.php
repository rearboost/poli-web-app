<?php
include("db_config.php");
include("msg_show.php");
session_start();
if (!isset($_SESSION['loged_user'])) {
    //echo "Access Denied";
    header('location: login.php');
}else {
$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
mysqli_select_db($con,DB_NAME);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
     Poli App - USER PROFILE
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          POLY APP
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="index">
              <i class="nc-icon nc-bank"></i>
              <p>DASHBOARD</p>
            </a>
          </li>
          <li>
            <a href="customer">
              <i class="nc-icon nc-single-02"></i>
              <p>CUSTOMERS</p>
            </a>
          </li>
          <li class="">
            <a href="customer_loan">
              <i class="nc-icon nc-badge"></i>
              <p>CUSTOMER LOANS</p>
            </a>
          </li>
          <li>
            <a href="debt_collection">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>DEBT COLLECTION</p>
            </a>
          </li>
          <li>
            <a href="cheque_transfer">
              <i class="nc-icon nc-tap-01"></i>
              <p>CHEQUE TRANSFER</p>
            </a>
          </li>
          <li class = "active">
            <a href="user">
              <i class="nc-icon nc-single-02"></i>
              <p>USER PROFILE</p>
            </a>
          </li>         
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
               <li class="nav-item">
                <a class="nav-link" href="notification">
                  <i class="nc-icon nc-bell-55"></i>
                  <h6 style='color:red;'>
                    <?php
                    if($numRows>0){
                      echo " " . $numRows . " NEW ";
                    }
                    ?>
                  </h6>
                </a>
              </li>
              <li class="nav-item">
                Loged as <?php echo $_SESSION['loged_user'] ?>&nbsp; 
                <a href="logout" class="btn btn-danger square-btn-adjust">Logout</a> 
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12"><!-- Begin profile-->
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Edit Login Credintials</h5>
              </div>
              <div class="card-body">
               <div class="row">
                  <div class= "col-md-6">
                      <h5>Change username</h5>
                      <form id="changeUsername">
                        <div class="row">
                          <div class="col-md-8 pr-1">
                            <div class="form-group">
                              <label>Current Username</label>
                              <input type="text" class="form-control"  placeholder="current username" name="old_user" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-8 pr-1">
                            <div class="form-group">
                              <label>New Username</label>
                              <input type="text" class="form-control"  placeholder="New username" name="new_user" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-8 pr-1">
                            <div class="update ml-auto mr-auto">
                              <p style="color: red" id="res_update_user"></p> 
                              <input type="hidden" name ="update_user" value="update_user"/>
                              <button type="submit" class="btn btn-primary btn-round">Update Username</button>
                          </div>
                        </div>
                      </form>
                  </div>
                  <div class= "col-md-6">
                    <h5>Change Password</h5>
                    <form id="changePassword">
                      <div class="row">
                        <div class="col-md-8 pr-1">
                          <div class="form-group">
                            <label>Current Password</label>
                            <input type="text" class="form-control"  placeholder="current password" name="old_pw" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 pr-1">
                          <div class="form-group">
                            <label>New password</label>
                            <input type="text" class="form-control"  placeholder="New password" name="new_pw" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 pr-1">
                          <div class="form-group">
                            <label>Confirm password</label>
                            <input type="text" class="form-control"  placeholder="Confirm password" name="confirm_pw" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 pr-1">
                          <div class="update ml-auto mr-auto">
                            <p style="color: red" id="res_update_pw"></p>
                            <input type="hidden" name ="update_pw" value="update_pw"/> 
                            <button type="submit" class="btn btn-primary btn-round">Update Password</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
               </div>
              </div>
              <?php
                  mysqli_close($con);
              ?>
            </div>
          </div><!-- end profile-->
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Rearboost Innovations
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>
</body>

</html>
<?php
}
?>


<script>

       $(function () {
        $('#changeUsername').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'edit_user.php',
            data: $('#changeUsername').serialize(),
            success: function (data) {

              if(data==1){

                swal({
                title: "Good job !",
                text: "Successfully Submited",
                icon: "success",
                button: "Ok !",
                });
                setTimeout(function(){ location.reload(); }, 2500);

              }else{

                $('#res_update_user').html(data)
              } 
            }
          });
        });
      });

      ///////////////////////////////////////////////////

      $(function () {
        $('#changePassword').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'edit_user.php',
            data: $('#changePassword').serialize(),
            success: function (data) {

              if(data==1){

                swal({
                title: "Good job !",
                text: "Successfully Submited",
                icon: "success",
                button: "Ok !",
                });
                setTimeout(function(){ location.reload(); }, 2500);

              }else{

                $('#res_update_pw').html(data)
              } 
            }
          });
        });
      });


      

</script>