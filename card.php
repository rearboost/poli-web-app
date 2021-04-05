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
	$currentDay = new DateTime(null, new DateTimeZone('Asia/Colombo'));
	$today = $currentDay->format('Y-m-d');

	$today_collect = mysqli_query($con, "SELECT SUM(int_val) as tot_interest, SUM(installment_value)as tot_installements FROM loan L LEFT JOIN loan_installement I ON L.loan_no=I.loan_no WHERE L.i_date='$today' OR I.next_idate ='$today'");
	
	$tot = mysqli_fetch_array($today_collect);  

		$int_collect  = $tot['tot_interest']; 
		$inst_collect = $tot['tot_installements']; 
		$total_collect = $int_collect+$inst_collect; 
		$card_3 = $total_collect;

	if(empty($total_collect)){
		$card_3 = number_format(0,2,".",",");
	}else{
		$card_3 = number_format($total_collect,2,".",",");
	}
	// $card_3 = $today; 

	//////////// card 4 /////////////
	$cheque_amt = mysqli_query($con, "SELECT SUM(cheque_value) as tot_cheque_amt FROM cheque WHERE valid_date <= '$today' AND status = 'NYC'");

	$sum = mysqli_fetch_array($cheque_amt); 
	$card_4 = $sum['tot_cheque_amt']; 
	if(empty($card_4)){
		$card_4 = number_format(0,2,".",",");
	}else{
		$card_4 = number_format($sum['tot_cheque_amt'],2,".",",");
	}

?>