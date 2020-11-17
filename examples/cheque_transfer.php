<?php
include("db_config.php");
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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    POLY APP Dashboard by Rearboost Innovations
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet" /> -->

  <link href="../assets/css-4.0/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          POLY APP
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="dashboard.php">
              <i class="nc-icon nc-bank"></i>
              <p>DASHBOARD</p>
            </a>
          </li>
          <li>
            <a href="customer.php">
              <i class="nc-icon nc-single-02"></i>
              <p>CUSTOMERS</p>
            </a>
          </li>
          <li>
            <a href="customer_loan.php">
              <i class="nc-icon nc-badge"></i>
              <p>Customer Loans</p>
            </a>
          </li>
          <li>
            <a href="debt_collection.php">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>DEBT COLLECTION</p>
            </a>
          </li>
          <li  class="active">
            <a href="cheque_transfer.php">
              <i class="nc-icon nc-tap-01"></i>
              <p>CHEQUE TRANSFER</p>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="nc-icon nc-paper"></i>
              <p>CHEQUE DETAIL</p>
            </a>
          </li>
          <li>
            <a href="#">
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
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                Loged as <?php echo $_SESSION['loged_user'] ?>&nbsp; 
                <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
      <div class="row">
          <div class="col-md-12">         
            <div class="card">
              <div class="row">
              <div class="col-md-9">
              <div class="card-header">
                <h4 class="card-title"> Cheque Transfer</h4>                    
              </div>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Form1">+ Add Cheque Transfer..
                </button> 
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cheque Transfer</h5>
                  </div> 
                <form action ="" method="POST">
                  <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Customer</label>
                          <select class="form-control form-selectBox" name = "id">
                            <option value="default">--Select Customer--</option>
                            <?php
                              $custom = "SELECT cust_id, name FROM customer";

                                $result1 = mysqli_query($con,$custom);
                                $numRows1 = mysqli_num_rows($result1); 
                 
                                  if($numRows1 > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                      echo "<option value = ".$row1['cust_id'].">" . $row1['cust_id'] . " | " . $row1['name'] . "</option>";
                                      
                                    }
                                  }
                            ?>
                            
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Bank</label>
                        <input type="text" placeholder="Bank name" name="bank" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Cheque Number</label>
                        <input type="text" class="form-control" placeholder="cheque number" name="cheque_no">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Valid Date</label>
                        <input type="date" class="form-control" name="v_date">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                    <div class="form-group">
                        <label>Exchange Date</label>
                        <input type="date" class="form-control" name = "change_date">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Value of the cheque</label>
                        <input type="text" class="form-control" placeholder="LKR" id="cheque_val" name="cheque_value">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Interest(%)</label>
                        <input type="number" class="form-control" placeholder="0" id="int" name = "interest">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Exchange Value</label>
                        <input type="text" class="form-control" placeholder="LKR" id="exchange_val" name="exchange_value" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">                    
                    <div class="col-md-7 pr-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control form-selectBox" name = "status">
                            <option>--Select Status--</option>
                            <option>Completed</option>
                            <option>NYC</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-primary btn-round">Submit</button>
                      <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>

                      <?php
                          if(isset($_POST['submit'])){
                            $cust_id        = $_POST['id'];
                            $bank           = $_POST['bank'];
                            $cheque_no      = $_POST['cheque_no'];
                            $v_date         = $_POST['v_date'];
                            $change_date    = $_POST['change_date'];
                            $cheque_value   = $_POST['cheque_value'];
                            $interest       = $_POST['interest'];
                            $exchange_value = $_POST['exchange_value'];
                            $status         = $_POST['status'];

                          $insert2 = "INSERT INTO cheque (bank,cheque_no,valid_date,exchange_date,cheque_value,interest,exchange_amt,status,cust_id) 
                            VALUES ('$bank','$cheque_no','$v_date','$change_date',$cheque_value,$interest,$exchange_value,'$status','$cust_id')";  

                          mysqli_query($con,$insert2);
                          // header('location:'.$_SERVER['PHP_SELF']);
                           // $res = mysqli_query($con,$insert2);
                           // if($res){
                           //  unset($_POST);

                           // }
                          }   
                      ?>
                    </div>
                  </div>
                 </div>
                </form>
               </div>
              </div>
            </div>
          
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>                    ID</th>
                      <th>                    Bank</th>
                      <th>                    Cheque No.</th>
                      <th>                    Valid Date</th>
                      <th>                    Exchange Date</th>
                      <th class="text-right"> Cheque Value</th>
                      <th class="text-right"> Interest</th>
                      <th class="text-right"> Exchange Amount</th>
                      <th>                    Status</th>
                      <th>                    cust.ID</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM cheque");
                      
                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td>                    <?php echo $row['cheque_id'] ?>     </td>
                            <td>                    <?php echo $row['bank'] ?>          </td>
                            <td>                    <?php echo $row['cheque_no'] ?>     </td>
                            <td>                    <?php echo $row['valid_date'] ?>    </td>
                            <td>                    <?php echo $row['exchange_date'] ?> </td>
                            <td class="text-right"> <?php echo $row['cheque_value'] ?>  </td>
                            <td class="text-right"> <?php echo $row['interest'] ?>      </td>
                            <td class="text-right"> <?php echo $row['exchange_amt']?>   </td>
                            <td>                    <?php echo $row['status']?>         </td>
                            <td>                    <?php echo $row['cust_id'] ?>       </td>
                            <td class="text-center">  
                              <a href="edit_cheque.php?id=<?php echo $row['cheque_id']; ?>" name="edit">
                              <!--a href="edit_cheque.php?id=<?php  ?>" class="btn btn-success" name="edit"-->
                              <span class="glyphicon glyphicon-edit"></span></a>
                            </td>
                            <td class="text-center">  
                              <a href="delete_cheque.php?id=<?php echo $row['cheque_id']; ?>" name="delete">
                              <span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                          </tr>
                    </tbody>
                           <?php
                        }
                      }
                    ?>                      
                    </table>
                  <?php
                  mysqli_close($con);
                  ?>
                </div>
              </div>
             </div>
            </div>
          </div>
          </div>

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
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>

    $('#int').on('change', function() {

      $.ajax({
        method:"POST",
        data:{interest:this.value},
        success: function (response) {//response is value returned from php (for your example it's "bye bye"
          var amount = $('#cheque_val').val();
          var int  = $('#int').val();
          $('#exchange_val').val((parseFloat(amount)) - (parseFloat(amount))*(parseFloat((int)/100)));
        }
      });
    });  

//     $(document).on("change keyup blur", "#chDiscount", function() {
//   var amd = $('#cBalance').val();
//   var disc = $('#chDiscount').val();
//   if (disc != '' && amd != '')
//     $('#cBalance').val((parseInt(amd)) - (parseInt(disc)));

// }); 
   
  </script>

</body>

</html>
<?php
}
?>