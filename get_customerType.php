<?php
error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$cust_id = $_POST['cust_id'];

	$get_type = mysqli_query($con,"SELECT * FROM customer WHERE cust_id='$cust_id'");

    $type_data = mysqli_fetch_array($get_type); 

	$type = $type_data['type'];

	$myObj->type = $type;

	$myJSON = json_encode($myObj);

	echo $myJSON;
	//echo $type;

?>