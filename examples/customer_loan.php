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
          <li class="active">
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
          <li>
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
                <h4 class="card-title"> CUSTOMER LOANS</h4>                    
              </div>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Form1">+ Fill Form in here..
                </button>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">  Customer Loan</h5>
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
                        <label>Date of obtaining loan</label>
                        <input type="date" name="l_date" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="text" class="form-control" placeholder="LKR" id="amount" name="l_amt">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Interest (%)</label>
                        <input type="number" class="form-control" placeholder="Interest" id="int" name="interest">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                    <div class="form-group">
                        <label>No. of Installments</label>
                        <input type="number" class="form-control" id="no" name = "ino_inst">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 pr-3">
                    <div class="form-group" id="rates">
                        <label>
                          <input type="radio" id="r1" name="l_method" value="daily"> Daily
                        </label><br>
                        <label>
                          <input type="radio" id="r2" name="l_method" value="monthly"> Monthly
                        </label><br>
                        <label>
                          <input type="radio" id="r3" name="l_method" value="declining"> Declining Balance Method
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Paid amount with interest</label>
                        <input type="text" class="form-control" placeholder="LKR" id="paid_amt" name="p_amt">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Value of installement</label>
                        <input type="text" class="form-control" placeholder="LKR" id="inst_val" name = "i_amt">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-primary btn-round">Submit</button>
                      <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>

                      <?php
                          if(isset($_POST['submit'])){
                            $id       = $_POST['id'];
                            $l_date   = $_POST['l_date'];
                            $l_amt    = $_POST['l_amt'];
                            $interest = $_POST['interest'];
                            $ino_inst = $_POST['ino_inst'];
                            $l_method = $_POST['l_method'];
                            $p_amt    = $_POST['p_amt'];
                            $i_amt    = $_POST['i_amt'];

                          $insert2 = "INSERT INTO loan (l_date,amount,interest,l_method,total_amt,installment_value,no_of_installments,cust_id) 
                            VALUES ('$l_date',$l_amt,$interest,'$l_method',$p_amt,$i_amt,$ino_inst,'$id')";                         
                          mysqli_query($con,$insert2);
                          }
                      ?>
                    </div>
                  </div>
                  </div>
                </form>
              </div>
              </div>
              </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>                    ID</th>
                      <th>                    Date</th>
                      <th class="text-right"> Loan</th>
                      <th class="text-right"> Interest(%)</th>
                      <th class="text-right"> No.installments</th>
                      <th>                    Method</th>
                      <th class="text-right"> paid amt</th>
                      <th class="text-right"> Installment value</th>                      
                      <th>                    cust.ID</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM loan");
                      
                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td>                      <?php echo $row['loan_no'] ?>            </td>
                            <td>                      <?php echo $row['l_date'] ?>             </td>
                            <td class="text-right">   <?php echo $row['amount'] ?>             </td>
                            <td class="text-right">   <?php echo $row['interest'] ?>           </td>
                            <td class="text-right">   <?php echo $row['no_of_installments'] ?> </td>
                            <td>                      <?php echo $row['l_method'] ?>           </td>
                            <td class="text-right">   <?php echo $row['total_amt'] ?>          </td>
                            <td class="text-right">   <?php echo $row['installment_value']?>   </td>
                            <td>                      <?php echo $row['cust_id'] ?>            </td>
                            <td class="text-center">  
                              <a href="edit_loan.php?id=<?php echo $row['loan_no']; ?>" name="edit">
                              <!--a href="edit_cheque.php?id=<?php  ?>" class="btn btn-success" name="edit"-->
                              <span class="glyphicon glyphicon-edit"></span></a>
                            </td>
                            <td class="text-center">  
                              <a href="delete_loan.php?id=<?php echo $row['loan_no']; ?>" name="delete">
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

    $('#rates').change(function(){

      if (document.getElementById('r1').checked) {
        rate_value = document.getElementById('r1').value;
      }
      else if(document.getElementById('r2').checked) {
        rate_value = document.getElementById('r2').value;
      }
      else if(document.getElementById('r3').checked) {
        rate_value = document.getElementById('r3').value;
      }

      var amount = $('#amount').val();
      var int  = $('#int').val();
      var no  = $('#no').val();

      if(rate_value =='daily')
      {           
        $('#inst_val').val(((parseFloat(paid_amt)) / no) / (30)) ;
      }
      else if(rate_value =='monthly')
      {
        $('#inst_val').val((parseFloat(paid_amt)) / no) ;
      }
      else
      {
        $('#paid_amt').val()="" ;
        $('#inst_val').val() = "" ;
      }

      $('#paid_amt').val((parseFloat(amount)) + ((parseFloat(amount))*(parseFloat((int)/100))*(parseint(no))) ;

    });   
   
  </script>

</body>

</html>
<?php
}
?>