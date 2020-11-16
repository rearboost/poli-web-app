<?php

include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_GET['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM loan,loan_installement WHERE loan.loan_no = loan_installement.loan_no AND id=$id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {

        $li_id              = $_POST['id'];
        $li_date            = $_POST['li_date'];
        $installement_amt   = $_POST['i_amt'];
        $interest_amt       = $_POST['int_amt'];
        $remaining_amt      = $_POST['remain_amt'];
        $loan_no            = $_POST['loan_no'];
        $cust_id            = $_POST['cust_id'];

      
        $edit = mysqli_query($con,"UPDATE loan_installement 
                                  SET li_date           ='$li_date', 
                                      installement_amt  ='$installement_amt', 
                                      interest_amt      ='$interest_amt', 
                                      remaining_amt     ='$remaining_amt'
                                  WHERE id=$id ");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:debt_collection.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
 }   
                 
?>

<h3>UPDATE DEBT COLLECTIONS</h3>

<div class="card-body">
  <form action ="" method="POST">
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-5 pr-1">
        <div class="form-group">
          <label>Customer</label> 
            <input type="text" class="form-control" name = "cust_id" disabled="" value = "<?php echo $data['cust_id'] ?>">
        </div>
      </div>
      <div class="col-md-1">
      </div>
          <div class="col-md-5 pl-1">
            <div class="form-group">
              <label>Date</label>
              <!--input type="text" class="form-control" disabled="" name = "id"-->
              <input type="date" class="form-control" name = "li_date" value = "<?php echo $data['li_date'] ?>">
            </div>
          </div>
      </div>
    <div class="row">
      <div class="col-md-5 pr-1">
        <div class="form-group">
          <label>Installment amount</label>
          <input type="text" class="form-control" placeholder="LKR" name = "i_amt" value = "<?php echo $data['installement_amt'] ?>">
        </div>
      </div>  
      <div class="col-md-1">
      </div>                  
      <div class="col-md-5 pl-1">
        <div class="form-group">
          <label>Interest amount</label>
          <input type="text" class="form-control" placeholder="LKR" name = "int_amt" value = "<?php echo $data['interest_amt'] ?>">
        </div>
      </div>
      </div>
    <div class="row">
      <div class="col-md-5 pr-1">
        <div class="form-group">
          <label>Remaining amount</label>
          <!--input type="text" class="form-control" disabled = ""  name = "remain_amt"-->
          <input type="text" class="form-control" name = "remain_amt" value = "<?php echo $data['remaining_amt'] ?>">
        </div>
      </div>
      <div class="col-md-1">
      </div>
      <div class="col-md-5 pl-1">
        <div class="form-group">
          <label>Loan Amount</label>
          <!--input type="text" class="form-control" disabled = "" name = "l_amt"-->
          <input type="text" class="form-control" name = "l_amt" disabled = "" value = "<?php echo $data['amount'] ?>">
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