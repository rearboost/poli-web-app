<!-- CUSTOMER LOAN VERIFICATION -->
<?php
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$cust_id = $_POST['cust_id'];

	$check_id = mysqli_query($con,"SELECT *  FROM loan WHERE cust_id ='$cust_id' AND l_status=1");;
    $data = mysqli_fetch_array($check_id); 

	$cust_id = $data['cust_id'];

	if(empty($cust_id))
	{	
	echo "You can get a loan";	
	}else{
	echo "Already You have a loan";
	}

?>