<?php

   include("db_config.php");
   $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM loan WHERE loan_no =  $id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $no       = $_POST['no'];
        $l_date   = $_POST['l_date'];
        $l_amt    = $_POST['l_amt'];
        $interest = $_POST['interest'];
        $l_method = $_POST['l_method'];
        $p_amt    = $_POST['p_amt'];
        $i_amt    = $_POST['i_amt'];
        $ino_inst = $_POST['ino_inst'];

        $edit = mysqli_query($con,"UPDATE loan 
                                  SET l_date             ='$l_date', 
                                      amount             ='$l_amt', 
                                      interest           ='$interest', 
                                      l_method           ='$l_method', 
                                      total_amt          ='$p_amt', 
                                      installment_value  ='$i_amt', 
                                      no_of_installments ='$ino_inst'
                                  WHERE loan_no=$no");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:customer_loan.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>


<div class="card-body">
  <div class="modal fade" id="Form2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE CUSTOMER LOANS</h5>
        </div> 
        <form id="loanEdit">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-5 pr-3">
                <div class="form-group">
                  <input type="text" name="no" class="form-control" value="<?php echo $data['loan_no']?>" hidden>           
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label> Customer</label>
                    <?php
                    $customer_id = $data['cust_id'];
                    $get_customer =mysqli_query($con,"SELECT * FROM customer WHERE cust_id='$customer_id'");
                    $cust_data = mysqli_fetch_array($get_customer);
                    ?>
                    <input type="text" class="form-control" anme="customer" value="<?php echo $data['cust_id'] . ' | ' . $cust_data['name']?>">          
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group" >
                  <label> Method</label>
                  <input type="text" name="l_method" id="l_method" class="form-control" value="<?php echo $data['l_method']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label> Date of obtaining loan</label>
                  <input type="date" name="l_date" class="form-control" value="<?php echo $data['l_date']?>">
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label> Loan Amount</label>
                  <input type="text" class="form-control customerAmt1" placeholder="LKR" id="amount1" name = "l_amt" value="<?php echo $data['amount']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label> Interest (%)</label>
                  <input type="text" class="form-control customerAmt1" placeholder="Interest" id="int1" name = "interest" value="<?php echo $data['interest']?>">
                </div>
              </div>
              <div class="col-md-6 pr-1 daily_section" hidden="">
              <div class="form-group">
                  <label> No. of Installments</label>
                  <input type="number" class="form-control customerAmt1" id="no1" name = "ino_inst" value="<?php echo $data['no_of_installments']?>">
                </div>
              </div>
              <div class="col-md-6 pr-1 monthly_section" hidden="">
              <div class="form-group">
                  <label>Interest Value </label>
                  <input type="text" class="form-control" id="int_val" name="int_val" value="<?php echo $data['int_val']?>">
                </div>
              </div>
            </div>
            
            <div class="row daily_section" hidden="">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label> Paid amount with interest</label>
                  <input type="text" class="form-control" placeholder="LKR" id="paid_amt1" name = "p_amt" value="<?php echo $data['total_amt']?>">
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label> Value of installement</label>
                  <input type="text" class="form-control" placeholder="LKR" id="inst_val1" name = "i_amt" value="<?php echo $data['installment_value']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label> First Installement Date</label>
                  <input type="date" class="form-control" name="i_date" value="<?php echo $data['i_date']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="update ml-auto mr-auto">
                <!-- <input type="hidden" name ="update" value="update"/>
                <button type="submit" class="btn btn-primary btn-round">Update</button> -->
                <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </form>
      </div><!-- modal content end-->
    </div>
  </div>
</div>


<script>
$(document).ready( function () {

  var type = $('l_method').val();
  if(type=="Daily")
  {
      $('.daily_section').prop('hidden', false);
      $('.monthly_section').prop('hidden', true);
  }
  else
  {
      $('.daily_section').prop('hidden', false);
      $('.monthly_section').prop('hidden', false);
  }
});
    
///////////////////////////////////////////////////

$(function () {

    $('#loanEdit').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: 'edit_loan.php',
        data: $('#loanEdit').serialize(),
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
    

</script>