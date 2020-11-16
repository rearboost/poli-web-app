<?php

include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_GET['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM cheque WHERE cheque_id=$id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {

        $cheque_id      = $_POST['id'];
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
                                  WHERE cheque_id=$id ");
      
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
  <form action ="" method="POST">
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-5 pr-1">
        <div class="form-group">
          <label>Customer</label>
            <select class="form-control" name = "id" value="<?php echo $data['cust_id']?>">
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
          <select class="form-control" name = "status" value="<?php echo $data['status']?>">
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
      </div>
    </div>
    </div>
  </form>
</div>