<?php
	error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$customer_id = $_POST['id'];

	$get_loan = mysqli_query($con,"SELECT * FROM loan WHERE cust_id='$customer_id' AND l_status = 1");

	$data = mysqli_fetch_array($get_loan); 

	$loan_no 	= $data['loan_no'];
	$interest 	= $data['interest'];
	$l_method 	= $data['l_method'];
	$loan_amt 	= $data['total_amt'];
	$rental 	= $data['installment_value'];
	$int_val 	= $data['int_val'];
	$fix_ldate 	= $data['l_date'];
	$end_ldate 	= $data['i_date'];

	$check_no = mysqli_query($con,"SELECT * FROM (SELECT * FROM loan_installement WHERE loan_installement.loan_no = '$loan_no') V ORDER BY V.id DESC LIMIT 1;");

    $data1 = mysqli_fetch_array($check_no); 

	$remaining_amt  = $data1['remaining_amt'];
	$fix_lidate 	= $data1['li_date'];
	$end_lidate 	= $data1['next_idate'];
	$remain_int 	= $data1['remain_int'];

	if(empty($remaining_amt))
	{
		$remain_amt = $loan_amt;	
		$fix_date 	= $fix_ldate;
		$end_date 	= $end_ldate;
		$remain_int = 0;
	}
	else
	{
	    $remain_amt = $remaining_amt;	
		$fix_date 	= $fix_lidate;
		$end_date 	= $end_lidate;
		$remain_int = $remain_int ;
	}

	$myObj->remain_amt 	= $remain_amt;
	$myObj->loan_amt 	= $loan_amt;
	$myObj->l_method 	= $l_method;
	$myObj->interest 	= $interest;
	$myObj->int_val 	= $int_val;
	$myObj->fix_date 	= $fix_date;
	$myObj->end_date 	= $end_date;
	$myObj->remain_int 	= $remain_int;
	$myObj->rental 		= $rental;

	$myJSON = json_encode($myObj);

	echo $myJSON;

?>