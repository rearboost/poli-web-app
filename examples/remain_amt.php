<?php
include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$customer_id = $_POST['id'];

	$get_loan = mysqli_query($con,"SELECT l.loan_no, l.total_amt FROM customer c , loan l WHERE c.cust_id = l.cust_id AND l.cust_id = '$customer_id'");

	$loan_no 	= $get_loan['loan_no'];
	$loan_amt 	= $get_loan['total_amt'];

	$check_no = mysqli_query($con,"SELECT * FROM loan, loan_installement WHERE loan.loan_no = loan_installement.loan_no HAVING loan_installement.loan_no='$loan_no' ");

	$remaining_amt = $check_no['remaining_amt'];

	if(!$loan_no)
	{
		$remain_amt = $loan_amt;
			
	}
	else
	{
	   $remain_amt =$remaining_amt;
	}
	
	echo $remain_amt;

?>