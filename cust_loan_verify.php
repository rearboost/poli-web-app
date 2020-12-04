<?php
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$cust_id = $_POST['cust_id'];

	//$check_id = mysqli_query($con,"SELECT *  FROM loan WHERE cust_id ='$cust_id' AND l_status=1");;

	$check_id =mysqli_query($con,"SELECT l_status
	FROM loan
	WHERE cust_id ='$cust_id'
	ORDER BY loan_no DESC 
	LIMIT 1;");

    $data = mysqli_fetch_array($check_id); 

	$l_status = $data['l_status'];

    if(empty($l_status))
	{	
		echo  1;	
	}else{
	   
		if($l_status==0){

			echo 1;	
		}else{

			echo 0;
		}
	}

	// 0 = Already You have a loan
	// 1 = You can get a loan

?>