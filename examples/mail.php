<?php
include("db_config.php");

$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
mysqli_select_db($con,DB_NAME);


$date = date("Y-m-d");
$mod_date = strtotime($date."+ 2days");
$new_date = date("m/d/Y",$mod_date);

$sql = mysqli_query($con, "SELECT * FROM cheque WHERE valid_date ='$new_date' ");

if(mysqli_num_rows($sql) > 0){
	while ($row = mysqli_fetch_assoc($sql)){
		$bank = $row['bank'];
		$cheque_no = $row['cheque_no'];
		$valid_date = $row['valid_date'];
		$cheque_value = $row['cheque_value'];

		$text . = "On " . $valid_date . ", </br>"
				"cheque number : " . $cheque_no . "</br>"
				"bank : " . $bank . "</br>"
				"cheque value : " . $cheque_value . "</br>";
	}

	$subject = "You have to exchange cheques.";
	$body = $text;
	$to = "sample@gmailcom";	//add admin mail
	mail($to,$subject,$body);


}else{
	echo "No data found";
}

mysqli_close($con);

?>