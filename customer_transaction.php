<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
<div class="card-body">
  <div class="modal fade" id="info" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Customer Transaction</h5>
        </div> 

        <?php
        
        ?>
        <div class="col-md-12">
          <br>
          <div class="row">
            <div class="col-md-5 pr-3">
              <div class="form-group">
                <label>Next Installement date:</label>
                <span></span>      
              </div>
            </div>
          </div>
        </div>


          <table class="table" id="" >
            <thead class="text-primary">
              <th>                    DATE            </th>
              <th class="text-right"> PAID            </th>
              <!-- <th class="text-right"> TOTAL PAID      </th> -->
              <th class="text-right"> Remaining Amt </th>
            </thead>
            <tbody>

          <?php

            $loan_no = $_POST['id'];

            $query = mysqli_query($con,"SELECT  I.li_date as li_date, I.installement_amt as paid, I.remaining_amt as brought_forward
              FROM loan L
              INNER JOIN loan_installement I
                ON L.loan_no = I.loan_no
              WHERE L.loan_no = '$loan_no' ");
                
            $numRows = mysqli_num_rows($query);

              if($numRows > 0) {
                while($row1 = mysqli_fetch_assoc($query)) {
        ?>
              <tr>
                <td>                    <?php echo $row1['li_date'] ?>       </td>
                <td class="text-right"> <?php echo number_format($row1['paid'],2) ?>  </td>
                <td class="text-right"> <?php echo number_format($row1['brought_forward'],2) ?>     </td>
              </tr>
            </tbody>
        <?php
                }
              }
        ?> 
          
          </table> 
          <form>
            <center>
            <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
            </center>
          </form>
      </div>
    </div>
  </div>
</div>
<?php
mysqli_close($con);


 ?>
