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

<?php  include('./include/head.php');   ?>

<body class="">
  <div class="wrapper ">
    <?php include("include/sidebar.php"); ?>
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
                <h4 class="card-title"> Customer List</h4>     
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                              
              </div>
              </div>
              </div>
              <div class="card-body">
                <?php
                include("card.php");
                ?>
                <center><h4 style="margin-top: 0px;">You have to collected <br> <font color="red">LKR. <?php echo $card_3;?></font></h4></center> <br>

                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                    Customer ID</th>
                      <th>                    Customer</th>
                      <th>                    Address</th>
                      <th>                    Contact</th>
                      <th class="text-right"> Amount</th>
                      <th class="text-center">Status</th>
                    </thead>
                    <tbody>
                      <?php
                      $currentDay1 = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                      $today1 = $currentDay1->format('Y-m-d'); 

                      $sql=mysqli_query($con, "SELECT L.cust_id,L.l_method,L.int_val,L.installment_value FROM loan L LEFT JOIN loan_installement I ON L.loan_no=I.loan_no WHERE L.i_date='$today1' OR I.next_idate ='$today1'");
                      
                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          $customer_id = $row['cust_id'];
                          $get_customer =mysqli_query($con,"SELECT * FROM customer WHERE cust_id='$customer_id'");
                          $cust_data = mysqli_fetch_array($get_customer);

                          ?>
                        <tr>
                          <td> <?php echo $row['cust_id'] ?>       </td>
                          <td> <?php echo $cust_data['name'] ?>  </td>
                          <td> <?php echo $cust_data['address'] ?> </td>
                          <td> <?php echo $cust_data['contact'] ?> </td>
                          <td class="text-right">
                          <?php
                          if($row['l_method']=='Daily'){
                            $amount = $row['installment_value'];
                          }else{
                            $amount = $row['int_val'];
                          }
                           echo number_format($amount,2,".",",") ?>  
                          
                          </td>
                          <td class="text-center"> 
                            <?php 
                            $state = $row['l_method'];
                              if($state=='Daily'){
                                echo '<label class="btn-sm" style="background-color:#3333ff; border: 0px; color: #ffffff; font-size: 12px; padding-top: 4px;">'."DAILY".'</label>';
                              }else{
                                echo '<label class="btn-sm" style="background-color:#ff4d4d; border: 0px; color: #ffffff; font-size: 12px; padding-top: 4px;">'."MONTHLY".'</label>';
                              }

                            ?>      
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
              </div><!-- end card body -->
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
   <!-- DataTables JS -->
  <script src="assets/js/jquery.dataTables.js"></script>
  <script>

    //////////////////////  DataTable //////////////////
    $(document).ready( function () {
      $('#myTable').DataTable();
    });
 
    /////////////////////////////////////// Table Search 
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

   
  </script>

</body>

</html>
<?php
}
?>