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
                <h4 class="card-title"> DEBT COLLECTION WITH INTEREST</h4>     
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
                    <h5 class="modal-title" id="staticBackdropLabel">Debt Collection</h5>
                  </div>
                <form id="collectionDebt">
                  <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Customer</label>
                          <select class="form-control form-selectBox" id="custom_id" name="id" required>
                            <option value="default">--Select Customer--</option>
                            <?php
                              //$custom = "SELECT cust_id, name FROM customer ";

                              $custom = "SELECT C.cust_id AS cust_id  , C.name AS name
                                          FROM customer C 
                                          INNER JOIN  loan L
                                          ON C.cust_id = L.cust_id
                                          WHERE L.l_status = 1;";

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
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control form-selectBox" name="li_date" id="li_date" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Remaining amount</label>
                        <input type="text" class="form-control" id="remain_amt" name="remain_amt" value="" readonly required>
                        <!-- start hidden area -->
                        <input type="hidden" class="form-control" id="tot_int" name="tot_int" readonly>
                        <input type="hidden" class="form-control" id="new_loan" name="new_loan" readonly>
                        <input type="hidden" class="form-control" id="new_int" name="new_int" readonly>
                        <!-- <input type="text" class="form-control" id="real_remain_amt" name="real_remain_amt" readonly> -->
                        <!-- end hidden area -->
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="text" class="form-control" id="loan_amt" name="l_amt" readonly>
                        <!-- start hidden area -->
                        <input type="hidden" class="form-control" id="c_type"readonly>
                        <input type="hidden" class="form-control" id="end_date"readonly>
                        <!-- end hidden area -->
                      </div>
                    </div>
                  </div>  

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Installment amount</label>
                        <input type="text" class="form-control checkAmt" placeholder="LKR" id="inst_amt" name="i_amt" required>
                      </div>
                    </div>               
                    <div class="col-md-6 pr-1 monthly_section" hidden="">
                      <div class="form-group">
                        <label>Interest amount</label>
                        <input type="text" class="form-control checkAmt" placeholder="LKR" id="int_amount" name="int_amt">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Next Installment Date</label>
                        <input type="text" class="form-control" id="next_idate" name="next_idate" required>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Previous Rental Date</label>
                        <input type="text" class="form-control" id="pre_date"readonly>
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
                            $custom_id  = $_POST['id'];
                            $li_date    = $_POST['li_date'];
                            $remain_amt = $_POST['remain_amt'];
                            $new_loan   = $_POST['new_loan'];
                            $new_int    = $_POST['new_int'];//update query
                            $i_amt      = $_POST['i_amt'];
                            $int_amt    = $_POST['int_amt'];
                            
                            $next_idate = date('Y-m-d', strtotime($_POST['next_idate']));

                            $year =  date("Y");
                            $month = date("m");
                            $createDate = date("Y-m-d");
                  
                            $querySummary = "SELECT id ,debtAMT FROM summary WHERE year='$year' AND month='$month' ";
                            $resultSummary = mysqli_query($con ,$querySummary);

                            $countSummary =mysqli_num_rows($resultSummary);

                            if($countSummary>0){

                                while($rowSummary = mysqli_fetch_array($resultSummary)){

                                    $oldDebtAMT = $rowSummary['debtAMT'];
                                    $id = $rowSummary['id'];
                                }

                                $newDebtAMT = ($oldDebtAMT+$i_amt+$int_amt);

                                $queryRow ="UPDATE summary SET debtAMT='$newDebtAMT' WHERE id='$id' ";
                                $rowRow =mysqli_query($con,$queryRow);

                            }else{

                                $query ="INSERT INTO  summary (year,month,debtAMT,createDate)  VALUES (?,?,?,?)";

                                $stmt =mysqli_stmt_init($con);
                                if(!mysqli_stmt_prepare($stmt,$query))
                                {
                                    echo "SQL Error";
                                }
                                else
                                {
                                    mysqli_stmt_bind_param($stmt,"ssss",$year,$month,$i_amt,$createDate);
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

                          $data = mysqli_query($con,"SELECT l.loan_no, l.amount FROM customer c , loan l WHERE c.cust_id = l.cust_id AND l.cust_id = '$custom_id' AND l.l_status = 1");
                          		$row_l = mysqli_fetch_assoc($data);
                          		$loan_no = $row_l['loan_no'];
                          		$loan_amount = $row_l['amount'];

                          $insert = mysqli_query($con,"INSERT INTO loan_installement (li_date,installement_amt,interest_amt,remaining_amt,loan_no,next_idate,new_loan) VALUES ('$li_date',$i_amt,$int_amt,$remain_amt,$loan_no,'$next_idate',$new_loan)");
                          ///// update interest amount /////
                          $update_int = mysqli_query($con,"UPDATE loan SET int_val='$new_int' WHERE loan_no='$loan_no' ");

                          if($remain_amt <= 0){
                            $update_status = mysqli_query($con,"UPDATE loan SET l_status =0 WHERE loan_no=$loan_no");
                          }
                          
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
                  	  <th>                    ID 				  </th>
                      <th>                    Date        </th>
                      <th class="text-right"> Rental 	    </th>
                      <th class="text-right"> Interest 		</th>
                      <th class="text-right"> Remaining 	</th>
                      <th>                    NEXT Rental </th>
                      <th class="text-right"> Loan   			</th>
                      <!-- <th class="text-center">Edit 				</th> -->
                      <th class="text-center">Delete 			</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql="SELECT * FROM loan_installement ORDER BY id DESC";
                      
                      $result = mysqli_query($con,$sql);
                      $numRows = mysqli_num_rows($result); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                        	?>
                            
                            <tr>
                            <td>                      
                              <?php echo $row['id']  ?>              
                            </td>
                            <td>                      
                              <?php echo $row['li_date']  ?>         
                            </td>
                            <td class="text-right">   
                              <?php echo number_format($row['installement_amt'],2,'.',',')  ?>
                            </td>
                            <td class="text-right">   
                              <?php echo number_format($row['interest_amt'],2,'.',',') ?>     
                            </td>
                            <td class="text-right">   
                              <?php echo number_format($row['remaining_amt'],2,'.',',') ?>    
                            </td>
                            <td><?php echo $row['next_idate']  ?> </td>
                            <td class="text-center">   
                              <?php echo $row['loan_no']  ?>         
                            </td>
                            <!-- <td class="text-center">   -->
                            	<!-- <a href="edit_debt.php?id=<?php //echo $row['id']; ?>" name="edit"> -->
                             <!--  <a href="#" onclick="editView(<?php // echo $row['id']; ?>)" name="edit">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
                          	<!-- </td> -->
                          	<td class="text-center">  
                            	<a href="#" onclick="confirmation('event','<?php echo $row['id']; ?>')" name="delete">
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
  <!-- <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> -->
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
      //$('new_remain_amt').prop('hidden', true);
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
  ///////////////////////////////////////////

  // fetch remain amount and loan amount from remain_amt.php
  $('#custom_id').on('change', function() {

      $.ajax({
        url: 'remain_amt.php',
        method:"POST",
        data:{id:this.value},
        success: function (response) {

          var obj = JSON.parse(response);
          $('#remain_amt').val(obj.remain_amt);
          $('#loan_amt').val(obj.loan_amt);
          $('#pre_date').val(obj.fix_date);
          $('#end_date').val(obj.end_date);

          var l_method = obj.l_method
          $('#c_type').val(l_method);

          var start_date = obj.end_date

          const date = new Date(start_date);
            if(l_method=="Daily"){
                $('.daily_section').prop('hidden', false);
                $('.monthly_section').prop('hidden', true);

                date.setDate(date.getDate() + 2); 
            }else{
                $('.daily_section').prop('hidden', true);
                $('.monthly_section').prop('hidden', false);

                $('#int_amount').prop('required', true);

                date.setDate(date.getDate() + 31); 
            }
     
          const zeroPad = (num, places) => String(num).padStart(places, '0') 
        
          var dd = date.getDate();
          var mm = date.getMonth() + 1;
          var y = date.getFullYear();

          var end_date = zeroPad(mm, 2) + '/'+ zeroPad(dd, 2) + '/'+ y;

          $('#next_idate').val(end_date);

        }
      });
    });  

  $('#li_date').on('change', function() {

      var customer_id = $('#custom_id').val();
      var new_remain;

      $.ajax({
        url: 'remain_amt.php',
        method:"POST",
        data:{id:customer_id},
        success: function (response) {
          var obj = JSON.parse(response);
          var int_val   =  obj.int_val
          var l_method  =  obj.l_method
          var remain_amt=  obj.remain_amt
          var tot_int;
          var pre_date  =  $('#pre_date').val();
          var now_date  =  $('#li_date').val();

          const oneDay = 24 * 60 * 60 * 1000; //hours*minutes*seconds*milliseconds

          const firstDate = new Date(pre_date);
          const secondDate = new Date(now_date);

          monthDiff = monthDiff(firstDate,secondDate);
          alert(monthDiff);

          /// need to calculate number of months in above date range (firstDate and secondDate)
          
          const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
          if(l_method=='Monthly'){
              var a = Number(diffDays);
              var b = 30;
              var c = a % b;
              var x;
                if(c>=1){
                  x = (a - c) / b;
                }else{
                  x = a / b;
                }
                tot_int = Number(int_val)*x;
                new_remain = Number(remain_amt)+Number(tot_int);

              $('#tot_int').val(tot_int.toFixed(2));
              $('#remain_amt').val(new_remain.toFixed(2));
          }

           /////////// calc end date //////////
            //var start_date = $('#li_date').val();
            var start_date = obj.end_date

            const date = new Date(start_date);

            alert(start_date);

            alert(l_method)

              if(l_method=="Daily"){
                date.setDate(date.getDate() + 2); 
              }else{
                //////// need to add one month to const date

                dt = new Date(date.getFullYear(),date.getMonth(),date.getDate());
                console.log(add_months(dt, 1).toString());

                gdt = new Date(add_months(dt, 1).toString()); 

                const zeroPad = (num, places) => String(num).padStart(places, '0')

                getdt = gdt.getFullYear()+'-'+  zeroPad(gdt.getMonth(),2)+'-'+zeroPad(gdt.getDate(),2);

                alert(getdt)
                

              //  date.setDate(date.getDate() + 31); 
              }
       
            // const zeroPad = (num, places) => String(num).padStart(places, '0') 
          
            // var dd = date.getDate();
            // var mm = date.getMonth() + 1;
            // var y = date.getFullYear();

            // var end_date = zeroPad(mm, 2) + '/'+ zeroPad(dd, 2) + '/'+ y;

            $('#next_idate').val(getdt);

        }
      });
    });  

    // Add months Fun
    function add_months(dt, n) 
    {
      return new Date(dt.setMonth(dt.getMonth() + n));        
    }

    // Month Diff Fun
    function monthDiff(d1, d2) {
      var months;
      months = (d2.getFullYear() - d1.getFullYear()) * 12;
      months -= d1.getMonth() + 1;
      months += d2.getMonth();
      return months <= 0 ? 0 : months;
    }

    /////////////////calc amounts ////////////////////

    $('.checkAmt').on('keyup',function(){
        checkAmt()
    })

    function checkAmt(){

      var l_method          = $('#c_type').val();
      var installement_amt  = $('#inst_amt').val();
      var interest_amt      = $('#int_amount').val();
      var tot_int           = $('#tot_int').val();;
      var id                = $('#custom_id').val();
      var new_loan;
      var new_int;


      $.ajax({
        url: 'remain_amt.php',
        method:"POST",
        data:{id:id},
        success: function (response) {

          var obj = JSON.parse(response);
          var remain_amt   = obj.remain_amt
          var old_loan     = obj.old_loan
          var interest     = obj.interest

          if(l_method=='Daily')
          {
            remain_amt = Number(remain_amt)-Number(installement_amt);  
      
            $('#remain_amt').val(remain_amt.toFixed(2));
            $('#int_amount').val(0);         
            $('#new_int').val(0); 
            $('#new_loan').val(0);  
          }
          else
          {
            new_loan = Number(old_loan)-Number(installement_amt);
            new_int = Number(new_loan)*(Number(interest)/100);

            remain_amt = (Number(remain_amt)+Number(tot_int))-(Number(installement_amt)+Number(interest_amt));  
      
            $('#new_loan').val(new_loan.toFixed(2));           
            $('#new_int').val(new_int.toFixed(2));           
            $('#remain_amt').val(remain_amt.toFixed(2));                
          }
          /// end if ///
        }

      });
    }  
 
    ////////// Form edit ////////////
    function editView(id){

      $.ajax({
              url:"edit_debt.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#Form2').modal('show');
              }
        });
    }
    //////////////////// 

     $(function () {

        $('#collectionDebt').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'debt_collection.php',
            data: $('#collectionDebt').serialize(),
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

    // Form delete 
    function delete_debt(id){

      $.ajax({
              url:"delete_debt",
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
               delete_debt(id)
            } 
        });
    }
    ////////////////////  

    ///////// Form values reset /////////
    function form_reset(){
      document.getElementById("collectionDebt").reset();
    }
    
  </script>
</body>

</html>
<?php
}
?>