<?php
include("db_config.php");
	$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
  	if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  	}

	$id=$_GET['id'];

	$del = mysqli_query($con,"DELETE FROM loan_installement WHERE id =  $id ") ;
if ($del){
	
	mysqli_close($con);
	header("Location:debt_collection.php");
}
else
{
	echo "Not deleted.". mysqli_error($con);		
}

?>

