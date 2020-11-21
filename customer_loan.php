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
    Poli App - CUSTOMER LOANS
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
          <li class="active">
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
          <li>
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
      <?php include('include/nav.php');  ?>
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
                 <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Fill Form in here..
                    </button>
                 </div>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">  Customer Loan</h5>
                  </div> 
                <form id="loanAdd">
                  <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Customer</label>
                          <select class="form-control form-selectBox" name = "id" required>
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
                      <div class="form-group" >
                        <label>Date of obtaining loan</label>
                        <input type="date" name="l_date" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="text" class="form-control customerAmt" placeholder="LKR" id="amount" name="l_amt" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Interest (%)</label>
                        <input type="text" class="form-control customerAmt" placeholder="Interest" id="int" name="interest" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                    <div class="form-group">
                        <label>No. of Installments</label>
                        <input type="number" class="form-control customerAmt" id="no" name = "ino_inst" required>
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
                        <input type="text" class="form-control" placeholder="LKR" id="paid_amt" name="p_amt" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Value of installement</label>
                        <input type="text" class="form-control" placeholder="LKR" id="inst_val" name = "i_amt" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <input type="hidden" name ="submit" value="submit"/>
                      <button type="submit" class="btn btn-primary btn-round">Submit</button>
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
                      <th class="text-center">                    Edit 				</th>
                      <th class="text-center">                    Delete 			</th>
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
                              <a href="#" onclick="editView(<?php echo $row['loan_no']; ?>)" name="edit">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['loan_no']; ?>')"  name="delete">
                              <i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div>
  </div>


  <div id="show_view">

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

<script>

    //////  radio button onchange catch  ########## Insert 
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
      var paid_amt;
      var installement_amt;

      if(rate_value =='daily')
      { 
        // paid_amt = amount + (amount*(int/100)*no);
        // installement_amt = (paid_amt/(no*30);
        paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
        installement_amt = Number(paid_amt)/(Number(no)*30);

      }else if(rate_value =="monthly")
      {
        // paid_amt = amount + (amount*(int/100)*no);
        // installement_amt = (paid_amt/no);
        paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
        installement_amt = Number(paid_amt)/Number(no);
      }
      else
      {       
        paid_amt = Number(0);
        installement_amt = Number(0);
      }
      
      $('#paid_amt').val(paid_amt.toFixed(2));
      $('#inst_val').val(installement_amt.toFixed(2));
    
    }); 
    ////////////////////  

    // Form edit 
    function editView(id){

      $.ajax({
              url:"edit_loan.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#Form2').modal('show');
              }
        });
    }
    //////////////////// 

    $('.customerAmt').on('keyup',function(){
        customerAmt()
    });

    function customerAmt(){

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
      var paid_amt;
      var installement_amt;

      if(rate_value =='daily')
      { 
        // paid_amt = amount + (amount*(int/100)*no);
        // installement_amt = (paid_amt/(no*30);
        paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
        installement_amt = Number(paid_amt)/(Number(no)*30);

      }else if(rate_value =="monthly")
      {
        // paid_amt = amount + (amount*(int/100)*no);
        // installement_amt = (paid_amt/no);
        paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
        installement_amt = Number(paid_amt)/Number(no);
      }
      else
      {       
        paid_amt = Number(0);
        installement_amt = Number(0);
      }
      
      $('#paid_amt').val(paid_amt.toFixed(2));
      $('#inst_val').val(installement_amt.toFixed(2));
    
    } 

    ///////////////////////////////////////////////////

    $(function () {

        $('#loanAdd').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'customer_loan.php',
            data: $('#loanAdd').serialize(),
            success: function () {
              swal({
                title: "Good job !",
                text: "Successfully Submited",
                icon: "success",
                button: "Ok !",
                });
                setTimeout(function(){ location.reload(); }, 2500);
               }
          });

        });

      });

    ////////////////////  

    // Form delete 
    function delete_loan(id){

      $.ajax({
              url:"delete_loan",
              method:"POST",
              data:{"id":id},
              success:function(data){
                  swal({
                  title: "Good job !",
                  text: data,
                  icon: "success",
                  button: "Ok !",
                  });
                  setTimeout(function(){ location.reload(); }, 2500);
      
              }
        });
    }

    // delete confirmation javascript
    function confirmation(e,id) {
        swal({
        title: "Are you sure?",
        text: "Want to Delete this recode !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               delete_loan(id)
            } 
        });
    }
    ////////////////////  
   
  </script>

</body>

</html>
<?php
}
?>