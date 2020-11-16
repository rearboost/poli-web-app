<?php

include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_GET['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM loan WHERE loan_no =  $id  "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {

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
                                  WHERE loan_no=$id ");
      
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

<h3>UPDATE CUSTOMER LOANS</h3>

<div class="card-body">
  <form action ="" method="POST">
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-5 pr-1">
        <div class="form-group">
          <label>Customer</label>
          <input type="text" name="id" class="form-control" disabled="" value="<?php echo $data['cust_id']?>">           
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 pl-1">
        <div class="form-group">
          <label>Date of obtaining loan</label>
          <input type="date" name="l_date" class="form-control" value="<?php echo $data['l_date']?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 pl-1">
        <div class="form-group">
          <label>Loan Amount</label>
          <input type="text" class="form-control" placeholder="LKR" name = "l_amt" value="<?php echo $data['amount']?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 pl-1">
        <div class="form-group">
          <label>Interest (%)</label>
          <input type="number" class="form-control" placeholder="Interest" name = "interest" value="<?php echo $data['interest']?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 pl-1">
      <div class="form-group">
          <label>No. of Installments</label>
          <input type="number" class="form-control" name = "ino_inst" value="<?php echo $data['no_of_installments']?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-10 pl-1">
      <div class="form-group">
          <label><input type="radio" name="l_method" value="daily"> Daily</label><br>
          <label><input type="radio" name="l_method" value="monthly"> Monthly</label><br>
          <label><input type="radio" name="l_method" value="declining"> Declining Balance Method</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 pl-1">
        <div class="form-group">
          <label>Paid amount with interest</label>
          <input type="text" class="form-control" placeholder="LKR" name = "p_amt" value="<?php echo $data['total_amt']?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 pl-1">
        <div class="form-group">
          <label>Value of installement</label>
          <input type="text" class="form-control" placeholder="LKR" name = "i_amt" value="<?php echo $data['installment_value']?>">
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