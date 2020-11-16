
<!--?php
function get_max_Dcust_ID()
{	
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);
	$getid = "SELECT customer.cust_id LIKE 'D%' FROM customer WHERE customer.type = 'Daily' ORDER BY customer.cust_id DESC LIMIT 1";
	$record = mysqli_query($con, $getid);
	while ($row = mysqli_fetch_assoc($record)) {
	
	    $cust_id = $row['cust_id'] ;
	}
	return $cust_id+1;
}

function get_max_Mcust_ID()
{	
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);
	$getid = "SELECT customer.cust_id LIKE 'M%' FROM customer WHERE customer.type = 'Monthly' ORDER BY customer.cust_id DESC LIMIT 1";
	$record = mysqli_query($con, $getid);
	while ($row = mysqli_fetch_assoc($record)) {
	
	    $cust_id = $row['cust_id'] ;
	}
	return $cust_id+1;
}

?-->
<?php
function get_max_cust_ID()
{	
	$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	if('type = "Daily"')
	{
	$getid = "SELECT customer.cust_id LIKE 'D%' FROM customer WHERE customer.type = 'Daily' 
				ORDER BY customer.cust_id DESC LIMIT 1";
	
	}
	else
	{
	$getid = "SELECT customer.cust_id LIKE 'M%' FROM customer WHERE customer.type = 'Monthly' 
				ORDER BY customer.cust_id DESC LIMIT 1";

	}
	$record = mysqli_query($con, $getid);
	while ($row = mysqli_fetch_assoc($record)) {
	
	    $cust_id = $row['cust_id'] ;
	
	}
	return $cust_id+1;

}

?>