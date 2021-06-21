<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>

  <table class="table" id="get_data">
    <thead class="text-primary">
      <th class="text-center"> Customer        </th>
      <th class="text-center"> Contact         </th>
      <th class="text-center"> Borrowed Date   </th>
      <th class="text-right">  Loan Amount     </th>
      <th class="text-right">  Last Payment On </th>
      <th class="text-right">  Outstanding     </th>
    </thead>
    <tbody>

  <?php

  if(isset($_POST['date'])){

    $date = $_POST['date'];

    $get_loan = mysqli_query($con, "SELECT * FROM customer C INNER JOIN loan L ON C.cust_id=L.cust_id WHERE L.l_status=1 AND L.l_date<='$date'");    
    $numRows = mysqli_num_rows($get_loan);

    if($numRows > 0) {
      $total = 0;
      while($row = mysqli_fetch_assoc($get_loan)) {
        $name = $row['name'];
        $cust_id = $row['cust_id'];
        $customer = $name. ' [' . $cust_id . ']';
        $contact = $row['contact'];
        $amount = $row['amount'];
        $l_date = $row['l_date'];

        $loan_no = $row['loan_no'];

        $getInstallements = mysqli_query($con, "SELECT * FROM loan_installement WHERE loan_no=$loan_no AND li_date<='$date' ORDER BY id DESC LIMIT 1");
        $count = mysqli_num_rows($getInstallements);
        $row2 = mysqli_fetch_assoc($getInstallements);

        if($count>0){
            $bef_date = $row2['li_date'];

            $remain_amt  = $row2['remaining_amt'];
            $remain_int  = $row2['remain_int'];

            $totRemain = $remain_amt+$remain_int;
        }else{
            $bef_date = $row['l_date'];
            $totRemain = $row['total_amt'];
        }

        $method = $row['l_method'];
        $int_val = $row['int_val'];

        $pre_date   = strtotime($bef_date);
        $now_date   = strtotime($date);
        $Days = round(($now_date-$pre_date) / (60 * 60 * 24));

        if($method=='Daily'){
          $Outstanding = $totRemain;
        }else{
          $Outstanding = $totRemain+($int_val*($Days/30));
        }
        $total = $total+$Outstanding;

    ?>
          <tr>
            <td>                      <?php echo $customer; ?>          </td>
            <td>                      <?php echo $contact; ?>       </td>
            <td class="text-center">  <?php echo $l_date; ?>       </td>
            <td class="text-right">   <?php echo $amount; ?>     </td>
            <?php 
            if($l_date==$bef_date){
              echo '<td class="text-center" style="color:red;">'. $bef_date . '</td>';
            } else{
              echo '<td class="text-center">'. $bef_date . '</td>';
            }
            ?>
            <td class="text-right">   <?php echo number_format($Outstanding,2,'.',','); ?>     </td>
          </tr>

            <?php
      }
      ?>
      <tr>
        <td colspan="5"> <strong>Total</strong></td>
        <td class="text-right"><strong><?php echo number_format($total,2,'.',','); ?></strong></td>
      </tr>

    </tbody>
    <?php
    }

    ?> 
      
    
  </table>
  <?php
  mysqli_close($con);

  }

 ?>