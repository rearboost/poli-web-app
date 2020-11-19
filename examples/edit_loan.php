<?php

   include("db_config.php");
   $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM loan WHERE loan_no =  $id  "); // select query

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

        <form action ="edit_loan.php" method="POST">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-5 pr-3">
                <div class="form-group">
                  <input type="text" name="no" class="form-control" value="<?php echo $data['loan_no']?>" hidden>           
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 pr-3">
                <div class="form-group">
                  <label>Customer</label>
                  <input type="text" name="cust_id" class="form-control" disabled="" value="<?php echo $data['cust_id']?>">           
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Date of obtaining loan</label>
                  <input type="date" name="l_date" class="form-control" value="<?php echo $data['l_date']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Loan Amount</label>
                  <input type="text" class="form-control" placeholder="LKR" id="amount" name = "l_amt" value="<?php echo $data['amount']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Interest (%)</label>
                  <input type="number" class="form-control" placeholder="Interest" id="int" name = "interest" value="<?php echo $data['interest']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
              <div class="form-group">
                  <label>No. of Installments</label>
                  <input type="number" class="form-control" id="no" name = "ino_inst" value="<?php echo $data['no_of_installments']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-10 pr-3">
              <div class="form-group" id="rates">
                  <label><input type="radio" id="r1" name="l_method" value="daily" <?php if($data['l_method']=="daily"){ echo "checked";}?>>Daily</label><br>
                  <label><input type="radio" id="r2" name="l_method" value="monthly" <?php if($data['l_method']=="monthly"){ echo "checked";}?>> Monthly</label><br>
                  <label><input type="radio" id="r3" name="l_method" value="declining" <?php if($data['l_method']=="declining"){ echo "checked";}?>> Declining Balance Method</label>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Paid amount with interest</label>
                  <input type="text" class="form-control" placeholder="LKR" id="paid_amt" name = "p_amt" value="<?php echo $data['total_amt']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Value of installement</label>
                  <input type="text" class="form-control" placeholder="LKR" id="inst_val" name = "i_amt" value="<?php echo $data['installment_value']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" name="update" class="btn btn-primary btn-round">Update</button>
                <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </form>
      </div><!-- modal content end-->
    </div>
  </div>
</div>
