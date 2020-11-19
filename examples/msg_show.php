<?php

$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
mysqli_select_db($con,DB_NAME);

// Get details of cheques in valid date or day before the valid date
$sql=mysqli_query($con,"SELECT * FROM cheque WHERE valid_date = CURDATE() OR valid_date = date_add(curdate(),interval 1 day) AND status = 'NYC' ORDER BY valid_date ASC");
$numRows = mysqli_num_rows($sql); 


?>
