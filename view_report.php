<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>

  <table class="table" id="get_data">
    <thead class="text-primary">
      <th>                    CUSTOMER    </th>
      <th>                    ADDRESS     </th>
      <th class="text-right"> LOAN AMT    </th>
    </thead>
    <tbody>

  <?php

  if(isset($_POST['method'])){

    $method = $_POST['method'];

    $get_loan = mysqli_query($con, "SELECT * FROM customer C,loan L WHERE C.cust_id=L.cust_id AND L.l_method ='$method' GROUP BY L.loan_no");

    
    $numRows1 = mysqli_num_rows($get_loan);

    if($numRows1 > 0) {
      while($row1 = mysqli_fetch_assoc($get_loan)) {

    ?>
          <tr>
            <td>                      <?php echo $row1['name'] ?>          </td>
            <td>                      <?php echo $row1['address'] ?>       </td>
            <td class="text-right">   <?php echo $row1['amount'] ?>     </td>
            <td class="text-right">    
             <a href="#" onclick="View('<?php echo $row1['loan_no']; ?>')" name="view">History </a>
            </td>
          </tr>
          <div id = "show_view">
            
          </div>

    </tbody>
            <?php
      }
    }

    ?> 
      
    
  </table>
  <?php
  mysqli_close($con);

  }

 ?>
<script>
    // VIEW HISTORY
    function View(id){

      $.ajax({
              url:"view_history.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#get_data2').modal('show');
                //$('#get_data1').hide();
              }
        });
    }
    ////////////////////  
</script>