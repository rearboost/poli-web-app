<?php
include("db_config.php");
include("msg_show.php");
session_start();
if (!isset($_SESSION['loged_user'])) {
    //echo "Access Denied";
    header('location: login.php');
}else {
$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
mysqli_select_db($con,DB_NAME);
?>

<!DOCTYPE html>
<html lang="en">

<?php  include('./include/head.php');   ?>

<body class="">
  <div class="wrapper ">
    <?php include("include/sidebar.php"); ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('include/nav.php');  ?>
      <!-- End Navbar -->
      <div class="content">
       <div class="row">
          <div class="col-md-12">         
            <div class="card">
              <div class="row">
              <div class="col-md-9">
              <div class="card-header">
                <h4 class="card-title"> CUSTOMER</h4>    
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                
              </div>
              </div>
              <div class="col-md-3">
                <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Register in here..
                    </button> 
                </div>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Customer Registration Form</h5>
                      </div> 
                      <form id="customerAdd">
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-7 pr-10">
                            <div class="form-group">
                              <label>Customer Type</label>
                                <select class="form-control form-selectBox" id="customerType" name ="type" required>
                                  <option>--Select Customer Type--</option>
                                  <option>Daily</option>
                                  <option>Monthly</option>
                                </select>
                            </div>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-7 pr-10">
                            <div class="form-group">
                              <label>Customer ID</label>
                              <input type="text" class="form-control" name ="id" id="customerID" readonly required>
                            </div>
                          </div>
                          </div>
                        <div class="row">
                          <div class="col-md-7 pr-10">
                            <div class="form-group">
                              <label>Customer Name</label>
                              <input type="text" class="form-control" placeholder="Name" name = "name" required>
                            </div>
                          </div>
                          </div>
                          <div class="row">                  
                          <div class="col-md-7 pr-10">
                            <div class="form-group">
                              <label>Address</label>
                              <input type="text" class="form-control" placeholder="Address" name = "address" required>
                            </div>
                          </div>
                          </div>
                          <div class="row">                  
                          <div class="col-md-7 pr-10">
                            <div class="form-group">
                              <label>Contact No</label>
                              <input type="text" class="form-control" placeholder="+94 " name = "contact" required>
                            </div>
                          </div>
                          </div>
                          <div class="row">
                          <div class="update ml-auto mr-auto">
                            <input type="hidden" name ="submit" value="submit"/>
                            <button type="submit" class="btn btn-primary btn-round">Register</button>
                            <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">

                            <?php
                                if(isset($_POST['submit'])){
                                  $id       = $_POST['id'];
                                  $type     = $_POST['type'];
                                  $name     = $_POST['name'];
                                  $address  = $_POST['address'];
                                  $contact  = $_POST['contact'];

                                $insert1 = "INSERT INTO customer (cust_id,type,name,address,contact) VALUES ('$id','$type','$name','$address','$contact')";
                                mysqli_query($con,$insert1);
                                }
                            ?>
                          </div>
                        </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- card body-->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                    ID</th>
                      <th>                    Type</th>
                      <th>                    Name</th>
                      <th>                    Address</th>
                      <th>                    Contact</th>
                      <th class="text-center"> Edit 				</th>
                      <th class="text-center"> Delete 			</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM customer");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td> <?php echo $row['cust_id'] ?>     </td>
                            <td> <?php echo $row['type'] ?>        </td>
                            <td> <?php echo $row['name']?>         </td>
                            <td> <?php echo $row['address']  ?>    </td>
                            <td> <?php echo $row['contact']  ?>    </td>
                            <td class="text-center">  
                             <a href="#" onclick="editView('<?php echo $row['cust_id']; ?>')" name="edit">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['cust_id']; ?>')" name="delete">
                              <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                    </tbody>
                           <?php
                        }
                      }
                    ?>                      
                    </table>
                  <?php
                  mysqli_close($con);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div>
  </div>

  <div id="show_view">

  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>
   <!-- DataTables JS -->
  <script src="assets/js/jquery.dataTables.js"></script>

  <script>
    //////////////////////  DataTable //////////////////
    $(document).ready( function () {
      $('#myTable').DataTable();
    });

    /////////////////////////////////////// Table Search 
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    ///////////////////////////////////////////

    $('#customerType').on('change', function() {

      const zeroPad = (num, places) => String(num).padStart(places, '0');

        var custType = this.value;
        var type  = custType.charAt(0);

        $.ajax({
          url: 'func_custid.php',
          method:"POST",
          data:{type:this.value},
          success: function (response) {//response is value returned from php (for your example it's "bye bye"
            var lastNumber = Number(response.substr(1))+1;
            $('#customerID').val(type+zeroPad(lastNumber, 4));
          }
        });
    });  

    ////////////////////  

    // Form edit 
    function editView(id){
      
      $.ajax({
              url:"edit_customer",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#Form3').modal('toggle');
              }
        });
    }
    ////////////////////  
    

    ///////// Form values reset /////////
    function form_reset(){
      document.getElementById("customerAdd").reset();
    }

    ////////////////////  

    // Form delete 
    function delete_customer(id){

      $.ajax({
              url:"delete_customer",
              method:"POST",
              data:{"id":id},
              success:function(data){
                  swal({
                  title: "Good job !",
                  text: data,
                  icon: "success",
                  button: "Ok !",
                  });
                  setTimeout(function(){ location.reload(); }, 2500);
      
              }
        });
    }

    // delete confirmation javascript
    function confirmation(e,id) {
        swal({
        title: "Are you sure?",
        text: "Want to Delete this recode !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               delete_customer(id)
            } 
        });
    }
    ////////////////////  


    ///////////////////////////////////////////////////

    $(function () {

        $('#customerAdd').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'customer.php',
            data: $('#customerAdd').serialize(),
            success: function () {
              swal({
                title: "Good job !",
                text: "Successfully Submited",
                icon: "success",
                button: "Ok !",
                });
                setTimeout(function(){ location.reload(); }, 2500);
               }
          });

        });

      });
   
   
  </script>
</body>

</html>
<?php
}
?>
