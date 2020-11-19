<?php

include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM cheque WHERE cheque_id=$id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {

        $ch_id          = $_POST['ch_id'];      
        $bank           = $_POST['bank'];
        $cheque_no      = $_POST['cheque_no'];
        $v_date         = $_POST['v_date'];
        $c_date         = $_POST['c_date'];
        $cheque_amt     = $_POST['cheque_amt'];
        $c_interest     = $_POST['c_interest'];
        $exchange_amt   = $_POST['exchange_amt'];
        $status         = $_POST['status'];
        $cust_id        = $_POST['cust_id'];
      
        $edit = mysqli_query($con,"UPDATE cheque 
                                  SET bank          ='$bank', 
                                      cheque_no     ='$cheque_no', 
                                      valid_date    ='$v_date', 
                                      exchange_date ='$c_date', 
                                      cheque_value  ='$cheque_amt ', 
                                      interest      ='$c_interest', 
                                      exchange_amt  ='$exchange_amt', 
                                      status        ='$status '
                                  WHERE cheque_id=$ch_id ");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:cheque_transfer.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>

<h3>UPDATE CHEQUE TRANSFERS</h3>

<div class="card-body">
  <div class="modal fade" id="Form2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE DEBT COLLECTIONS</h5>
        </div> 
        <form action ="edit_cheque.php" method="POST">
          <div class="col-md-12">
          <div class="row">
            <div class="col-md-5 pr-1">
              <div class="form-group">
                <input type="hidden" class="form-control" name = "ch_id" value="<?php echo $data['cheque_id']?>">
                <label>Customer</label>
                  <input type="text" class="form-control" name = "cust_id" value="<?php echo $data['cust_id']?>" readonly>
              </div>
            </div>
            <div class="col-md-1">
            </div>
                <div class="col-md-5 pl-1">
                  <div class="form-group">
                    <label>Bank</label>
                    <input type="text" class="form-control" placeholder="Bank name" name = "bank" value="<?php echo $data['bank']?>">
                  </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-5 pr-1">
              <div class="form-group">
                <label>Cheque Number</label>
                <input type="text" class="form-control" placeholder="Cheque Number" name = "cheque_no" value="<?php echo $data['cheque_no']?>">
              </div>
            </div>  
            <div class="col-md-1">
            </div>                  
            <div class="col-md-5 pl-1">
              <div class="form-group">
                <label>Valid Date</label>
                <!--input type="text" class="form-control" disabled="" name = "id"-->
                <input type="date" class="form-control" name = "v_date" value="<?php echo $data['v_date']?>">
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col-md-5 pr-1">
              <div class="form-group">
                <label>Value Of the Cheque</label>
                <input type="text" class="form-control" placeholder="LKR" name = "cheque_amt" id = "cheque_amt" onkeyup="get_exchange_amt()" value="<?php echo $data['cheque_value']?>">
              </div>
            </div>  
            <div class="col-md-1">
            </div>                  
            <div class="col-md-5 pl-1">
              <div class="form-group">
                <label>Date Of Change</label>
                <input type="date" class="form-control" name = "c_date" value="<?php echo $data['exchange_date']?>">
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col-md-5 pr-1">
              <div class="form-group">
                <label>Interest (%)</label>
                <input type="text" class="form-control" placeholder="Interest" name = "c_interest" id="c_interest" onkeyup="get_exchange_amt()" value="<?php echo $data['interest']?>">
              </div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-5 pl-1">
              <div class="form-group">
                <label>Exchange Amount</label>
                <input type="text" class="form-control" placeholder="LKR" name="exchange_amt" id="exchange_amt" value="<?php echo $data['exchange_amt']?>">
              </div>
            </div>
          </div>
          <div class="row">                    
            <div class="col-md-5 pr-1">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control form-selectBox" name = "status" value="<?php echo $data['status']?>">
                    <option>--Select Status--</option>
                    <option>Completed</option>
                    <option>NYC</option>
                  </select>
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
      </div>
    </div>
  </div>
</div>