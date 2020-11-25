<?php

  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

?>

  <table class="table" id="get_data">
    <thead class="text-primary">
      <th>CUSTOMER</th>
      <th>ADDRESS</th>
      <th class="text-right"> LOAN AMOUNT + INTEREST</th>
      <th class="text-right"> REMAINING AMOUNT</th>
    </thead>

    <tbody>
<?php

  $method = $_POST['method'];
  //$date = $_POST['ldate'];

  //$get_loan = mysqli_query($con,"SELECT name, address, loan_no, total_amt FROM customer, loan  WHERE customer.cust_id = loan.cust_id");
  $get_loan = mysqli_query($con,"SELECT name, address, loan_no, total_amt FROM customer, loan  WHERE customer.cust_id = loan.cust_id AND l_method='$method'");

  //$get_loan = mysqli_query($con,"SELECT name, address, loan_no, total_amt FROM customer, loan  WHERE customer.cust_id = loan.cust_id AND l_method='$method' AND l_date='$date");

  $numRows1 = mysqli_num_rows($get_loan);
  
  if($numRows1 > 0) {
    while($row1 = mysqli_fetch_assoc($get_loan)) {

      $loan_no  = $row1['loan_no'];

      $check_no = mysqli_query($con,"SELECT * FROM (SELECT * FROM loan_installement WHERE loan_installement.loan_no = '$loan_no') I ORDER BY I.id DESC LIMIT 1;");

      $numRows2 = mysqli_num_rows($check_no);   
        if($numRows2 > 0) {
          while($row2 = mysqli_fetch_assoc($check_no)) {
?>
          <tr>
            <td>                      <?php echo $row1['name'] ?>          </td>
            <td>                      <?php echo $row1['address'] ?>       </td>
            <td class="text-right">   <?php echo $row1['total_amt'] ?>     </td>
            <td class="text-right">   <?php echo $row2['remaining_amt'] ?> </td>
          </tr>
    </tbody>
<?php
        }
      }
    }
  }
    ?>                      
</table>
<?php
mysqli_close($con);
?>
