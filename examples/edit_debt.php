<?php

include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM loan,loan_installement WHERE loan.loan_no = loan_installement.loan_no AND id=$id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {

        $i_id               = $_POST['i_id'];
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
                                  WHERE id=$i_id ");
      
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

<div class="card-body">
  <div class="modal fade" id="Form2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE DEBT COLLECTIONS</h5>
        </div> 

        <form action ="edit_debt.php" method="POST">
          <div class="col-md-12">
            <div class="row">
                <div class="form-group">
                  <input type="hidden" class="form-control" name = "i_id" value = "<?php echo $data['id'] ?>" >
                </div>
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Customer</label> 
                  <input type="text" class="form-control" id="cust_id1" name = "cust_id" disabled="" value = "<?php echo $data['cust_id'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Date</label>
                  <!--input type="text" class="form-control" disabled="" name = "id"-->
                  <input type="date" class="form-control" name = "li_date" value = "<?php echo $data['li_date'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Installment amount</label>
                  <input type="text" class="form-control checkAmt1" placeholder="LKR" id="i_amt1" name = "i_amt" value = "<?php echo $data['installement_amt'] ?>">
                </div>
              </div>
            </div>  
            <div class="row">                
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Interest amount</label>
                  <input type="text" class="form-control checkAmt1" placeholder="LKR" id="int_amt1" name = "int_amt" value = "<?php echo $data['interest_amt'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Remaining amount</label>
                  <!--input type="text" class="form-control" disabled = ""  name = "remain_amt"-->
                  <input type="text" class="form-control" id="remain_amt1" name = "remain_amt" value = "<?php echo $data['remaining_amt'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Loan Amount</label>
                  <!--input type="text" class="form-control" disabled = "" name = "l_amt"-->
                  <input type="text" class="form-control" id="l_amt" name = "l_amt" disabled = "" value = "<?php echo $data['amount'] ?>">
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


<script>

    ////////////////////  Update the Functions

    $('.checkAmt1').on('keyup',function(){
        checkAmt1()
    })

    function checkAmt1(){

      var installement_amt  = $('#i_amt1').val();
      var interest_amt      = $('#int_amt1').val();
      var remain_amt;
      var id =  $('#cust_id1').val();

      $.ajax({
        url: 'remain_amt.php',
        method:"POST",
        data:{id:id},
        success: function (response) {

          var obj = JSON.parse(response);
         // $('#remain_amt').val(obj.remain_amt);
          var remain_amt   =  obj.remain_amt

          remain_amt = Number(remain_amt) - (Number(installement_amt)+Number(interest_amt));  
      
           $('#remain_amt1').val(remain_amt.toFixed(2));
        }

      });
    }

    ////////////////////  


</script>