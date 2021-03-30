<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
<div class="card-body">
  <h5>CUSTOMER HISTORY</h5>

    <table class="table" id="" >

          <?php

            $loan_no = $_POST['id'];

            $check_method = mysqli_query($con, "SELECT l_method,i_date,installment_value,int_val from loan WHERE loan_no='$loan_no' ");
            $fetch_method = mysqli_fetch_array($check_method);
            $method=$fetch_method['l_method'];

            $query = mysqli_query($con,"SELECT  I.li_date as li_date, I.installement_amt as installement_amt, I.interest_amt as interest_amt, I.remaining_amt as brought_forward, I.next_idate as next_idate
              FROM loan L
              INNER JOIN loan_installement I
                ON L.loan_no = I.loan_no
              WHERE L.loan_no = '$loan_no' ");
                
            $numRows = mysqli_num_rows($query);

              if($numRows > 0) {
              ?>

              <thead class="text-primary">
              <th>                    DATE            </th>
              <th class="text-right"> PAID            </th>
              <th class="text-right"> BROUGHT FORWARD </th>
              <th>                    NEXT RENTAL     </th>
              </thead>
              
              <tbody>

                <?php
                while($row1 = mysqli_fetch_assoc($query)) {
                  if($method=='Daily'){
                    $paid=$row1['installement_amt'];
                  }else{
                    $paid=$row1['installement_amt']+$row1['interest_amt'];
                  }

        ?>


              <tr>
                <td>                    <?php echo $row1['li_date'] ?>       </td>
                <td class="text-right"> <?php echo number_format($paid,2,".",",") ?>  </td>
                <td class="text-right"> <?php echo number_format($row1['brought_forward'],2,".",",") ?>     </td>
                <td>                    <?php echo $row1['next_idate'] ?>       </td>
              </tr>
            </tbody>
        <?php
                 } //end while loop

              } else{
        ?> 
        <center><br>
          <p style="color:#b30000; font-size: 14px;">Not yet started payments.</p><br>

          <?php
          if($method=='Daily'){
            echo '<p style="color:#006666; font-size: 16px;">'."Your 1 " . '<sup>'."st".'</sup>' . " Installment of LKR. ". '<b>' . number_format($fetch_method['installment_value'],2,".",","). '</b>'  . " is on " . '<b>'. $fetch_method['i_date'] . '</b>' .'</p>';

          }else{
            echo '<p style="color:#006666; font-size: 16px;">'."Your 1 " . '<sup>'."st".'</sup>' . " Installment of LKR. ". '<b>' . number_format($fetch_method['int_val'],2,".",",") . '</b>' . " is on " . '<b>'. $fetch_method['i_date'] . '</b>' .'</p>';
          }
          ?>
        </center>
        <?php
              }

        ?> 

          </table> 
     
</div>
<?php
mysqli_close($con);


 ?>
