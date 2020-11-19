<?php

include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM customer WHERE cust_id='$id' "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {

        $cust_id   = $_POST['c_id'];
        $type      = $_POST['type'];
        $name      = $_POST['name'];
        $address   = $_POST['address'];

      
        $edit = mysqli_query($con,"UPDATE customer 
                                  SET name        ='$name', 
                                      address     ='$address'
                                  WHERE cust_id='$cust_id' ");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:customer.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>

<div class="card-body">
  <div class="modal fade" id="Form3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE CUSTOMERS</h5>
        </div> 

        <form action ="edit_customer.php" method="POST">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group">
                  <label>Customer ID</label>
                  <input type="text" class="form-control" name = "c_id" value="<?php echo $data['cust_id']?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">      
              <div class="col-md-7 pr-1">
                <div class="form-group">
                  <label>Customer Type</label>
                    <input type="text" class="form-control" name = "type" value="<?php echo $data['type']?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" class="form-control" name = "name" value="<?php echo $data['name']?>">
                </div>
              </div>
              </div>
              <div class="row">                  
              <div class="col-md-7 pr-1">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name = "address" value="<?php echo $data['address']?>">
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