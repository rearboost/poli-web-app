<?php

	$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  	if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  	}
  	mysqli_select_db($con,DB_NAME);

	//////////// card 1 /////////////
	$customer_count = mysqli_query($con, "SELECT cust_id FROM customer");
	$card_1 = mysqli_num_rows($customer_count); 

	//////////// card 2 /////////////
	$loan_count = mysqli_query($con, "SELECT DISTINCT(loan_no) FROM loan WHERE l_date = date_sub(curdate(),interval 1 day)");
	$card_2 = mysqli_num_rows($loan_count);

	//////////// card 3 /////////////
	$cheque_count = mysqli_query($con, "SELECT cheque_id FROM cheque WHERE valid_date <= curdate() AND status = 'NYC'");
	$card_3 = mysqli_num_rows($cheque_count); 

	//////////// card 4 /////////////
	$cheque_amt = mysqli_query($con, "SELECT SUM(cheque_value) as tot_cheque_amt FROM cheque WHERE valid_date >= curdate() AND status = 'NYC'");
	$sum = mysqli_fetch_array($cheque_amt); 
	$card_4 = $sum['tot_cheque_amt']; 


?>