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
                <h4 class="card-title"> CUSTOMER LOANS</h4>    
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                                
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
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Customer</label>
                          <select class="form-control form-selectBox" id="customer_loan" name = "cust_id" required>
                            <option value="">--Select Customer--</option>
                            <?php
                          
                            //// need to fetch customer who not a debtor [only drop customers who have l_status - 1]

                                $custom = "SELECT C.cust_id AS cust_id, C.name AS name
                                          FROM customer C 
                                          ";

                                $result1 = mysqli_query($con,$custom);
                                $numRows1 = mysqli_num_rows($result1); 
                 
                                  if($numRows1 > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                      echo "<option value = ".$row1['cust_id'].">" . $row1['cust_id'] . " | " . $row1['name'] . "</option>";
                                      
                                    }
                                  }
                            ?>
                            
                          </select>
                          <div id="show" class="loan-validtion">
                            
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group" >
                        <label>Method</label>
                        <input type="text" name="c_type" id="c_type" class="form-control" required readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group" >
                        <label>Date of obtaining loan</label>
                        <input type="date" name="l_date" id="l_date" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="text" class="form-control customerAmt int_value" placeholder="LKR" id="amount" name="l_amt" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Interest (%)</label>
                        <input type="text" class="form-control customerAmt" placeholder="Interest" id="int" name="interest" required>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1 daily_section" hidden="">
                    <div class="form-group">
                        <label>No. of Installments</label>
                        <input type="text" class="form-control customerAmt" id="no" name="ino_inst" placeholder="XX">
                      </div>
                    </div>
                    <div class="col-md-6 pr-1 monthly_section" hidden="">
                    <div class="form-group">
                        <label>Interest Value(First month) </label>
                        <input type="text" class="form-control" id="int_val" name="int_val" placeholder="LKR">
                      </div>
                    </div>
                  </div>

                  <div class="row daily_section" hidden="">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Paid amount with interest</label>
                        <input type="text" class="form-control " placeholder="LKR" id="paid_amt" name="p_amt">
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Value of installement</label>
                        <input type="text" class="form-control" placeholder="LKR" id="inst_val" name="i_amt">
                      </div>
                    </div>
                  </div>

                  <div class="row daily_section"  hidden="">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Installement Date</label>
                        <input type="text" class="form-control" placeholder="XX/XX/XXXX" id="i_date" name="i_date" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <input type="hidden" name ="submit" value="submit"/>
                      <button type="submit" class="btn btn-primary btn-round">Submit</button>
                      <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">

                      <?php
                          if(isset($_POST['submit'])){
                            $cust_id  = $_POST['cust_id'];
                            $c_type   = $_POST['c_type'];
                            $l_date   = $_POST['l_date'];
                            $l_amt    = $_POST['l_amt'];
                            $interest = $_POST['interest'];
                            $ino_inst = $_POST['ino_inst'];
                            $int_val  = $_POST['int_val'];
                            $l_method = $_POST['l_method'];
                            $p_amt    = $_POST['p_amt'];
                            $i_amt    = $_POST['i_amt'];

                            if($_POST['i_date']!="0"){
                              $nextdate = date('Y-m-d', strtotime($_POST['i_date']));
                            }else{
                              $nextdate = "0000-00-00";
                            }

                            $year =  date("Y");
                            $month = date("m");
                            $createDate = date("Y-m-d");
                  
                            $querySummary = "SELECT id ,loanAMT FROM summary WHERE year='$year' AND month='$month' ";
                            $resultSummary = mysqli_query($con ,$querySummary);

                            $countSummary =mysqli_num_rows($resultSummary);

                            if($countSummary>0){

                                while($rowSummary = mysqli_fetch_array($resultSummary)){

                                    $oldLoanAMT = $rowSummary['loanAMT'];
                                    $id = $rowSummary['id'];
                                }

                                $newLoanAMT = ($oldLoanAMT+$p_amt);

                                $queryRow ="UPDATE summary SET loanAMT='$newLoanAMT' WHERE id='$id' ";
                                $rowRow =mysqli_query($con,$queryRow);

                            }else{

                                $query ="INSERT INTO  summary (year,month,loanAMT,createDate)  VALUES (?,?,?,?)";

                                $stmt =mysqli_stmt_init($con);
                                if(!mysqli_stmt_prepare($stmt,$query))
                                {
                                    echo "SQL Error";
                                }
                                else
                                {
                                    mysqli_stmt_bind_param($stmt,"ssss",$year,$month,$p_amt,$createDate);
                                    $result =  mysqli_stmt_execute($stmt);
                                }

                                for ($x = 1; $x < 13; $x++) {
                              
                                    if($month !=str_pad($x, 2, "0", STR_PAD_LEFT)){

                                      $queryDefult ="INSERT INTO  summary (year,month,createDate)  VALUES (?,?,?)";

                                      $stmt =mysqli_stmt_init($con);
                                      if(!mysqli_stmt_prepare($stmt,$queryDefult))
                                      {
                                          echo "SQL Error";
                                      }
                                      else
                                      {
                                          mysqli_stmt_bind_param($stmt,"sss",$year,str_pad($x, 2, "0", STR_PAD_LEFT),$createDate);
                                          $result =  mysqli_stmt_execute($stmt);
                                      }

                                    }
                                }
                            }

                            $insert2 = "INSERT INTO loan (l_date,amount,interest,l_method,total_amt,installment_value,no_of_installments,int_val,cust_id,i_date,l_status) 
                              VALUES ('$l_date',$l_amt,$interest,'$c_type',$p_amt,$i_amt,$ino_inst,$int_val,'$cust_id','$nextdate',1)";                         
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
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                    cust.ID</th>
                      <th>                    Date</th>
                      <th class="text-right"> Loan</th>
                      <th class="text-right"> Paid amt</th>
                      <th class="text-right"> Rental</th>
                      <th class="text-center">installments</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">View 				</th>
                      <th class="text-center">Delete 			</th>
                      <th class="text-center">More    </th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM loan ORDER BY loan_no DESC");
                      
                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td> <?php echo $row['cust_id'] ?> </td>
                            <td> <?php echo $row['l_date'] ?>  </td>
                            <td class="text-right">   
                              <?php echo number_format($row['amount'],2,'.',',') ?>
                            </td>
                            <td class="text-right">   
                              <?php echo number_format($row['total_amt'],2,'.',',') ?>          
                            </td>
                            <td class="text-right">   
                              <?php echo number_format($row['installment_value'],2,'.',',')?>   
                            </td>
                            <td class="text-center">   
                              <?php  echo $row['no_of_installments'] ?> 
                            </td>
                            <td class="text-center">                      
                              <?php 
                              if($row['l_status']==1){    
                              echo '<label class="btn-sm" style="background-color:#000033; border: 0px; color: #ffffff; font-size: 12px; padding-top: 4px;">'."ACTIVE".'</label>';   
                              }else{
                              echo '<label class="btn-sm" style="background-color:#990000; border: 0px; color: #ffffff; font-size: 12px; padding-top: 4px;">'."CLOSED".'</label>';
                              }
                              ?>  
                            </td>
                            
                            <td class="text-center">  
                              <a href="#" onclick="editView(<?php echo $row['loan_no']; ?>)" name="edit">
                              <i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['loan_no']; ?>')"  name="delete">
                              <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">  
                              <a href="#" onclick="info(<?php echo $row['loan_no']; ?>)" name="info" style="text-decoration: none;">
                              <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
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
   <!-- DataTables JS -->
  <script src="assets/js/jquery.dataTables.js"></script>

<script>

    //////////////////////  DataTable //////////////////
    $(document).ready( function () {
      $('#myTable').DataTable();
    });
    ////////////////////// Table Search /////////////////
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    /////////////////CHECK IF THE CUSTOMER LOAN EXIST//////////////////////////

    $('#customer_loan').on('change', function() {

      $.ajax({
        url: 'cust_loan_verify.php',
        method:"POST",
        data:{cust_id:this.value},
        success: function (response) {//response is value returned from php 
          //alert(data)
          //$('#show').html(response);
          $("#show").removeAttr('class');
          if(response==1){
             $('#show').html("You can get a loan");
             $("#show").css({"color": "green"});
          }else{
             $('#show').html("Already You have a loan");
             $("#show").css({"color": "red"});
             setTimeout(function(){ $("#customer_loan").val("");  $('#show').html("") }, 1500);
          }
          $("#show").css({"padding": "5px" , "font-size":"small"});
        }
      });
    });  

  ////////// SELECT CUSTOMER TYPE //////////  
  $('#customer_loan').on('change', function() {

      $.ajax({
        url: 'get_customerType.php',
        method:"POST",
        data:{"cust_id":this.value},

        success: function (response) {//response is value returned from php 

          var obj = JSON.parse(response);
          var type   =  obj.type

          $('#c_type').val(type);

            if(type=="Daily"){
                $('.daily_section').prop('hidden', false);
                $('.monthly_section').prop('hidden', true);

                $('#no').prop('required', true);
                $('#paid_amt').prop('required', true);
                $('#inst_val').prop('required', true);

            }else{
                $('.daily_section').prop('hidden', true);
                $('.monthly_section').prop('hidden', false);

                $('#int_val').prop('required', true);
            }          
        }
      });
    });  

   ///////////////calc 1st installement date //////////////////
    $('#l_date').on('change',function(){

      var method = $('#c_type').val();
      var start_date = $('#l_date').val();

      const date = new Date(start_date); 

        if(method=="Daily"){

          var day = 60 * 60 * 2 * 24 * 1000; // two days

          const endDate = new Date(date.getTime() + day);

          $('#i_date').val(convert(endDate)); 

        }
        else{ 
          $('#i_date').val(0);
        }

    });

    $('.customerAmt').on('keyup',function(){
        customerAmt()
    });

    function customerAmt(){

      var rate_value = $('#c_type').val();
      var amount = $('#amount').val();
      var int  = $('#int').val();
      var no  = $('#no').val();
      var paid_amt;
      var installement_amt;
      var int_value;

      if(rate_value =='Daily')
      { 
        paid_amt = Number(amount)+(Number(amount)*(Number(int)/100))*Number(no);
        installement_amt = Number(paid_amt)/(Number(no)*30);
        int_value = 0;

      }
      else if(rate_value =="Monthly")
      {
        paid_amt = Number(amount);
        installement_amt = 0;
        int_value = Number(amount)*(Number(int)/100);
        $('#no').val(0);
      }
           
      $('#paid_amt').val(paid_amt.toFixed(2));
      $('#inst_val').val(installement_amt.toFixed(2));
      $('#int_val').val(int_value.toFixed(2));
    
    } 

    function convert(str) {
      var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
      return [date.getFullYear(), mnth, day].join("-");
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

    ////////////////info//////////////
    function info(id){

      $.ajax({
              url:"view_history.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#get_data2').modal('show');
              }
        });
    } 

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

    ///////// Form values reset /////////
    function form_reset(){
      document.getElementById("loanAdd").reset();
    }
   
  </script>

</body>

</html>
<?php
}
?>