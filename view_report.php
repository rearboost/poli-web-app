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
      <th>                    CUSTOMER              </th>
      <th>                    ADDRESS               </th>
      <th class="text-right"> LOAN AMOUNT + INTEREST</th>
      <th class="text-right"> REMAINING AMOUNT      </th>
    </thead>
    <tbody>

  <?php

  if(isset($_POST['method'])){

     $method = $_POST['method'];
     //$date = $_POST['ldate'];
     
     ///// where clause contain like this -----> WHERE li_date <= '".$date."' AND l_method ='".$method."' ORDER BY I.id DESC LIMIT 1 

    $get_loan = mysqli_query($con, "SELECT C.name AS name, C.address AS  address , I.remaining_amt AS remaining_amt, L.total_amt AS total_amt 
    FROM customer C
    INNER JOIN loan L
        on C.cust_id = L.cust_id
    LEFT JOIN loan_installement I on L.loan_no = I.loan_no WHERE l_method ='".$method."'");



    // $get_loan = mysqli_query($con, "SELECT C.name AS name, C.address AS  address , I.remaining_amt AS remaining_amt, L.total_amt AS total_amt 
    // FROM customer C
    // INNER JOIN loan L
    //     on C.cust_id = L.cust_id
    // LEFT JOIN loan_installement I on L.loan_no = I.loan_no WHERE li_date <= '".$date."' AND l_method ='".$method."' ORDER BY I.id DESC LIMIT 1");

    $numRows1 = mysqli_num_rows($get_loan);

        if($numRows1 > 0) {
          while($row1 = mysqli_fetch_assoc($get_loan)) {

                ?>
                          <tr>
                            <td>                      <?php echo $row1['name'] ?>          </td>
                            <td>                      <?php echo $row1['address'] ?>       </td>
                            <td class="text-right">   <?php echo $row1['total_amt'] ?>     </td>
                            <td class="text-right">   <?php echo $row1['remaining_amt'] ?> </td>
                          </tr>
                    </tbody>
                <?php
          }
        }

    ?> 
      
    
  </table>
  <?php
  mysqli_close($con);

  }

 ?>
