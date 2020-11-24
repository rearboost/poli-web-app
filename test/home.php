<!DOCTYPE html>
<html lang="en">
<?php 
 
 include('../include/check.php'); 
 include('../include/head.php');  
 
 ?>

 <!-- Custom styles for this template-->
<link href="../css/custom.css" rel="stylesheet">

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../content/home.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
    
      <?php include('../include/nav.php');  ?>
  
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include('../include/nav-1.php');  ?>



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Supplier Oder (Pending Count)</div>
                      <?php

                            $queryso= "SELECT * FROM   supplier_order_item  WHERE status =0";
                            $resultso = mysqli_query($conn ,$queryso);
                            $countso =mysqli_num_rows($resultso);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $countso; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Customer Oder (Pending Count)</div>
                      <?php

                            $queryco= "SELECT * FROM   customer_order_item  WHERE status =0";
                            $resultco = mysqli_query($conn ,$queryco);
                            $countco =mysqli_num_rows($resultco);
                        ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countco; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Product Item ( Mostly )</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <?php

                            $querypi= "SELECT item_id FROM  shopTB  GROUP BY item_id ORDER BY COUNT(item_id) DESC 
                            LIMIT 1";
                            $resultpi = mysqli_query($conn ,$querypi);

                            $counti =mysqli_num_rows($resultpi);

                            if($counti >0){

                              while($rowpi= mysqli_fetch_array($resultpi))
                              { 
                                  $item_id = $rowpi['item_id'];
                              }
                              $querypi1= "SELECT name FROM   item  WHERE id='$item_id'";
                              $resultpi1 = mysqli_query($conn ,$querypi1);
                              while($rowpi1= mysqli_fetch_array($resultpi1))
                              { 
                                  $namec = $rowpi1['name'];
                              }

                            }else{
                              $namec = "Item Table is Emply";
                            }
                           

                          ?>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $namec; ?></div>
                        </div>
                        <div class="col">
                          <!-- <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Product Item ( Branch )</div>
                      <?php

                            $querypic= "SELECT customer_order_id FROM   customer_order_item  GROUP BY customer_order_id ORDER BY COUNT(customer_order_id) DESC LIMIT 1";
                            $resultpic = mysqli_query($conn ,$querypic);

                            $count =mysqli_num_rows($resultpic);

                            if($count >0){

                              while($rowpic= mysqli_fetch_array($resultpic))
                              { 
                                  $customer_order_id = $rowpic['customer_order_id'];
                              }

                              $querypic1= "SELECT branchid FROM   customer  WHERE id='$customer_order_id'";
                              $resultpic1 = mysqli_query($conn ,$querypic1);
                              while($rowpic1= mysqli_fetch_array($resultpic1))
                              { 
                                  $branchid = $rowpic1['branchid'];
                              }

                              $count1 =mysqli_num_rows($resultpic1);

                              if($count1>0){

                                $querypic2= "SELECT name FROM branch  WHERE id='$branchid'";
                                $resultpic2 = mysqli_query($conn ,$querypic2);
                                while($rowpic2= mysqli_fetch_array($resultpic2))
                                { 
                                    $nameb = $rowpic2['name'];
                                }
  

                              }else{
                                $nameb = "Branch Table is Empty";
                              }

                            }else{
                              $nameb = "Branch Table is Empty";
                            }
                           
                        ?>


                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nameb; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-14">
              <div class="card shadow mb-7">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Income and Expenduture Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <!-- <canvas id="myAreaChart"></canvas> -->
                    <?php 

                        $year =  date("Y");

                        $query="SELECT  SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC ', (month * 4) - 3, 3)
                        AS  monthName,incomeAMT , expendutureAMT
                        FROM  summary WHERE year='$year'" ;
                        $result=mysqli_query($conn,$query);
                        $chart_data_supplier_order='';
                        //$row=$result->fetch_assoc();
                        while($row=mysqli_fetch_array($result)){

                            $chart_data .= "{ y:'".$row["monthName"]."', a:".$row["incomeAMT"].", b:".$row["expendutureAMT"]."}, ";
                        }

                    ?>
                    <div id="myfirstchart" style="height: 250px;"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Calendar</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">

                  <script language="javascript" type="text/javascript">
                      var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
                      var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

                      //  DECLARE AND INITIALIZE VARIABLES
                      var Calendar = new Date();

                      var year = Calendar.getFullYear();     // Returns year
                      var month = Calendar.getMonth();    // Returns month (0-11)
                      var today = Calendar.getDate();    // Returns day (1-31)
                      var weekday = Calendar.getDay();    // Returns day (1-31)

                      var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
                      var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
                      var cal;    // Used for printing

                      Calendar.setDate(1);    // Start the calendar day at '1'
                      Calendar.setMonth(month);    // Start the calendar month at now


                      /* VARIABLES FOR FORMATTING
                      NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
                            tags to customize your caledanr's look. */

                      var TR_start = '<TR>';
                      var TR_end = '</TR>';
                      var highlight_start = '<TD WIDTH="30"><TABLE style="width: 100%;" CELLSPACING=0 BORDER=1 BGCOLOR=DEDEFF BORDERCOLOR=CCCCCC><TR><TD WIDTH=20><B><CENTER>';
                      var highlight_end   = '</CENTER></TD></TR></TABLE></B>';
                      var TD_start = '<TD WIDTH="30"><CENTER>';
                      var TD_end = '</CENTER></TD>';

                      /* BEGIN CODE FOR CALENDAR
                      NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
                      tags to customize your calendar's look.*/

                      cal =  '<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0 BORDERCOLOR=BBBBBB style="width: 100%;"><TR><TD>';
                      cal += '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 style="width: 100%;">' + TR_start;
                      cal += '<TD COLSPAN="' + DAYS_OF_WEEK + '" BGCOLOR="#EFEFEF"><CENTER><B>';
                      cal += month_of_year[month]  + '   ' + year + '</B>' + TD_end + TR_end;
                      cal += TR_start;

                      //   DO NOT EDIT BELOW THIS POINT  //

                      // LOOPS FOR EACH DAY OF WEEK
                      for(index=0; index < DAYS_OF_WEEK; index++)
                      {

                      // BOLD TODAY'S DAY OF WEEK
                      if(weekday == index)
                      cal += TD_start + '<B>' + day_of_week[index] + '</B>' + TD_end;

                      // PRINTS DAY
                      else
                      cal += TD_start + day_of_week[index] + TD_end;
                      }

                      cal += TD_end + TR_end;
                      cal += TR_start;

                      // FILL IN BLANK GAPS UNTIL TODAY'S DAY
                      for(index=0; index < Calendar.getDay(); index++)
                      cal += TD_start + '  ' + TD_end;

                      // LOOPS FOR EACH DAY IN CALENDAR
                      for(index=0; index < DAYS_OF_MONTH; index++)
                      {
                      if( Calendar.getDate() > index )
                      {
                        // RETURNS THE NEXT DAY TO PRINT
                        week_day =Calendar.getDay();

                        // START NEW ROW FOR FIRST DAY OF WEEK
                        if(week_day == 0)
                        cal += TR_start;

                        if(week_day != DAYS_OF_WEEK)
                        {

                        // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
                        var day  = Calendar.getDate();

                        // HIGHLIGHT TODAY'S DATE
                        if( today==Calendar.getDate() )
                        cal += highlight_start + day + highlight_end + TD_end;

                        // PRINTS DAY
                        else
                        cal += TD_start + day + TD_end;
                        }

                        // END ROW FOR LAST DAY OF WEEK
                        if(week_day == DAYS_OF_WEEK)
                        cal += TR_end;
                        }

                        // INCREMENTS UNTIL END OF THE MONTH
                        Calendar.setDate(Calendar.getDate()+1);

                      }// end for loop

                      cal += '</TD></TR></TABLE></TABLE>';

                      //  PRINT CALENDAR
                      document.write(cal);

                      //  End -->
                      </script>
                        <br/>
                      <div style="clear:both">
                    </div>
                    <div>
                    </div>

                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
        
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include('../include/footer.php');  ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include('../include/modal_logout.php');  ?>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>


</body>

</html>


<script>

var data = [
      <?php echo $chart_data; ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Total Income', 'Total Expenduture'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };

config.element = 'myfirstchart';
Morris.Bar(config);
config.element = 'stacked';
config.stacked = true;


</script>



